<?php
$data = content_for($content, $lang, 'contact', []);
$shared = content_for($content, $lang, 'shared', []);
?>
<section class="page-hero">
  <div class="container">
    <h1 data-i18n="contact.h1"><?php echo htmlspecialchars($data['h1'] ?? ''); ?></h1>
    <p><?php echo htmlspecialchars($data['intro'] ?? ''); ?></p>
    <p class="muted"><?php echo htmlspecialchars($data['note'] ?? ''); ?></p>
  </div>
</section>
<section class="form-block">
  <div class="container form-grid">
    <div>
      <?php if (!empty($messages['success'])): ?>
        <div class="notice success" role="status"><?php echo htmlspecialchars($messages['success']); ?></div>
      <?php elseif (!empty($messages['error'])): ?>
        <div class="notice error" role="alert"><?php echo htmlspecialchars($messages['error']); ?></div>
      <?php endif; ?>
      <h2 data-i18n="contact.title"><?php echo htmlspecialchars($data['title'] ?? ''); ?></h2>
      <p data-i18n="contact.intro"><?php echo htmlspecialchars($data['intro'] ?? ''); ?></p>
    </div>
    <?php include __DIR__ . '/partials/lead-form.php'; ?>
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
