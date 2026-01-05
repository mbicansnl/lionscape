<?php
require __DIR__ . '/functions.php';
$data = load_content_data();
$lang = current_language($data);
$pageKey = 'home';
$errors = consume_flash('contact_errors') ?? [];
$old = consume_flash('contact_old') ?? [];
$fieldErrors = $errors['fields'] ?? [];
$success = consume_flash('contact_success') ?? (isset($_GET['sent']) ? true : false);
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/header.php';
$hero = content_value('hero', $lang) ?? [];
$bento = content_value('bento', $lang) ?? [];
$services = content_value('services', $lang) ?? [];
$process = content_value('process', $lang) ?? [];
$faq = content_value('faq', $lang) ?? [];
$contact = content_value('contact', $lang) ?? [];
$privacyContent = content_value('privacy', $lang) ?? [];
$footerContent = content_value('footer', $lang) ?? [];
$sharedSeo = content_value('shared.seoStrip') ?? [];
$sharedSocial = content_value('shared.socialLinks') ?? [];
$company = content_value('company');
?>
<main id="main">
  <section class="hero" id="hero">
    <div class="container hero__grid">
      <div class="hero__content">
        <p class="kicker"><?= h($hero['eyebrow'] ?? '') ?></p>
        <h1><?= h($hero['headline'] ?? '') ?></h1>
        <p class="lead"><?= h($hero['subheadline'] ?? '') ?></p>
        <div class="hero__actions">
          <a class="btn btn-primary" href="<?= h(nav_link('contact', $lang)) ?>"><?= h($hero['primaryCta'] ?? '') ?></a>
          <a class="btn btn-secondary" href="<?= h(nav_link('services', $lang)) ?>"><?= h($hero['secondaryCta'] ?? '') ?></a>
        </div>
        <div class="hero__logos">
          <span class="muted"><?= h($hero['logosLabel'] ?? '') ?></span>
          <div class="logo-row">
            <?php foreach (($hero['logos'] ?? []) as $logo): ?>
              <span class="chip chip--glass"><?= h($logo) ?></span>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <div class="hero__panel card card--static">
        <div class="hero__glow"></div>
        <div class="metrics">
          <?php foreach (($hero['metrics'] ?? []) as $metric): ?>
            <div class="metric">
              <div class="metric__value"><?= h($metric['label'] ?? '') ?></div>
              <div class="metric__detail muted"><?= h($metric['detail'] ?? '') ?></div>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="hero__footer">
          <div class="muted"><?= h($services['subtitle'] ?? '') ?></div>
        </div>
      </div>
    </div>
  </section>

  <section class="section" id="bento">
    <div class="container section__header">
      <div>
        <p class="kicker"><?= h($bento['title'] ?? '') ?></p>
        <h2><?= h($bento['subtitle'] ?? '') ?></h2>
      </div>
    </div>
    <div class="container bento-grid">
      <?php foreach (($bento['cards'] ?? []) as $card): ?>
        <?php $isAction = !empty($card['action']); ?>
        <article class="card <?= $isAction ? 'card--action' : 'card--static' ?>">
          <div class="card__body">
            <h3><?= h($card['title'] ?? '') ?></h3>
            <p class="muted"><?= h($card['description'] ?? '') ?></p>
          </div>
          <?php if ($isAction): ?>
            <a class="card__link" href="<?= h(nav_link(ltrim((string) ($card['link'] ?? ''), '#'), $lang)) ?>">
              <span><?= h($card['cta'] ?? '') ?></span>
              <span aria-hidden="true">→</span>
            </a>
          <?php else: ?>
            <div class="card__link card__link--static">
              <span><?= h($card['cta'] ?? '') ?></span>
            </div>
          <?php endif; ?>
        </article>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="section" id="services">
    <div class="container section__header">
      <div>
        <p class="kicker"><?= h($services['title'] ?? '') ?></p>
        <h2><?= h($services['subtitle'] ?? '') ?></h2>
      </div>
    </div>
    <div class="container grid grid--services">
      <?php foreach (($services['items'] ?? []) as $item): ?>
        <a class="card card--action service-card" href="<?= h(nav_link('contact', $lang)) ?>">
          <div class="icon" aria-hidden="true"><?= svg_icon((string) ($item['icon'] ?? '')) ?></div>
          <h3><?= h($item['title'] ?? '') ?></h3>
          <p class="muted"><?= h($item['description'] ?? '') ?></p>
        </a>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="section" id="process">
    <div class="container section__header">
      <div>
        <p class="kicker"><?= h($process['title'] ?? '') ?></p>
        <h2><?= h($process['subtitle'] ?? '') ?></h2>
      </div>
    </div>
    <div class="container grid grid--process">
      <?php foreach (($process['steps'] ?? []) as $index => $step): ?>
        <a class="card card--action step-card" href="<?= h(nav_link('contact', $lang)) ?>">
          <div class="pill">0<?= h((string) ($index + 1)) ?></div>
          <h3><?= h($step['title'] ?? '') ?></h3>
          <p class="muted"><?= h($step['description'] ?? '') ?></p>
        </a>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="section section--strip" aria-label="<?= h($services['title'] ?? '') ?>">
    <div class="container strip">
      <?php foreach ($sharedSeo as $item): ?>
        <div class="strip__item">
          <div class="muted"><?= h($item['label'] ?? '') ?></div>
          <div class="strong"><?= h($item['value'] ?? '') ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="section section--privacy" id="privacy">
    <div class="container section__header">
      <div>
        <p class="kicker"><?= h($privacyContent['title'] ?? '') ?></p>
        <h2><?= h($privacyContent['intro'] ?? '') ?></h2>
      </div>
      <a class="btn btn-secondary" href="<?= h(page_url('privacy.php', $lang)) ?>"><?= h($footerContent['privacy'] ?? '') ?></a>
    </div>
    <div class="container grid grid--privacy">
      <?php foreach (array_slice(($privacyContent['sections'] ?? []), 0, 2) as $section): ?>
        <a class="card card--action" href="<?= h(page_url('privacy.php', $lang)) ?>">
          <h3><?= h($section['heading'] ?? '') ?></h3>
          <p class="muted"><?= h($section['body'] ?? '') ?></p>
        </a>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="section" id="faq">
    <div class="container section__header">
      <div>
        <p class="kicker"><?= h($faq['title'] ?? '') ?></p>
        <h2><?= h($process['title'] ?? '') ?></h2>
      </div>
    </div>
    <div class="container faq">
      <?php foreach (($faq['items'] ?? []) as $index => $item): ?>
        <?php $faqId = 'faq-item-' . $index; ?>
        <article class="faq__item">
          <button class="faq__question" aria-expanded="false" aria-controls="<?= h($faqId) ?>">
            <span><?= h($item['question'] ?? '') ?></span>
            <span aria-hidden="true">+</span>
          </button>
          <div class="faq__answer" id="<?= h($faqId) ?>" hidden>
            <p><?= h($item['answer'] ?? '') ?></p>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="section" id="contact">
    <div class="container contact">
      <div class="contact__info card card--static">
        <p class="kicker"><?= h($contact['title'] ?? '') ?></p>
        <h2><?= h($contact['subtitle'] ?? '') ?></h2>
        <?php if ($success): ?>
          <div class="alert alert--success"><?= h($contact['success'] ?? '') ?></div>
        <?php endif; ?>
        <?php if (!empty($errors)): ?>
          <div class="alert alert--error"><?= h($errors['message'] ?? '') ?></div>
        <?php endif; ?>
        <div class="contact__meta">
          <a class="btn btn-secondary" href="tel:<?= h(preg_replace('/\s+/', '', (string) ($company['phone'] ?? ''))) ?>"><?= h($contact['details']['cta'] ?? '') ?></a>
        </div>
        <div class="contact__social">
          <?php foreach ($sharedSocial as $social): ?>
            <a class="chip chip--glass" href="<?= h($social['href'] ?? '#') ?>" target="_blank" rel="noopener"><?= h($social['label'] ?? '') ?></a>
          <?php endforeach; ?>
        </div>
      </div>
      <form class="card card--static contact__form" action="api/contact.php" method="post">
        <div class="field">
          <label for="name"><?= h($contact['fields']['name'] ?? '') ?></label>
          <input type="text" id="name" name="name" value="<?= h((string) ($old['name'] ?? '')) ?>" required aria-invalid="<?= isset($fieldErrors['name']) ? 'true' : 'false' ?>">
          <?php if (!empty($fieldErrors['name'])): ?><span class="field__error"><?= h($fieldErrors['name']) ?></span><?php endif; ?>
        </div>
        <div class="field">
          <label for="email"><?= h($contact['fields']['email'] ?? '') ?></label>
          <input type="email" id="email" name="email" value="<?= h((string) ($old['email'] ?? '')) ?>" required aria-invalid="<?= isset($fieldErrors['email']) ? 'true' : 'false' ?>">
          <?php if (!empty($fieldErrors['email'])): ?><span class="field__error"><?= h($fieldErrors['email']) ?></span><?php endif; ?>
        </div>
        <div class="field">
          <label for="phone"><?= h($contact['fields']['phone'] ?? '') ?></label>
          <input type="tel" id="phone" name="phone" value="<?= h((string) ($old['phone'] ?? '')) ?>">
        </div>
        <div class="field">
          <label for="service"><?= h($contact['fields']['service'] ?? '') ?></label>
          <select id="service" name="service">
            <?php foreach (($contact['services'] ?? []) as $service): ?>
              <option value="<?= h($service) ?>" <?= (isset($old['service']) && $old['service'] === $service) ? 'selected' : '' ?>><?= h($service) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="field">
          <label for="message"><?= h($contact['fields']['message'] ?? '') ?></label>
          <textarea id="message" name="message" rows="4" required aria-invalid="<?= isset($fieldErrors['message']) ? 'true' : 'false' ?>"><?= h((string) ($old['message'] ?? '')) ?></textarea>
          <?php if (!empty($fieldErrors['message'])): ?><span class="field__error"><?= h($fieldErrors['message']) ?></span><?php endif; ?>
        </div>
        <div class="field field--hidden">
          <label for="website"><?= h($contact['fields']['honeypot'] ?? '') ?></label>
          <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
        </div>
        <div class="form__actions">
          <button class="btn btn-primary" type="submit"><?= h($contact['submit'] ?? '') ?></button>
        </div>
      </form>
    </div>
  </section>
</main>
<?php include __DIR__ . '/partials/footer.php'; ?>
