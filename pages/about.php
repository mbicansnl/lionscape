<?php
$data = content_for($content, $lang, 'about', []);
$shared = content_for($content, $lang, 'shared', []);
?>
<section class="page-hero">
  <div class="container">
    <h1 data-i18n="nav.about"><?php echo htmlspecialchars(content_for($content, $lang, 'nav.about', 'Over')); ?></h1>
    <p><?php echo htmlspecialchars($data['intro'] ?? ''); ?></p>
  </div>
</section>
<section class="about-body">
  <div class="container grid-2">
    <div>
      <p><?php echo htmlspecialchars($data['body'] ?? ''); ?></p>
      <p class="muted"><?php echo htmlspecialchars($data['proof'] ?? ''); ?></p>
    </div>
    <div class="card">
      <h2 data-i18n="shared.free_scan_title"><?php echo htmlspecialchars($shared['free_scan_title'] ?? ''); ?></h2>
      <p data-i18n="shared.free_scan_body"><?php echo htmlspecialchars($shared['free_scan_body'] ?? ''); ?></p>
      <a class="button primary" href="/contact" data-i18n="shared.cta_primary"><?php echo htmlspecialchars($shared['cta_primary'] ?? ''); ?></a>
    </div>
  </div>
</section>
