<?php
$data = content_for($content, $lang, 'services', []);
$shared = content_for($content, $lang, 'shared', []);
?>
<section class="page-hero">
  <div class="container">
    <h1 data-i18n="nav.services"><?php echo htmlspecialchars(content_for($content, $lang, 'nav.services', 'Aanpak')); ?></h1>
    <section class="offers">
        <div class="offer-grid">
    </section>
    <p><?php echo htmlspecialchars($data['intro'] ?? ''); ?></p>
  </div>
</section>
<section class="offers">
  <div class="container offer-grid">
    <?php foreach (($data['offers'] ?? []) as $offer): ?>
      <article class="card">
        <h2><?php echo htmlspecialchars($offer['title']); ?></h2>
        <p class="muted"><?php echo htmlspecialchars($offer['who']); ?></p>
        <p><?php echo htmlspecialchars($offer['deliver']); ?></p>
        <p class="muted"><?php echo htmlspecialchars($offer['timeline']); ?></p>
        <a class="button primary" href="/contact"><?php echo htmlspecialchars($offer['cta']); ?></a>
      </article>
    <?php endforeach; ?>
  </div>
</section>
<section class="approach">
  <div class="container">
    <h2 data-i18n="services.approach_title"><?php echo htmlspecialchars($data['approach_title'] ?? ''); ?></h2>
    <div class="text-list">
      <?php foreach (($data['approach'] ?? []) as $step): ?>
        <div class="text-list-item">
          <h3><?php echo htmlspecialchars($step['title']); ?></h3>
          <p><?php echo htmlspecialchars($step['body']); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<section class="faq">
  <div class="container">
    <h2 data-i18n="shared.faq_title"><?php echo htmlspecialchars($shared['faq_title'] ?? 'FAQ'); ?></h2>
    <div class="text-list">
      <?php foreach (content_for($content, $lang, 'shared.faq', []) as $item): ?>
        <div class="text-list-item">
          <h3><?php echo htmlspecialchars($item['q']); ?></h3>
          <p><?php echo htmlspecialchars($item['a']); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<section class="final-cta">
  <div class="container final-grid">
    <div>
      <h2><?php echo htmlspecialchars($shared['free_scan_title'] ?? ''); ?></h2>
      <p><?php echo htmlspecialchars($shared['free_scan_body'] ?? ''); ?></p>
    </div>
    <div class="cta-actions">
      <a class="button primary" href="/contact" data-i18n="shared.cta_primary"><?php echo htmlspecialchars($shared['cta_primary'] ?? ''); ?></a>
      <a class="button ghost" href="/prijzen" data-i18n="nav.pricing"><?php echo htmlspecialchars(content_for($content, $lang, 'nav.pricing', 'Prijzen')); ?></a>
    </div>
  </div>
</section>
