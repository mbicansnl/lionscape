<?php
$shared = content_for($content, $lang, 'shared', []);
$home = content_for($content, $lang, 'home', []);
$cases = content_for($content, $lang, 'cases.list', []);
?>
<section class="hero makeover-hero">
  <div class="container hero-grid">
    <div>
      <p class="eyebrow"><?php echo htmlspecialchars($shared['proof_line'] ?? ''); ?></p>
      <h1><?php echo htmlspecialchars($home['hero']['h1'] ?? ''); ?></h1>
      <p class="lead"><?php echo htmlspecialchars($home['hero']['sub'] ?? ''); ?></p>
      <div class="cta-group">
        <a class="button primary" href="/contact"><?php echo htmlspecialchars($home['hero']['cta_primary'] ?? ''); ?></a>
        <a class="button ghost" href="#routes"><?php echo htmlspecialchars($home['hero']['cta_secondary'] ?? ''); ?></a>
      </div>
      <div class="trust-strip" aria-label="Vertrouwen">
        <?php foreach (($home['trust'] ?? []) as $name): ?><span><?php echo htmlspecialchars($name); ?></span><?php endforeach; ?>
      </div>
    </div>
    <div class="system-visual" aria-label="Digitale systemen visualisatie">
      <div class="visual-window"><span></span><span></span><span></span></div>
      <div class="visual-card wide">Website funnel <strong>+42% aanvragen</strong></div>
      <div class="visual-row"><div>Dashboard</div><div>Klantportaal</div></div>
      <div class="visual-flow"><span>Lead</span><i></i><span>AI-agent</span><i></i><span>Actie</span></div>
    </div>
  </div>
</section>

<section id="routes" class="cards route-section"><div class="container"><h2><?php echo htmlspecialchars($home['routes_title'] ?? ''); ?></h2><div class="grid-3">
<?php foreach (($home['routes'] ?? []) as $route): ?><article class="card route-card"><h3><?php echo htmlspecialchars($route['title']); ?></h3><p><?php echo htmlspecialchars($route['text']); ?></p><a class="button primary" href="<?php echo htmlspecialchars($route['href']); ?>"><?php echo htmlspecialchars($route['cta']); ?></a></article><?php endforeach; ?>
</div></div></section>

<section class="problem-section"><div class="container grid-2"><div><p class="eyebrow">De uitdaging</p><h2><?php echo htmlspecialchars($home['problem_title'] ?? ''); ?></h2><a class="button ghost" href="/contact">Plan gratis strategiegesprek</a></div><ul class="check-list problem-list"><?php foreach (($home['problems'] ?? []) as $problem): ?><li><?php echo htmlspecialchars($problem); ?></li><?php endforeach; ?></ul></div></section>

<section class="cards"><div class="container"><p class="eyebrow">De oplossing</p><h2><?php echo htmlspecialchars($home['solution_title'] ?? ''); ?></h2><div class="grid-3">
<?php foreach (($home['solutions'] ?? []) as $solution): ?><article class="card service-card"><h3><?php echo htmlspecialchars($solution['title']); ?></h3><p><?php echo htmlspecialchars($solution['text']); ?></p><a class="button text" href="<?php echo htmlspecialchars($solution['href']); ?>"><?php echo htmlspecialchars($solution['cta']); ?></a></article><?php endforeach; ?>
</div><p class="section-cta"><a class="button primary" href="/contact">Vertel wat je wilt bouwen</a></p></div></section>

<section class="examples-section"><div class="container"><h2><?php echo htmlspecialchars($home['examples_title'] ?? ''); ?></h2><div class="grid-3">
<?php foreach (($home['examples'] ?? []) as $title => $items): ?><article class="card"><h3><?php echo htmlspecialchars($title); ?></h3><ul class="bullet-list"><?php foreach ($items as $item): ?><li><?php echo htmlspecialchars($item); ?></li><?php endforeach; ?></ul></article><?php endforeach; ?>
</div></div></section>

<section class="steps"><div class="container"><h2><?php echo htmlspecialchars($home['steps_title'] ?? ''); ?></h2><ol class="process-list"><?php foreach (($home['steps'] ?? []) as $step): ?><li><h3><?php echo htmlspecialchars($step['title']); ?></h3><p><?php echo htmlspecialchars($step['body']); ?></p></li><?php endforeach; ?></ol></div></section>

<section class="case-highlights"><div class="container"><h2><?php echo htmlspecialchars($home['cases_title'] ?? 'Cases'); ?></h2><div class="case-grid">
<?php foreach ($cases as $case): ?><a class="case-card" href="/<?php echo htmlspecialchars($case['slug']); ?>"><figure><img src="/<?php echo htmlspecialchars($case['image']); ?>" alt="<?php echo htmlspecialchars($case['image_alt']); ?>" width="320" height="240" loading="lazy"></figure><div><p class="eyebrow">Case</p><h3><?php echo htmlspecialchars($case['title']); ?></h3><p><?php echo htmlspecialchars($case['excerpt']); ?></p><span class="button primary">Bekijk case</span></div></a><?php endforeach; ?>
</div><div class="card future-card"><h3>Volgende cases</h3><p><?php echo htmlspecialchars($home['future_case'] ?? ''); ?></p></div></div></section>

<section id="scan" class="form-block"><div class="container form-grid"><div><p class="eyebrow">Gratis scan</p><h2><?php echo htmlspecialchars($home['scan']['title'] ?? ''); ?></h2><p><?php echo htmlspecialchars($home['scan']['text'] ?? ''); ?></p><?php if (!empty($messages['success'])): ?><div class="notice success" role="status"><?php echo htmlspecialchars($messages['success']); ?></div><?php elseif (!empty($messages['error'])): ?><div class="notice error" role="alert"><?php echo htmlspecialchars($messages['error']); ?></div><?php endif; ?></div><?php include __DIR__ . '/partials/lead-form.php'; ?></div></section>

<section class="final-cta"><div class="container final-grid"><div><h2><?php echo htmlspecialchars($home['final_cta']['title'] ?? ''); ?></h2><p><?php echo htmlspecialchars($home['final_cta']['text'] ?? ''); ?></p></div><div class="cta-actions"><a class="button primary" href="/contact"><?php echo htmlspecialchars($home['final_cta']['cta'] ?? ''); ?></a><a class="button ghost" href="/prijzen">Bekijk prijzen</a></div></div></section>
<a class="mobile-sticky-cta" href="/contact">Plan gratis gesprek</a>
