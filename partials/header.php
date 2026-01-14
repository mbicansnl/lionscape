<?php
$data = load_content_data();
$lang = $lang ?? current_language($data);
$nav = content_value('nav', $lang) ?? [];
$currentPage = basename(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: 'index.php');
$languages = available_languages($data);
$targetLang = $lang;
$logoMark = strtoupper(substr((string) ($nav['logo'] ?? 'LS'), 0, 2));
if (count($languages) > 1) {
    foreach ($languages as $candidate) {
        if ($candidate !== $lang) {
            $targetLang = $candidate;
            break;
        }
    }
}
?>
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
        </div>
      </div>
    </nav>
  </div>
</header>
