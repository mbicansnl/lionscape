<?php
$data = content_for($content, $lang, 'about', []);
$shared = content_for($content, $lang, 'shared', []);
$title = $data['title'] ?? content_for($content, $lang, 'nav.about', 'Over');
?>
<section class="page-hero">
  <div class="container">
    <h1><?php echo htmlspecialchars($title); ?></h1>
  </div>
</section>
<section class="about-body">
  <div class="container">
    <figure class="about-hero-image">
      <img src="/LionScape-logo-full.png" alt="LionScape logo" loading="lazy">
    </figure>
    <div class="grid-2">
      <div class="about-sections">
        <?php if (!empty($data['sections']) && is_array($data['sections'])): ?>
          <?php foreach ($data['sections'] as $section): ?>
            <h2><?php echo htmlspecialchars($section['title'] ?? ''); ?></h2>
            <p><?php echo htmlspecialchars($section['body'] ?? ''); ?></p>
          <?php endforeach; ?>
        <?php else: ?>
          <p><?php echo htmlspecialchars($data['intro'] ?? ''); ?></p>
          <p><?php echo htmlspecialchars($data['body'] ?? ''); ?></p>
          <p class="muted"><?php echo htmlspecialchars($data['proof'] ?? ''); ?></p>
        <?php endif; ?>
      </div>
      <div class="card">
        <h2 data-i18n="shared.free_scan_title"><?php echo htmlspecialchars($shared['free_scan_title'] ?? ''); ?></h2>
        <p data-i18n="shared.free_scan_body"><?php echo htmlspecialchars($shared['free_scan_body'] ?? ''); ?></p>
        <a class="button primary" href="/contact" data-i18n="shared.cta_primary"><?php echo htmlspecialchars($shared['cta_primary'] ?? ''); ?></a>
      </div>
    </div>
  </div>
</section>
