<?php
$nav = content_for($content, $lang, 'nav', []);
$shared = content_for($content, $lang, 'shared', []);
$brand = content_for($content, $lang, 'brand', 'LionScape');
?>
<header class="site-header">
  <div class="container header-inner">
    <?php if ($page !== 'home'): ?>
    <a class="logo" href="/" aria-label="<?php echo htmlspecialchars($brand); ?>">
      <img src="/LionScape-logo-full-transparant.png" alt="<?php echo htmlspecialchars($brand); ?>">
    </a>
    <?php endif; ?>
    <button class="menu-toggle" aria-expanded="false" aria-controls="nav" data-i18n="shared.menu_label"><?php echo htmlspecialchars($shared['menu_label'] ?? 'Menu'); ?></button>
    <nav id="nav" class="nav" aria-label="Main">
      <ul class="nav-list">
        <li><a href="/" class="<?php echo is_active('home', $page) ? 'active' : ''; ?>" data-i18n="nav.home"><?php echo htmlspecialchars($nav['home'] ?? 'Home'); ?></a></li>
        <li><a href="/aanpak" class="<?php echo is_active('services', $page) ? 'active' : ''; ?>" data-i18n="nav.services"><?php echo htmlspecialchars($nav['services'] ?? 'Aanpak'); ?></a></li>
        <li><a href="/voorbeelden" class="<?php echo is_active('cases', $page) ? 'active' : ''; ?>" data-i18n="nav.cases"><?php echo htmlspecialchars($nav['cases'] ?? 'Voorbeelden'); ?></a></li>
        <li><a href="/prijzen" class="<?php echo is_active('pricing', $page) ? 'active' : ''; ?>" data-i18n="nav.pricing"><?php echo htmlspecialchars($nav['pricing'] ?? 'Prijzen'); ?></a></li>
        <li><a href="/over" class="<?php echo is_active('about', $page) ? 'active' : ''; ?>" data-i18n="nav.about"><?php echo htmlspecialchars($nav['about'] ?? 'Over'); ?></a></li>
        <li><a href="/contact" class="<?php echo is_active('contact', $page) ? 'active' : ''; ?>" data-i18n="nav.contact"><?php echo htmlspecialchars($nav['contact'] ?? 'Contact'); ?></a></li>
      </ul>
      <div class="nav-actions">
        <div class="lang-toggle" data-language-toggle>
          <a href="<?php echo htmlspecialchars(language_target_url($page, 'nl')); ?>" data-lang="nl" class="<?php echo $lang === 'nl' ? 'active' : ''; ?>">NL</a>
          <span>|</span>
          <a href="<?php echo htmlspecialchars(language_target_url($page, 'en')); ?>" data-lang="en" class="<?php echo $lang === 'en' ? 'active' : ''; ?>">EN</a>
        </div>
        <a class="button primary" href="/contact" data-i18n="shared.cta_primary"><?php echo htmlspecialchars($shared['cta_primary'] ?? 'Plan 15-min kennismaking'); ?></a>
      </div>
    </nav>
  </div>
</header>
