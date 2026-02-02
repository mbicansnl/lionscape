<?php
$data = content_for($content, $lang, 'cases', []);
$shared = content_for($content, $lang, 'shared', []);
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
      <a class="card" href="/<?php echo htmlspecialchars($case['slug']); ?>">
        <figure>
          <img src="/<?php echo htmlspecialchars($case['image']); ?>" alt="<?php echo htmlspecialchars($case['image_alt'] ?? $case['title']); ?>" width="540" height="320" loading="lazy" decoding="async">
        </figure>
        <h2><?php echo htmlspecialchars($case['title']); ?></h2>
        <p><?php echo htmlspecialchars($case['excerpt']); ?></p>
        <span class="button primary" data-i18n="shared.cta_view_case"><?php echo htmlspecialchars($shared['cta_view_case'] ?? 'Bekijk'); ?></span>
      </a>
    <?php endforeach; ?>
  </div>
</section>
