<?php
$meta = content_for($content, $lang, 'meta.not_found', []);
?>
<section class="page-hero">
  <div class="container">
    <h1><?php echo htmlspecialchars($meta['title'] ?? 'Pagina niet gevonden'); ?></h1>
    <p><?php echo htmlspecialchars($meta['description'] ?? ''); ?></p>
    <a class="button primary" href="/"><?php echo htmlspecialchars(content_for($content, $lang, 'nav.home', 'Home')); ?></a>
  </div>
</section>
