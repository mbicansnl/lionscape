<?php
$shared = content_for($content, $lang, 'shared', []);
$brand = content_for($content, $lang, 'brand', 'LionScape');
?>
<footer class="site-footer">
  <div class="container footer-grid">
    <div>
      <p class="brand"><?php echo htmlspecialchars($brand); ?></p>
      <p data-i18n="shared.proof_line"><?php echo htmlspecialchars($shared['proof_line'] ?? ''); ?></p>
    </div>
    <div>
      <p data-i18n="shared.footer.contact"><?php echo htmlspecialchars($shared['footer']['contact'] ?? 'Contact'); ?></p>
      <a href="mailto:<?php echo htmlspecialchars($shared['footer']['email'] ?? 'info@lionscape.nl'); ?>"><?php echo htmlspecialchars($shared['footer']['email'] ?? 'info@lionscape.nl'); ?></a><br>
      <a href="tel:+31600000000"><?php echo htmlspecialchars($shared['footer']['phone'] ?? '+31 6 0000 0000'); ?></a>
    </div>
    <div class="footer-links">
      <a href="/privacy" data-i18n="legal.privacy.title"><?php echo htmlspecialchars(content_for($content, $lang, 'legal.privacy.title', 'Privacy')); ?></a>
      <a href="/cookies" data-i18n="legal.cookies.title"><?php echo htmlspecialchars(content_for($content, $lang, 'legal.cookies.title', 'Cookies')); ?></a>
      <a href="/sitemap.xml" data-i18n="shared.sitemap_label"><?php echo htmlspecialchars($shared['sitemap_label'] ?? 'Sitemap'); ?></a>
    </div>
  </div>
</footer>
