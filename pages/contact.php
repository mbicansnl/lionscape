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
    <form method="post" novalidate>
      <input type="hidden" name="form_type" value="contact">
      <label for="contact-name">
        <span data-i18n="shared.form.name"><?php echo htmlspecialchars($shared['form']['name'] ?? ''); ?></span>
        <input id="contact-name" type="text" name="name" autocomplete="name" required>
      </label>
      <label for="contact-email">
        <span data-i18n="shared.form.email"><?php echo htmlspecialchars($shared['form']['email'] ?? ''); ?></span>
        <input id="contact-email" type="email" name="email" autocomplete="email" inputmode="email" required>
      </label>
      <label for="contact-phone">
        <span data-i18n="shared.form.phone"><?php echo htmlspecialchars($shared['form']['phone'] ?? ''); ?></span>
        <input id="contact-phone" type="tel" name="phone" autocomplete="tel" inputmode="tel">
      </label>
      <label for="contact-message">
        <span data-i18n="shared.form.message"><?php echo htmlspecialchars($shared['form']['message'] ?? ''); ?></span>
        <textarea id="contact-message" name="message" rows="4"></textarea>
      </label>
      <label class="hidden">
        <span><?php echo htmlspecialchars($shared['honeypot'] ?? ''); ?></span>
        <input type="text" name="note" tabindex="-1" autocomplete="off">
      </label>
      <button class="button primary" type="submit" data-i18n="shared.form.submit"><?php echo htmlspecialchars($shared['form']['submit'] ?? ''); ?></button>
    </form>
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
      <a class="button ghost" href="/prijzen" data-i18n="nav.pricing"><?php echo htmlspecialchars(content_for($content, $lang, 'nav.pricing', 'Prijzen')); ?></a>
    </div>
  </div>
</section>
