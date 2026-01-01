<?php
/** @var string $pageKey */
/** @var string $lang */
$data = load_content_data();
$lang = $lang ?? current_language($data);
$pageKey = $pageKey ?? 'home';
$metaPath = 'meta.' . $pageKey;
$title = (string) (content_value($metaPath . '.title', $lang) ?? '');
$description = (string) (content_value($metaPath . '.description', $lang) ?? '');
$ogTitle = (string) (content_value($metaPath . '.ogTitle', $lang) ?? $title);
$ogDescription = (string) (content_value($metaPath . '.ogDescription', $lang) ?? $description);
$canonicalBase = (string) (content_value('canonical') ?? '');
$path = $pageKey === 'home' ? '/' : '/' . $pageKey . '.php';
$canonicalUrl = rtrim($canonicalBase, '/') . $path;
$company = content_value('company');
$logoAlt = (string) (content_value('meta.og.imageAlt', $lang) ?? '');
$ogImage = rtrim($canonicalBase, '/') . '/assets/img/logo.svg';
?>
<!doctype html>
<html lang="<?= h($lang) ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= h($title) ?></title>
  <meta name="description" content="<?= h($description) ?>">
  <link rel="canonical" href="<?= h($canonicalUrl) ?>">
  <meta property="og:title" content="<?= h($ogTitle) ?>">
  <meta property="og:description" content="<?= h($ogDescription) ?>">
  <meta property="og:url" content="<?= h($canonicalUrl) ?>">
  <meta property="og:type" content="website">
  <meta property="og:image:alt" content="<?= h($logoAlt) ?>">
  <meta property="og:image" content="<?= h($ogImage) ?>">
  <meta name="twitter:image" content="<?= h($ogImage) ?>">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= h($ogTitle) ?>">
  <meta name="twitter:description" content="<?= h($ogDescription) ?>">
  <link rel="stylesheet" href="assets/css/style.css">
  <script defer src="assets/js/main.js"></script>
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "<?= h($company['name'] ?? '') ?>",
      "legalName": "<?= h($company['legalName'] ?? '') ?>",
      "url": "<?= h($company['url'] ?? '') ?>",
      "logo": "<?= h($canonicalBase) ?>/assets/img/logo.svg",
      "contactPoint": [{
        "@type": "ContactPoint",
        "contactType": "customer support",
        "telephone": "<?= h($company['phone'] ?? '') ?>",
        "email": "<?= h($company['email'] ?? '') ?>"
      }],
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "<?= h($company['address']['street'] ?? '') ?>",
        "addressLocality": "<?= h($company['address']['city'] ?? '') ?>",
        "postalCode": "<?= h($company['address']['postalCode'] ?? '') ?>",
        "addressCountry": "<?= h($company['address']['country'] ?? '') ?>"
      }
    }
  </script>
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "LocalBusiness",
      "name": "<?= h($company['name'] ?? '') ?>",
      "image": "<?= h($canonicalBase) ?>/assets/img/logo.svg",
      "telephone": "<?= h($company['phone'] ?? '') ?>",
      "email": "<?= h($company['email'] ?? '') ?>",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "<?= h($company['address']['street'] ?? '') ?>",
        "addressLocality": "<?= h($company['address']['city'] ?? '') ?>",
        "postalCode": "<?= h($company['address']['postalCode'] ?? '') ?>",
        "addressCountry": "<?= h($company['address']['country'] ?? '') ?>"
      },
      "url": "<?= h($canonicalUrl) ?>"
    }
  </script>
</head>
<body class="theme-dark" data-lang="<?= h($lang) ?>">
<a class="skip-link" href="#main"><?= h(content_value('ui.skip', $lang) ?? '') ?></a>
