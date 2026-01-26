<?php
$shared = content_for($content, $lang, 'shared', []);
$pricing = content_for($content, $lang, 'pricing', []);
?>
<section class="page-hero">
  <div class="container">
    <h1 data-i18n="pricing.page_title"><?php echo htmlspecialchars($pricing['page_title'] ?? ''); ?></h1>
  </div>
</section>
<section class="pricing-body">
  <div class="container">
    <h2 data-i18n="pricing.structures_title"><?php echo htmlspecialchars($pricing['structures_title'] ?? ''); ?></h2>
    <div class="pricing-structures">
      <?php foreach (($pricing['structures'] ?? []) as $structure): ?>
        <details class="pricing-pill">
          <summary><h3><?php echo htmlspecialchars($structure['title'] ?? ''); ?></h3></summary>
          <div class="pricing-pill__content">
            <p><?php echo htmlspecialchars($structure['body'] ?? ''); ?></p>
          </div>
        </details>
      <?php endforeach; ?>
    </div>
    <?php foreach (($pricing['sections'] ?? []) as $section): ?>
      <h2><?php echo htmlspecialchars($section['title'] ?? ''); ?></h2>
      <?php foreach (($section['body'] ?? []) as $paragraph): ?>
        <p><?php echo htmlspecialchars($paragraph); ?></p>
      <?php endforeach; ?>
      <?php if (!empty($section['list']) && is_array($section['list'])): ?>
        <ul>
          <?php foreach ($section['list'] as $item): ?>
            <li><?php echo htmlspecialchars($item); ?></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
</section>
<section class="final-cta">
  <div class="container final-grid">
    <div>
      <h2><?php echo htmlspecialchars(content_for($content, $lang, 'home.final_cta.title', '')); ?></h2>
      <p><?php echo htmlspecialchars(content_for($content, $lang, 'home.final_cta.text', '')); ?></p>
    </div>
    <div class="cta-actions">
      <a class="button primary" href="/contact"><?php echo htmlspecialchars(content_for($content, $lang, 'home.final_cta.cta', '')); ?></a>
    </div>
  </div>
</section>
