<?php
$data = content_for($content, $lang, 'cases', []);
?>
<section class="page-hero">
  <div class="container">
    <h1 data-i18n="nav.cases"><?php echo htmlspecialchars(content_for($content, $lang, 'nav.cases', 'Voorbeelden')); ?></h1>
    <p><?php echo htmlspecialchars($data['intro'] ?? ''); ?></p>
  </div>
</section>
<section class="cards">
  <div class="container grid-2">
    <?php foreach (($data['list'] ?? []) as $case): ?>
      <article class="card">
        <figure>
          <img src="/<?php echo htmlspecialchars($case['image']); ?>" alt="<?php echo htmlspecialchars($case['title']); ?>" width="540" height="320" loading="lazy">
        </figure>
        <h2><?php echo htmlspecialchars($case['title']); ?></h2>
        <p><?php echo htmlspecialchars($case['excerpt']); ?></p>
        <a class="button primary" href="/<?php echo htmlspecialchars($case['slug']); ?>">Bekijk</a>
      </article>
    <?php endforeach; ?>
  </div>
</section>
