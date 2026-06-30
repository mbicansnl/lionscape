<?php
$shared = content_for($content, $lang, 'shared', []);
$home = content_for($content, $lang, 'home', []);
$cases = content_for($content, $lang, 'cases.list', []);
?>
<section class="hero makeover-hero spotlight-section">
  <div class="hero-orb hero-orb-one" aria-hidden="true"></div>
  <div class="hero-orb hero-orb-two" aria-hidden="true"></div>
  <div class="container hero-grid">
    <div class="hero-copy reveal-on-scroll">
      <p class="eyebrow hero-kicker"><span></span><?php echo htmlspecialchars($shared['proof_line'] ?? ''); ?></p>
      <h1><?php echo htmlspecialchars($home['hero']['h1'] ?? ''); ?></h1>
      <p class="lead"><?php echo htmlspecialchars($home['hero']['sub'] ?? ''); ?></p>
      <div class="cta-group">
        <a class="button primary magnetic" href="/contact"><?php echo htmlspecialchars($home['hero']['cta_primary'] ?? ''); ?></a>
        <a class="button ghost magnetic" href="#routes"><?php echo htmlspecialchars($home['hero']['cta_secondary'] ?? ''); ?></a>
      </div>
      <div class="trust-strip trust-marquee" aria-label="Vertrouwen">
        <?php foreach (($home['trust'] ?? []) as $name): ?><span><?php echo htmlspecialchars($name); ?></span><?php endforeach; ?>
      </div>
    </div>
    <div class="system-visual next-gen-visual reveal-on-scroll" aria-label="Digitale systemen visualisatie">
      <div class="visual-glow" aria-hidden="true"></div>
      <div class="visual-window"><span></span><span></span><span></span></div>
      <div class="visual-card wide pulse-card">Website, app of AI-agent</div>
      <div class="visual-row"><div>Dashboard</div><div>Klantportaal</div></div>
      <div class="visual-flow"><span>Lead</span><i></i><span>AI-agent</span><i></i><span>Actie</span></div>
      <div class="visual-metric metric-a"><strong>24/7</strong><small>automation</small></div>
      <div class="visual-metric metric-b"><strong>Slim</strong><small>proces</small></div>
    </div>
  </div>
</section>

<section id="routes" class="cards route-section bento-section"><div class="container"><p class="eyebrow reveal-on-scroll">Kies je groeiroute</p><h2 class="reveal-on-scroll"><?php echo htmlspecialchars($home['routes_title'] ?? ''); ?></h2><div class="grid-3 bento-grid">
<?php foreach (($home['routes'] ?? []) as $index => $route): ?><article class="card route-card bento-card reveal-on-scroll" style="--stagger: <?php echo (int) $index; ?>"><span class="card-index">0<?php echo (int) $index + 1; ?></span><h3><?php echo htmlspecialchars($route['title']); ?></h3><p><?php echo htmlspecialchars($route['text']); ?></p><a class="button primary magnetic" href="<?php echo htmlspecialchars($route['href']); ?>"><?php echo htmlspecialchars($route['cta']); ?></a></article><?php endforeach; ?>
</div></div></section>

<section class="problem-section spotlight-section"><div class="container grid-2"><div class="reveal-on-scroll"><p class="eyebrow">De uitdaging</p><h2><?php echo htmlspecialchars($home['problem_title'] ?? ''); ?></h2><a class="button ghost magnetic" href="/contact">Plan gratis strategiegesprek</a></div><ul class="check-list problem-list reveal-on-scroll"><?php foreach (($home['problems'] ?? []) as $problem): ?><li><?php echo htmlspecialchars($problem); ?></li><?php endforeach; ?></ul></div></section>

<section class="cards"><div class="container"><p class="eyebrow reveal-on-scroll">De oplossing</p><h2 class="reveal-on-scroll"><?php echo htmlspecialchars($home['solution_title'] ?? ''); ?></h2><div class="grid-3">
<?php foreach (($home['solutions'] ?? []) as $index => $solution): ?><article class="card service-card reveal-on-scroll" style="--stagger: <?php echo (int) $index; ?>"><h3><?php echo htmlspecialchars($solution['title']); ?></h3><p><?php echo htmlspecialchars($solution['text']); ?></p><a class="button text" href="<?php echo htmlspecialchars($solution['href']); ?>"><?php echo htmlspecialchars($solution['cta']); ?></a></article><?php endforeach; ?>
</div><p class="section-cta reveal-on-scroll"><a class="button primary magnetic" href="/contact">Plan gratis strategiegesprek</a></p></div></section>

<section class="examples-section"><div class="container"><h2 class="reveal-on-scroll"><?php echo htmlspecialchars($home['examples_title'] ?? ''); ?></h2><div class="grid-3">
<?php $exampleIndex = 0; foreach (($home['examples'] ?? []) as $title => $items): ?><article class="card reveal-on-scroll" style="--stagger: <?php echo (int) $exampleIndex++; ?>"><h3><?php echo htmlspecialchars($title); ?></h3><ul class="bullet-list"><?php foreach ($items as $item): ?><li><?php echo htmlspecialchars($item); ?></li><?php endforeach; ?></ul></article><?php endforeach; ?>
</div></div></section>

<section class="steps process-timeline"><div class="container"><h2 class="reveal-on-scroll"><?php echo htmlspecialchars($home['steps_title'] ?? ''); ?></h2><ol class="process-list"><?php foreach (($home['steps'] ?? []) as $index => $step): ?><li class="reveal-on-scroll" style="--stagger: <?php echo (int) $index; ?>"><h3><?php echo htmlspecialchars($step['title']); ?></h3><p><?php echo htmlspecialchars($step['body']); ?></p></li><?php endforeach; ?></ol></div></section>

<section class="case-highlights"><div class="container"><h2 class="reveal-on-scroll"><?php echo htmlspecialchars($home['cases_title'] ?? 'Cases'); ?></h2><div class="case-grid">
<?php foreach ($cases as $index => $case): ?><a class="case-card reveal-on-scroll" style="--stagger: <?php echo (int) $index; ?>" href="/<?php echo htmlspecialchars($case['slug']); ?>"><figure><img src="/<?php echo htmlspecialchars($case['image']); ?>" alt="<?php echo htmlspecialchars($case['image_alt']); ?>" width="320" height="240" loading="lazy"></figure><div><p class="eyebrow">Case</p><h3><?php echo htmlspecialchars($case['title']); ?></h3><p><?php echo htmlspecialchars($case['excerpt']); ?></p><span class="button primary">Bekijk case</span></div></a><?php endforeach; ?>
</div><div class="card future-card reveal-on-scroll"><h3>Volgende cases</h3><p><?php echo htmlspecialchars($home['future_case'] ?? ''); ?></p></div></div></section>

<section id="scan" class="form-block spotlight-section"><div class="container form-grid"><div class="reveal-on-scroll"><p class="eyebrow">Gratis scan</p><h2><?php echo htmlspecialchars($home['scan']['title'] ?? ''); ?></h2><p><?php echo htmlspecialchars($home['scan']['text'] ?? ''); ?></p><?php if (!empty($messages['success'])): ?><div class="notice success" role="status"><?php echo htmlspecialchars($messages['success']); ?></div><?php elseif (!empty($messages['error'])): ?><div class="notice error" role="alert"><?php echo htmlspecialchars($messages['error']); ?></div><?php endif; ?></div><?php include __DIR__ . '/partials/lead-form.php'; ?></div></section>

<section class="final-cta spotlight-section"><div class="container final-grid reveal-on-scroll"><div><h2><?php echo htmlspecialchars($home['final_cta']['title'] ?? ''); ?></h2><p><?php echo htmlspecialchars($home['final_cta']['text'] ?? ''); ?></p></div><div class="cta-actions"><a class="button primary magnetic" href="/contact"><?php echo htmlspecialchars($home['final_cta']['cta'] ?? ''); ?></a></div></div></section>
<a class="mobile-sticky-cta" href="/contact">Plan gratis strategiegesprek</a>
