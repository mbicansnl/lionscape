<?php
require __DIR__ . '/functions.php';
$data = load_content_data();
$lang = current_language($data);
$pageKey = 'privacy';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/header.php';
$privacy = content_value('privacy', $lang) ?? [];
$cookie = content_value('cookie', $lang) ?? [];
$footerContent = content_value('footer', $lang) ?? [];
?>
<main id="main">
  <section class="page-hero">
    <div class="container page-hero__content">
      <p class="kicker"><?= h($privacy['title'] ?? '') ?></p>
      <h1><?= h($privacy['title'] ?? '') ?></h1>
      <p class="lead"><?= h($privacy['intro'] ?? '') ?></p>
    </div>
  </section>
  <section class="section">
    <div class="container grid grid--privacy">
      <?php foreach (($privacy['sections'] ?? []) as $section): ?>
        <article class="card card--static">
          <h2><?= h($section['heading'] ?? '') ?></h2>
          <p class="muted"><?= h($section['body'] ?? '') ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </section>
  <section class="section section--strip" aria-label="<?= h($cookie['ariaLabel'] ?? '') ?>">
    <div class="container strip">
      <div class="strip__item">
        <div class="muted"><?= h($footerContent['privacy'] ?? '') ?></div>
        <div class="strong"><?= h($cookie['message'] ?? '') ?></div>
      </div>
      <div class="strip__item">
        <div class="muted"><?= h($cookie['policy'] ?? '') ?></div>
        <div class="strong"><?= h($cookie['accept'] ?? '') ?></div>
      </div>
    </div>
  </section>
</main>
<?php include __DIR__ . '/partials/footer.php'; ?>
