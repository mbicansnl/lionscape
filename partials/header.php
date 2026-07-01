<?php
$nav = content_for($content, $lang, 'nav', []);
$shared = content_for($content, $lang, 'shared', []);
$brand = content_for($content, $lang, 'brand', 'LionScape');
?>
<header class="site-header">
  <a class="skip-link" href="#main"><?php echo htmlspecialchars($shared['skip_link'] ?? ''); ?></a>
  <div class="container header-inner">
    <a class="logo" href="/" aria-label="<?php echo htmlspecialchars($brand); ?>">
      <img src="/LionScape-icon-transparent.png" alt="<?php echo htmlspecialchars($brand); ?>" width="1080" height="450">
    </a>
    <button class="menu-toggle" aria-expanded="false" aria-controls="nav"><?php echo htmlspecialchars($shared['menu_label'] ?? 'Menu'); ?></button>
    <nav id="nav" class="nav" aria-label="<?php echo htmlspecialchars($shared['nav_label'] ?? ''); ?>">
      <ul class="nav-list">
        <li><a href="/" class="<?php echo is_active('home', $page) ? 'active' : ''; ?>"><?php echo htmlspecialchars($nav['home'] ?? 'Home'); ?></a></li>
        <li><a href="/diensten" class="<?php echo is_active('services', $page) ? 'active' : ''; ?>"><?php echo htmlspecialchars($nav['services'] ?? 'Diensten'); ?></a></li>
        <li><a href="/websites" class="<?php echo is_active('websites', $page) ? 'active' : ''; ?>"><?php echo htmlspecialchars($nav['websites'] ?? 'Websites'); ?></a></li>
        <li><a href="/apps-systemen" class="<?php echo is_active('apps', $page) ? 'active' : ''; ?>"><?php echo htmlspecialchars($nav['apps'] ?? 'Apps & systemen'); ?></a></li>
        <li><a href="/ai-agents" class="<?php echo is_active('ai-agents', $page) ? 'active' : ''; ?>"><?php echo htmlspecialchars($nav['ai_agents'] ?? 'AI-agents'); ?></a></li>
        <li><a href="/voorbeelden" class="<?php echo is_active('cases', $page) ? 'active' : ''; ?>"><?php echo htmlspecialchars($nav['cases'] ?? 'Cases'); ?></a></li>
        <li><a href="/werkwijze" class="<?php echo is_active('workflow', $page) ? 'active' : ''; ?>"><?php echo htmlspecialchars($nav['workflow'] ?? 'Werkwijze'); ?></a></li>
        <li><a href="/contact" class="<?php echo is_active('contact', $page) ? 'active' : ''; ?>"><?php echo htmlspecialchars($nav['contact'] ?? 'Contact'); ?></a></li>
      </ul>
      <div class="nav-actions">
        <div class="lang-toggle" data-language-toggle aria-label="<?php echo htmlspecialchars($lang === 'en' ? 'Choose language' : 'Kies taal'); ?>">
          <a href="<?php echo htmlspecialchars(language_target_url($page, 'nl')); ?>" data-lang="nl" class="<?php echo $lang === 'nl' ? 'active' : ''; ?>" lang="nl" hreflang="nl" aria-current="<?php echo $lang === 'nl' ? 'true' : 'false'; ?>">NL</a>
          <span aria-hidden="true">|</span>
          <a href="<?php echo htmlspecialchars(language_target_url($page, 'en')); ?>" data-lang="en" class="<?php echo $lang === 'en' ? 'active' : ''; ?>" lang="en" hreflang="en" aria-current="<?php echo $lang === 'en' ? 'true' : 'false'; ?>">EN</a>
        </div>
        <a class="button primary" href="/contact"><?php echo htmlspecialchars($shared['cta_primary'] ?? 'Plan gratis strategiegesprek'); ?></a>
      </div>
    </nav>
  </div>
</header>
