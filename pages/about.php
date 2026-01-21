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
    </div>
  </div>
</section>
