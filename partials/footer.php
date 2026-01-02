<?php
$data = load_content_data();
$lang = $lang ?? current_language($data);
$contact = content_value('contact', $lang) ?? [];
$footer = content_value('footer', $lang) ?? [];
$company = content_value('company');
$nav = content_value('nav', $lang) ?? [];
$logoMark = strtoupper(substr((string) ($nav['logo'] ?? 'LS'), 0, 2));
$contactHeading = '';
foreach (($nav['links'] ?? []) as $link) {
    if (($link['id'] ?? '') === 'contact') {
        $contactHeading = $link['label'] ?? '';
        break;
    }
}
if ($contactHeading === '' && !empty($nav['links'])) {
    $last = end($nav['links']);
    $contactHeading = $last['label'] ?? '';
}
?>
<footer class="site-footer" aria-label="Footer">
  <div class="container footer__grid">
    <div class="footer__brand">
      <div class="logo" aria-label="<?= h($nav['logo'] ?? 'Logo') ?>">
        <span class="logo__mark"><?= h($logoMark) ?></span>
        <span class="logo__text"><?= h($nav['logo'] ?? '') ?></span>
      </div>
      <p class="muted"><?= h($footer['tagline'] ?? '') ?></p>
      <div class="footer__legal">&copy; <?= date('Y') ?> <?= h($company['name'] ?? '') ?> · <?= h($footer['legal'] ?? '') ?></div>
    </div>
    <div class="footer__col">
      <h3 class="kicker"><?= h($contactHeading) ?></h3>
      <?php $phoneRaw = $company['phone'] ?? ''; $phoneHref = preg_replace('/\\s+/', '', (string) $phoneRaw); ?>
      <a class="footer__link" href="tel:<?= h($phoneHref) ?>"><?= h((string) $phoneRaw) ?></a>
      <a class="footer__link" href="mailto:<?= h($company['email'] ?? '') ?>"><?= h($company['email'] ?? '') ?></a>
      <div class="footer__links">
        <a class="footer__link" href="<?= h(page_url('privacy.php', $lang)) ?>"><?= h($footer['privacy'] ?? '') ?></a>
      </div>
    </div>
  </div>
</footer>
<div class="cookie-banner" role="region" aria-label="<?= h(content_value('cookie.ariaLabel', $lang) ?? '') ?>">
  <div class="cookie-banner__inner">
    <p><?= h(content_value('cookie.message', $lang) ?? '') ?></p>
    <div class="cookie-banner__actions">
      <a class="btn btn-secondary" href="<?= h(page_url('privacy.php', $lang)) ?>"><?= h(content_value('cookie.policy', $lang) ?? '') ?></a>
      <button class="btn btn-primary" type="button" data-cookie-accept><?= h(content_value('cookie.accept', $lang) ?? '') ?></button>
    </div>
  </div>
</div>
</body>
</html>
