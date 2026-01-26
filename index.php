<?php
declare(strict_types=1);
require __DIR__ . '/bootstrap.php';

$lang = detect_lang($content);
$page = current_page();
$messages = handle_forms($content, $lang);
$template = template_for($page);
$meta = meta_for($content, $lang, $page);
$title = $meta['title'] ?? 'LionScape';
$description = $meta['description'] ?? '';
$canonical = canonical_url($page, $lang);
$jsonLd = json_ld($content, $lang, $page);

$headerHtml = render_template(__DIR__ . '/partials/header.php', [
    'content' => $content,
    'lang' => $lang,
    'page' => $page,
    'title' => $title
]);
$mainHtml = render_template($template, [
    'content' => $content,
    'lang' => $lang,
    'page' => $page,
    'messages' => $messages
]);
$footerHtml = render_template(__DIR__ . '/partials/footer.php', [
    'content' => $content,
    'lang' => $lang,
]);

if (isset($_GET['fragment'])) {
    header('Content-Type: application/json');
    echo json_encode([
        'header' => $headerHtml,
        'main' => $mainHtml,
        'footer' => $footerHtml,
        'title' => $title,
        'description' => $description,
        'lang' => $lang,
        'canonical' => $canonical
    ]);
    exit;
}

?><!doctype html>
<html lang="<?php echo htmlspecialchars($lang); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($title); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($description); ?>">
    <link rel="canonical" href="<?php echo htmlspecialchars($canonical); ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($title); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($description); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo htmlspecialchars($canonical); ?>">
    <meta property="og:image" content="<?php echo absolute_url('assets/img/cases/jackontracks-home.png'); ?>">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="manifest" href="/pwa/manifest.webmanifest">
    <link rel="stylesheet" href="/assets/css/styles.css">
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="apple-touch-icon" href="/assets/icons/icon-192.png">
    <script>window.__content = <?php echo json_encode($content, JSON_UNESCAPED_UNICODE); ?>;</script>
    <?php foreach ($jsonLd as $schema): ?>
    <script type="application/ld+json"><?php echo json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?></script>
    <?php endforeach; ?>
</head>
<body class="theme">
<div id="page">
<?php echo $headerHtml; ?>
<main id="main" data-page="<?php echo htmlspecialchars($page); ?>">
<?php echo $mainHtml; ?>
</main>
<?php echo $footerHtml; ?>
</div>
<script src="/assets/js/app.js" type="module"></script>
<script>
  if (!document.cookie.includes('lang_pref')) {
    document.cookie = 'lang_pref=<?php echo $lang; ?>;path=/;max-age=31536000';
  }
  window.__initialLang = '<?php echo $lang; ?>';
</script>
</body>
</html>
