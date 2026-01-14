<?php
require __DIR__ . '/partials/helpers.php';
$data = load_content_data();
$lang = current_language($data);
$pageKey = 'page-services';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/header.php';
$servicesPage = content_value('servicesPage', $lang) ?? [];
?>
<main id="main">
  <section class="page-hero">
    <div class="container page-hero__content">
      <p class="kicker"><?= h($servicesPage['title'] ?? '') ?></p>
      <h1><?= h($servicesPage['title'] ?? '') ?></h1>
      <p class="lead"><?= h($servicesPage['intro'] ?? '') ?></p>
      <a class="btn btn-primary" href="<?= h(nav_link('contact', $lang)) ?>"><?= h($servicesPage['cta'] ?? '') ?></a>
    </div>
  </section>

  <section class="section">
    <div class="container grid grid--services">
      <?php foreach (($servicesPage['items'] ?? []) as $item): ?>
        <article class="card card--static service-card--static">
          <div class="icon" aria-hidden="true"><?= svg_icon((string) ($item['icon'] ?? '')) ?></div>
          <h3><?= h($item['title'] ?? '') ?></h3>
          <p class="muted"><?= h($item['description'] ?? '') ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </section>
</main>
<?php include __DIR__ . '/partials/footer.php'; ?>
