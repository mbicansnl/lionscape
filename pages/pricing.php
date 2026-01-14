<?php
$data = content_for($content, $lang, 'pricing', []);
?>
<section class="page-hero">
  <div class="container">
    <h1 data-i18n="nav.pricing"><?php echo htmlspecialchars(content_for($content, $lang, 'nav.pricing', 'Prijzen')); ?></h1>
    <p><?php echo htmlspecialchars($data['intro'] ?? ''); ?></p>
  </div>
</section>
<section class="cards">
  <div class="container grid-3">
    <?php foreach (($data['tiers'] ?? []) as $tier): ?>
      <article class="card">
        <h2><?php echo htmlspecialchars($tier['name']); ?></h2>
        <p class="muted">
          <?php echo htmlspecialchars($tier['range']); ?>
        </p>
        <ul>
          <?php foreach ($tier['items'] as $item): ?>
            <li><?php echo htmlspecialchars($item); ?></li>
          <?php endforeach; ?>
        </ul>
      </article>
    <?php endforeach; ?>
  </div>
</section>
<section class="faq">
  <div class="container">
    <h2>FAQ</h2>
    <div class="accordion">
      <?php foreach (($data['faq'] ?? []) as $item): ?>
        <details>
          <summary><?php echo htmlspecialchars($item['q']); ?></summary>
          <p><?php echo htmlspecialchars($item['a']); ?></p>
        </details>
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
    </div>
  </div>
</section>
