<?php
$data = content_for($content, $lang, 'case_jack', []);
?>
<section class="page-hero">
  <div class="container">
    <h1><?php echo htmlspecialchars($data['hero'] ?? ''); ?></h1>
    <p><?php echo htmlspecialchars($data['ask'] ?? ''); ?></p>
  </div>
</section>
<section class="case-body">
  <div class="container grid-2">
    <div>
      <h2><?php echo htmlspecialchars($data['built'] ?? ''); ?></h2>
      <p><?php echo htmlspecialchars($data['why'] ?? ''); ?></p>
      <?php if (!empty($data['features'])): ?>
        <h3><?php echo htmlspecialchars($data['features_title'] ?? ''); ?></h3>
        <ul>
          <?php foreach ($data['features'] as $feature): ?>
            <li>
              <a href="<?php echo htmlspecialchars($feature['url'] ?? ''); ?>">
                <?php echo htmlspecialchars($feature['label'] ?? ''); ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
      <a class="button primary" href="/contact" data-i18n="case_jack.cta"><?php echo htmlspecialchars($data['cta'] ?? ''); ?></a>
    </div>
    <div class="gallery">
      <?php foreach (($data['gallery'] ?? []) as $item): ?>
        <figure>
          <img src="/<?php echo htmlspecialchars($item['src']); ?>" alt="<?php echo htmlspecialchars($item['caption']); ?>" width="720" height="420" loading="lazy">
          <figcaption><?php echo htmlspecialchars($item['caption']); ?></figcaption>
        </figure>
      <?php endforeach; ?>
    </div>
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
      <a class="button ghost" href="/case-canservices"><?php echo htmlspecialchars(content_for($content, $lang, 'cases.list.1.title', '')); ?></a>
    </div>
  </div>
</section>
