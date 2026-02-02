<?php
$shared = content_for($content, $lang, 'shared', []);
$home = content_for($content, $lang, 'home', []);
$cases = content_for($content, $lang, 'cases.list', []);
$heroCase = $cases[0] ?? [];
$secondaryCase = $cases[1] ?? [];
?>
<section class="hero">
  <div class="container hero-grid">
    <div class="hero-visual">
      <figure>
        <img src="/LionScape-logo-full.png" alt="LionScape preview" width="720" height="480" loading="lazy">
      </figure>
    </div>
    <div>
      <p class="eyebrow" data-i18n="shared.proof_line"><?php echo htmlspecialchars($shared['proof_line'] ?? ''); ?></p>
      <h1 data-i18n="home.hero.h1"><?php echo htmlspecialchars($home['hero']['h1'] ?? ''); ?></h1>
      <p class="lead" data-i18n="home.hero.sub"><?php echo htmlspecialchars($home['hero']['sub'] ?? ''); ?></p>
      <div class="cta-group">
        <a class="button primary" href="/contact" data-i18n="home.hero.cta_primary"><?php echo htmlspecialchars($home['hero']['cta_primary'] ?? ''); ?></a>
        <a class="button primary" href="/case-jack" data-i18n="home.hero.cta_secondary"><?php echo htmlspecialchars($home['hero']['cta_secondary'] ?? ''); ?></a>
        <a class="button text" href="#scan" data-i18n="home.hero.cta_scan"><?php echo htmlspecialchars($home['hero']['cta_scan'] ?? ''); ?></a>
      </div>
      <div class="trust-strip" aria-label="<?php echo htmlspecialchars($shared['trust_label'] ?? ''); ?>">
        <?php foreach (($home['trust'] ?? []) as $name): ?>
          <span><?php echo htmlspecialchars($name); ?></span>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<section class="cards">
  <div class="container">
    <h2 data-i18n="home.cards_title"><?php echo htmlspecialchars($home['cards_title'] ?? ''); ?></h2>
    <div class="grid-3">
      <?php foreach (($home['cards'] ?? []) as $card): ?>
        <article class="card">
          <h3><?php echo htmlspecialchars($card['title']); ?></h3>
          <p><?php echo htmlspecialchars($card['text']); ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="case-highlights">
  <div class="container case-grid">
    <a class="case-card highlight-grid" href="/case-jack">
      <div>
        <p class="eyebrow" data-i18n="home.featured.title"><?php echo htmlspecialchars($home['featured']['title'] ?? ''); ?></p>
        <h2><?php echo htmlspecialchars($home['featured']['text'] ?? ''); ?></h2>
        <span class="button primary" data-i18n="home.featured.cta"><?php echo htmlspecialchars($home['featured']['cta'] ?? ''); ?></span>
      </div>
      <figure>
        <img src="/assets/img/jackontracks-logo.png" alt="<?php echo htmlspecialchars($heroCase['image_alt'] ?? $heroCase['title'] ?? ''); ?>" width="320" height="240" loading="lazy">
        <figcaption data-i18n="home.featured.title"><?php echo htmlspecialchars($home['featured']['title'] ?? ''); ?></figcaption>
      </figure>
    </a>
    <a class="case-card highlight-grid" href="/case-canservices">
      <figure>
        <img src="/assets/img/canservices.nl-logo.png" alt="<?php echo htmlspecialchars($secondaryCase['image_alt'] ?? $secondaryCase['title'] ?? ''); ?>" width="320" height="240" loading="lazy">
        <figcaption data-i18n="home.secondary.title"><?php echo htmlspecialchars($home['secondary']['title'] ?? ''); ?></figcaption>
      </figure>
      <div>
        <p class="eyebrow" data-i18n="home.secondary.title"><?php echo htmlspecialchars($home['secondary']['title'] ?? ''); ?></p>
        <h2><?php echo htmlspecialchars($home['secondary']['text'] ?? ''); ?></h2>
        <span class="button primary" data-i18n="home.secondary.cta"><?php echo htmlspecialchars($home['secondary']['cta'] ?? ''); ?></span>
      </div>
    </a>
  </div>
</section>

<section class="steps">
  <div class="container">
    <h2 data-i18n="home.steps_title"><?php echo htmlspecialchars($home['steps_title'] ?? ''); ?></h2>
    <ol class="step-list">
      <?php foreach (($home['steps'] ?? []) as $step): ?>
        <li><?php echo htmlspecialchars($step); ?></li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>

<section id="scan" class="form-block">
  <div class="container form-grid">
    <div>
      <h2 data-i18n="home.scan.title"><?php echo htmlspecialchars($home['scan']['title'] ?? ''); ?></h2>
      <p data-i18n="home.scan.text"><?php echo htmlspecialchars($home['scan']['text'] ?? ''); ?></p>
      <?php if (!empty($messages['success'])): ?>
        <div class="notice success" role="status"><?php echo htmlspecialchars($messages['success']); ?></div>
      <?php elseif (!empty($messages['error'])): ?>
        <div class="notice error" role="alert"><?php echo htmlspecialchars($messages['error']); ?></div>
      <?php endif; ?>
    </div>
    <form method="post" novalidate>
      <input type="hidden" name="form_type" value="scan">
      <label>
        <span data-i18n="shared.form.name"><?php echo htmlspecialchars($shared['form']['name'] ?? ''); ?></span>
        <input type="text" name="name" required>
      </label>
      <label>
        <span data-i18n="shared.form.email"><?php echo htmlspecialchars($shared['form']['email'] ?? ''); ?></span>
        <input type="email" name="email" required>
      </label>
      <label>
        <span data-i18n="shared.form.phone"><?php echo htmlspecialchars($shared['form']['phone'] ?? ''); ?></span>
        <input type="text" name="phone">
      </label>
      <label>
        <span data-i18n="shared.form.message"><?php echo htmlspecialchars($shared['form']['message'] ?? ''); ?></span>
        <textarea name="message" rows="4"></textarea>
      </label>
      <label class="hidden">
        <span><?php echo htmlspecialchars($shared['honeypot'] ?? ''); ?></span>
        <input type="text" name="note" tabindex="-1" autocomplete="off">
      </label>
      <button class="button primary" type="submit" data-i18n="shared.form.submit"><?php echo htmlspecialchars($shared['form']['submit'] ?? ''); ?></button>
    </form>
  </div>
</section>

<section class="faq">
  <div class="container">
    <h2 data-i18n="shared.faq_title"><?php echo htmlspecialchars($shared['faq_title'] ?? 'FAQ'); ?></h2>
    <div class="accordion">
      <?php foreach (($home['faq'] ?? []) as $item): ?>
        <details>
          <summary><?php echo htmlspecialchars($item['q']); ?></summary>
          <p><?php echo htmlspecialchars($item['a']); ?></p>
        </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="final-cta">
  <div class="container final-grid">
    <div>
      <h2 data-i18n="home.final_cta.title"><?php echo htmlspecialchars($home['final_cta']['title'] ?? ''); ?></h2>
      <p data-i18n="home.final_cta.text"><?php echo htmlspecialchars($home['final_cta']['text'] ?? ''); ?></p>
    </div>
    <div class="cta-actions">
      <a class="button primary" href="/contact" data-i18n="home.final_cta.cta"><?php echo htmlspecialchars($home['final_cta']['cta'] ?? ''); ?></a>
      <a class="button ghost" href="/prijzen" data-i18n="nav.pricing"><?php echo htmlspecialchars(content_for($content, $lang, 'nav.pricing', 'Prijzen')); ?></a>
    </div>
  </div>
</section>
