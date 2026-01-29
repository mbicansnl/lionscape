<?php
declare(strict_types=1);

$content = json_decode((string)file_get_contents(__DIR__ . '/data/content.json'), true);
if (!$content) {
    http_response_code(500);
    echo 'Content kon niet geladen worden.';
    exit;
}

function supported_langs(array $content): array
{
    return array_keys($content);
}

function detect_lang(array $content): string
{
    $allowed = supported_langs($content);
    $lang = $_GET['lang'] ?? null;
    if ($lang && in_array($lang, $allowed, true)) {
        return $lang;
    }
    if (isset($_COOKIE['lang_pref']) && in_array($_COOKIE['lang_pref'], $allowed, true)) {
        return $_COOKIE['lang_pref'];
    }
    return 'nl';
}

function content_for(array $content, string $lang, string $path, mixed $default = ''): mixed
{
    $segments = explode('.', $path);
    $current = $content[$lang] ?? [];
    foreach ($segments as $segment) {
        if (!is_array($current) || !array_key_exists($segment, $current)) {
            return $default;
        }
        $current = $current[$segment];
    }
    return $current;
}

function current_page(): string
{
    $uri = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '';
    $uri = trim($uri, '/');
    if ($uri === '') {
        return 'home';
    }
    $map = [
        'aanpak' => 'services',
        'voorbeelden' => 'cases',
        'case-jack' => 'case-jack',
        'case-canservices' => 'case-canservices',
        'prijzen' => 'pricing',
        'over' => 'about',
        'contact' => 'contact',
        'privacy' => 'privacy',
        'cookies' => 'cookies'
    ];
    if (isset($map[$uri])) {
        return $map[$uri];
    }
    if ($uri === 'sitemap.xml') {
        return 'sitemap';
    }
    $fallback = $_GET['page'] ?? 'home';
    return $fallback;
}

function template_for(string $page): string
{
    $file = __DIR__ . '/pages/' . $page . '.php';
    if (file_exists($file)) {
        return $file;
    }
    return __DIR__ . '/pages/404.php';
}

function meta_for(array $content, string $lang, string $page): array
{
    $key = str_replace('-', '_', $page);
    $meta = content_for($content, $lang, 'meta.' . $key, []);
    if (!is_array($meta)) {
        return ['title' => 'LionScape', 'description' => ''];
    }
    return $meta;
}

function sanitize(string $value): string
{
    return trim(strip_tags($value));
}

function store_submission(string $type, array $data): void
{
    $dir = __DIR__ . '/storage';
    if (!is_dir($dir)) {
        mkdir($dir, 0775, true);
    }
    $record = [
        'type' => $type,
        'time' => gmdate('c'),
        'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
        'data' => $data
    ];
    $line = json_encode($record) . "\n";
    file_put_contents($dir . '/submissions.log', $line, FILE_APPEND | LOCK_EX);
}

function handle_forms(array $content, string $lang): array
{
    $messages = ['success' => null, 'error' => null];
    if (($_GET['success'] ?? '') === '1') {
        $messages['success'] = content_for($content, $lang, 'shared.form.success', content_for($content, $lang, 'forms.success_body', 'Bedankt'));
    }
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return $messages;
    }
    $type = $_POST['form_type'] ?? '';
    $honeypot = sanitize($_POST['note'] ?? '');
    if ($honeypot !== '') {
        return $messages;
    }
    $name = sanitize($_POST['name'] ?? '');
    $email = filter_var(sanitize($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $phone = sanitize($_POST['phone'] ?? '');
    $message = sanitize($_POST['message'] ?? '');

    if (!$name || !$email) {
        $messages['error'] = content_for($content, $lang, 'forms.error', '');
        return $messages;
    }

    $data = [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'message' => $message
    ];

    store_submission($type ?: 'contact', $data);

    $redirect = strtok($_SERVER['REQUEST_URI'], '?');
    $query = http_build_query(['page' => current_page(), 'lang' => $lang, 'success' => '1']);
    header('Location: ' . $redirect . '?' . $query);
    exit;
}

function absolute_url(string $path = ''): string
{
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    return rtrim($scheme . '://' . $host, '/') . '/' . ltrim($path, '/');
}

function canonical_url(string $page, string $lang): string
{
    $baseUrl = 'https://lionscape.nl';
    $basePath = '';
    $map = [
        'home' => '',
        'services' => 'aanpak',
        'cases' => 'voorbeelden',
        'case-jack' => 'case-jack',
        'case-canservices' => 'case-canservices',
        'pricing' => 'prijzen',
        'about' => 'over',
        'contact' => 'contact',
        'privacy' => 'privacy',
        'cookies' => 'cookies'
    ];
    if (isset($map[$page])) {
        $basePath = $map[$page];
    } else {
        $basePath = $page;
    }
    if ($basePath === '') {
        return $baseUrl;
    }
    return $baseUrl . '/' . $basePath;
}

function language_url(string $page, string $lang): string
{
    $url = canonical_url($page, 'nl');
    if ($lang === 'nl') {
        return $url;
    }
    $separator = str_contains($url, '?') ? '&' : '?';
    return $url . $separator . 'lang=' . urlencode($lang);
}

function json_ld(array $content, string $lang, string $page): array
{
    $organization = [
        '@context' => 'https://schema.org',
        '@type' => 'LocalBusiness',
        'name' => 'LionScape',
        'url' => 'https://lionscape.nl',
        'logo' => 'https://lionscape.nl/LionScape-logo-transparent-header.png',
        'description' => 'Digitale diensten voor ondernemers: webdesign, SEO en social media.',
        'address' => [
            '@type' => 'PostalAddress',
            'addressCountry' => 'NL'
        ],
        'sameAs' => [
            'https://www.linkedin.com/company/lionscape'
        ]
    ];

    $service = [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'provider' => [
            '@type' => 'Organization',
            'name' => 'LionScape'
        ],
        'serviceType' => [
            'Webdesign',
            'SEO',
            'Social Media Management'
        ],
        'areaServed' => [
            '@type' => 'Country',
            'name' => 'Netherlands'
        ]
    ];

    return [$organization, $service];
}

function render_template(string $file, array $vars = []): string
{
    extract($vars);
    ob_start();
    include $file;
    return ob_get_clean();
}

function language_toggle_url(string $page, string $lang): string
{
    $target = $lang === 'nl' ? 'en' : 'nl';
    return language_target_url($page, $target);
}

function language_target_url(string $page, string $target): string
{
    $base = strtok($_SERVER['REQUEST_URI'], '?');
    $query = http_build_query(['page' => $page, 'lang' => $target]);
    return $base . '?' . $query;
}

function is_active(string $page, string $current): bool
{
    return $page === $current;
}
