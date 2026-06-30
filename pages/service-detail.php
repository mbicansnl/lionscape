<?php $data = $serviceData ?? []; ?>
<section class="page-hero">
  <div class="container">
    <p class="eyebrow"><?php echo htmlspecialchars($data['eyebrow'] ?? 'Dienst'); ?></p>
    <h1><?php echo htmlspecialchars($data['h1'] ?? ''); ?></h1>
    <p class="lead"><?php echo htmlspecialchars($data['intro'] ?? ''); ?></p>
    <div class="cta-group"><a class="button primary" href="<?php echo htmlspecialchars($data['cta_href'] ?? '/contact'); ?>"><?php echo htmlspecialchars($data['cta'] ?? 'Plan gratis strategiegesprek'); ?></a></div>
  </div>
</section>
<section class="cards"><div class="container grid-3">
  <?php foreach (($data['sections'] ?? []) as $section): ?>
    <article class="card"><h2><?php echo htmlspecialchars($section['title']); ?></h2><ul class="check-list"><?php foreach ($section['items'] as $item): ?><li><?php echo htmlspecialchars($item); ?></li><?php endforeach; ?></ul></article>
  <?php endforeach; ?>
</div></section>
<section class="examples-section"><div class="container grid-2"><div><h2><?php echo htmlspecialchars($data['final_title'] ?? 'Klaar om te starten?'); ?></h2><p><?php echo htmlspecialchars($data['final_text'] ?? 'Vertel waar je tegenaan loopt. Dan denken we mee over de slimste volgende stap.'); ?></p><a class="button primary" href="<?php echo htmlspecialchars($data['final_href'] ?? ($data['cta_href'] ?? '/contact')); ?>"><?php echo htmlspecialchars($data['secondary_cta'] ?? $data['cta'] ?? 'Plan gratis strategiegesprek'); ?></a></div></div></section>
<section class="cards"><div class="container"><h2>Andere oplossingen van Lionscape</h2><div class="grid-3">
  <a class="card" href="/websites"><h3>Websites</h3><p>Voor meer aanvragen en duidelijke communicatie.</p></a>
  <a class="card" href="/apps-systemen"><h3>Apps & systemen</h3><p>Voor maatwerk software en centrale processen.</p></a>
  <a class="card" href="/ai-agents"><h3>AI-agents</h3><p>Voor automatisering van terugkerend werk.</p></a>
</div></div></section>
