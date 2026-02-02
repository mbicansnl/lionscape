<?php
$data = content_for($content, $lang, 'case_canservices', []);
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
      <a class="button primary" href="/contact" data-i18n="case_canservices.cta"><?php echo htmlspecialchars($data['cta'] ?? ''); ?></a>
    </div>
    <div class="gallery">
      <?php foreach (($data['gallery'] ?? []) as $item): ?>
        <figure>
          <img src="/<?php echo htmlspecialchars($item['src']); ?>" alt="<?php echo htmlspecialchars($item['caption']); ?>" width="720" height="420" loading="lazy" decoding="async">
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
      <a class="button ghost" href="/case-jack"><?php echo htmlspecialchars(content_for($content, $lang, 'cases.list.0.title', '')); ?></a>
    </div>
  </div>
</section>
