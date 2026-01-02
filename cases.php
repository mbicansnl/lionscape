<?php
require __DIR__ . '/functions.php';
$data = load_content_data();
$lang = current_language($data);
$pageKey = 'cases';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/header.php';
$cases = content_value('cases', $lang) ?? [];
$pageCopy = content_value('casesPage', $lang) ?? [];
?>
<main id="main">
  <section class="page-hero">
    <div class="container page-hero__content">
      <p class="kicker"><?= h($pageCopy['title'] ?? '') ?></p>
      <h1><?= h($pageCopy['title'] ?? '') ?></h1>
      <p class="lead"><?= h($pageCopy['intro'] ?? '') ?></p>
      <a class="btn btn-primary" href="<?= h(nav_link('contact', $lang)) ?>"><?= h($cases['cta'] ?? '') ?></a>
    </div>
  </section>

  <section class="section">
    <div class="container grid grid--cases">
      <article class="card card--static">
        <h3><?= h($cases['title'] ?? '') ?></h3>
        <p class="muted"><?= h($cases['subtitle'] ?? '') ?></p>
        <a class="card__link card__link--static" href="<?= h(nav_link('contact', $lang)) ?>">
          <span><?= h($cases['cta'] ?? '') ?></span>
        </a>
      </article>
      <article class="card card--static">
        <h3><?= h($pageCopy['title'] ?? '') ?></h3>
        <p class="muted"><?= h($pageCopy['intro'] ?? '') ?></p>
        <div class="chip">
          <span><?= h($pageCopy['filters']['industry'] ?? '') ?></span>
          <span class="chip__pill"><?= h($pageCopy['filters']['goal'] ?? '') ?></span>
        </div>
      </article>
    </div>
  </section>
</main>
<?php include __DIR__ . '/partials/footer.php'; ?>
