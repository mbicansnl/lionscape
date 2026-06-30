<?php
$shared = content_for($content, $lang, 'shared', []);
$nav = content_for($content, $lang, 'nav', []);
$brand = content_for($content, $lang, 'brand', 'LionScape');
$footer = $shared['footer'] ?? [];
$services = $footer['services'] ?? [
  ['label' => $nav['websites'] ?? ($lang === 'en' ? 'Websites' : 'Websites'), 'href' => '/websites'],
  ['label' => $nav['apps'] ?? ($lang === 'en' ? 'Apps & systems' : 'Apps & systemen'), 'href' => '/apps-systemen'],
  ['label' => $nav['ai_agents'] ?? ($lang === 'en' ? 'AI agents' : 'AI-agents'), 'href' => '/ai-agents'],
];
$email = $footer['email'] ?? 'info@lionscape.nl';
$phone = $footer['phone'] ?? '+31 6 0000 0000';
$phone_href = preg_replace('/[^+0-9]/', '', $phone);
?>
<footer class="site-footer">
  <div class="container footer-shell">
    <div class="footer-main">
      <section class="footer-brand" aria-label="<?php echo htmlspecialchars($brand); ?>">
        <p class="brand"><?php echo htmlspecialchars($brand); ?></p>
        <p class="footer-intro" data-i18n="shared.footer.line"><?php echo htmlspecialchars($footer['line'] ?? ($shared['proof_line'] ?? '')); ?></p>
      </section>

      <nav class="footer-column" aria-label="<?php echo htmlspecialchars($footer['services_title'] ?? ($lang === 'en' ? 'Services' : 'Diensten')); ?>">
        <h2><?php echo htmlspecialchars($footer['services_title'] ?? ($lang === 'en' ? 'Services' : 'Diensten')); ?></h2>
        <ul class="footer-list">
          <?php foreach ($services as $service): ?>
            <li><a href="<?php echo htmlspecialchars($service['href']); ?>"><?php echo htmlspecialchars($service['label']); ?></a></li>
          <?php endforeach; ?>
        </ul>
      </nav>

      <section class="footer-column" aria-labelledby="footer-contact-title">
        <h2 id="footer-contact-title" data-i18n="shared.footer.contact"><?php echo htmlspecialchars($footer['contact'] ?? 'Contact'); ?></h2>
        <ul class="footer-list footer-contact">
          <li><a href="mailto:<?php echo htmlspecialchars($email); ?>"><?php echo htmlspecialchars($email); ?></a></li>
          <li><a href="tel:<?php echo htmlspecialchars($phone_href); ?>"><?php echo htmlspecialchars($phone); ?></a></li>
        </ul>
      </section>
    </div>

    <div class="footer-bottom">
      <p>&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($brand); ?></p>
      <nav class="footer-legal" aria-label="<?php echo htmlspecialchars($lang === 'en' ? 'Legal links' : 'Juridische links'); ?>">
        <a href="/privacy" data-i18n="legal.privacy.title"><?php echo htmlspecialchars(content_for($content, $lang, 'legal.privacy.title', 'Privacy')); ?></a>
        <a href="/cookies" data-i18n="legal.cookies.title"><?php echo htmlspecialchars(content_for($content, $lang, 'legal.cookies.title', 'Cookies')); ?></a>
        <a href="/terms"><?php echo htmlspecialchars($lang === 'en' ? 'Terms' : 'Voorwaarden'); ?></a>
        <a href="/sitemap.xml" data-i18n="shared.sitemap_label"><?php echo htmlspecialchars($shared['sitemap_label'] ?? 'Sitemap'); ?></a>
      </nav>
    </div>
  </div>
</footer>
