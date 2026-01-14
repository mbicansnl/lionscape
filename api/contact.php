<?php
require __DIR__ . '/../partials/helpers.php';

$data = load_content_data();
$lang = current_language($data);
$contactErrors = content_value('forms.errors', $lang) ?? [];
$redirectBase = build_url('index.php', ['lang' => $lang], 'contact');

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    header('Location: ' . $redirectBase);
    exit;
}

$inputs = [
    'name' => trim((string) ($_POST['name'] ?? '')),
    'email' => trim((string) ($_POST['email'] ?? '')),
    'phone' => trim((string) ($_POST['phone'] ?? '')),
    'service' => trim((string) ($_POST['service'] ?? '')),
    'message' => trim((string) ($_POST['message'] ?? '')),
];
$honeypot = trim((string) ($_POST['website'] ?? ''));

$errorMessage = '';
$fieldErrors = [];

if ($honeypot !== '') {
    $errorMessage = $contactErrors['honeypot'] ?? '';
}

if ($errorMessage === '' && ($inputs['name'] === '' || $inputs['email'] === '' || $inputs['message'] === '')) {
    $errorMessage = $contactErrors['required'] ?? '';
    if ($inputs['name'] === '') {
        $fieldErrors['name'] = $contactErrors['required'] ?? '';
    }
    if ($inputs['email'] === '') {
        $fieldErrors['email'] = $contactErrors['required'] ?? '';
    }
    if ($inputs['message'] === '') {
        $fieldErrors['message'] = $contactErrors['required'] ?? '';
    }
}

if ($errorMessage === '' && !filter_var($inputs['email'], FILTER_VALIDATE_EMAIL)) {
    $errorMessage = $contactErrors['email'] ?? '';
    $fieldErrors['email'] = $contactErrors['email'] ?? '';
}

$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$limitFile = __DIR__ . '/../storage/rate_limit.json';
$now = time();
$window = 600; // 10 minutes
$maxRequests = 3;
$limits = [];
if (file_exists($limitFile)) {
    $json = file_get_contents($limitFile);
    $limits = $json ? json_decode($json, true) : [];
    if (!is_array($limits)) {
        $limits = [];
    }
}
$history = $limits[$ip] ?? [];
$history = array_filter($history, fn ($ts) => ($now - (int) $ts) < $window);
if ($errorMessage === '' && count($history) >= $maxRequests) {
    $errorMessage = $contactErrors['rate'] ?? '';
}

if ($errorMessage !== '') {
    $_SESSION['contact_errors'] = ['message' => $errorMessage, 'fields' => $fieldErrors];
    $_SESSION['contact_old'] = $inputs;
    header('Location: ' . $redirectBase);
    exit;
}

$history[] = $now;
$limits[$ip] = array_slice($history, -$maxRequests);
file_put_contents($limitFile, json_encode($limits));

$csvPath = __DIR__ . '/../storage/leads.csv';
$isNew = !file_exists($csvPath) || filesize($csvPath) === 0;
$handle = fopen($csvPath, 'a');
if ($handle === false) {
    $_SESSION['contact_errors'] = ['message' => $contactErrors['server'] ?? ''];
    $_SESSION['contact_old'] = $inputs;
    header('Location: ' . $redirectBase);
    exit;
}

if ($isNew) {
    fputcsv($handle, ['timestamp', 'ip', 'name', 'email', 'phone', 'service', 'message']);
}

$record = [
    date('c', $now),
    $ip,
    sanitize_csv_field($inputs['name']),
    sanitize_csv_field($inputs['email']),
    sanitize_csv_field($inputs['phone']),
    sanitize_csv_field($inputs['service']),
    sanitize_csv_field($inputs['message']),
];

fputcsv($handle, $record);
fclose($handle);

$_SESSION['contact_success'] = true;
unset($_SESSION['contact_old'], $_SESSION['contact_errors']);

header('Location: ' . build_url('index.php', ['lang' => $lang, 'sent' => 1], 'contact'));
exit;
