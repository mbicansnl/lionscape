<?php
$nav = content_for($content, $lang, 'nav', []);
$shared = content_for($content, $lang, 'shared', []);
?>
<<<<<<< HEAD
<header class="site-header">
  <div class="container header-inner">
    <a class="logo" href="/">LionScape</a>
    <button class="menu-toggle" aria-expanded="false" aria-controls="nav">Menu</button>
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
=======
<header class="site-header" aria-label="<?= h(content_value('ui.nav', $lang) ?? '') ?>">
  <div class="container header__inner">
    <div class="logo" aria-label="<?= h($nav['logo'] ?? 'Logo') ?>">
      <span class="logo__mark"><?= h($logoMark) ?></span>
      <span class="logo__text"><?= h($nav['logo'] ?? '') ?></span>
    </div>
    <nav class="nav" aria-label="<?= h(content_value('ui.nav', $lang) ?? '') ?>">
      <button class="nav__toggle" aria-expanded="false" aria-controls="nav-menu">
        <span class="nav__toggle-line"></span>
        <span class="nav__toggle-line"></span>
        <span class="nav__toggle-line"></span>
        <span class="visually-hidden"><?= h(content_value('ui.toggle', $lang) ?? '') ?></span>
      </button>
      <div class="nav__menu" id="nav-menu">
        <ul class="nav__list">
          <?php foreach (($nav['links'] ?? []) as $link): ?>
            <li class="nav__item">
              <?php
                $linkId = (string) ($link['id'] ?? '');
                $linkHref = $linkId === 'page-services'
                    ? page_url('page-services.php', $lang)
                    : nav_link($linkId, $lang);
              ?>
              <a class="nav__link" href="<?= h($linkHref) ?>"><?= h($link['label'] ?? '') ?></a>
            </li>
          <?php endforeach; ?>
        </ul>
        <div class="nav__actions">
          <a class="btn btn-secondary" href="<?= h(nav_link('contact', $lang)) ?>"><?= h($nav['cta'] ?? '') ?></a>
          <a class="language-toggle" href="<?= h(page_url($currentPage, $targetLang)) ?>" aria-label="<?= h($nav['languageToggle']['title'] ?? '') ?>"><?= h($nav['languageToggle']['label'] ?? '') ?></a>
>>>>>>> c760e300014fbf101b85ae5f081309fbc052f006
        </div>
        <a class="button primary" href="/contact" data-i18n="shared.cta_primary"><?php echo htmlspecialchars($shared['cta_primary'] ?? 'Plan 15-min kennismaking'); ?></a>
      </div>
    </nav>
  </div>
</header>
