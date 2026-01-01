<?php
require __DIR__ . '/functions.php';
$data = load_content_data();
$lang = current_language($data);
$pageKey = 'cases';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/header.php';
$cases = content_value('cases', $lang) ?? [];
$pageCopy = content_value('casesPage', $lang) ?? [];
$caseItems = $cases['items'] ?? [];
$sharedIndustries = array_values(array_unique(array_filter(array_map(fn ($case) => $case['industry'] ?? '', $caseItems))));
$sharedGoals = array_values(array_unique(array_filter(array_map(fn ($case) => $case['goal'] ?? '', $caseItems))));
$industryFilter = isset($_GET['industry']) ? trim((string) $_GET['industry']) : '';
$goalFilter = isset($_GET['goal']) ? trim((string) $_GET['goal']) : '';
$filtered = array_filter($caseItems, function ($case) use ($industryFilter, $goalFilter) {
    $matchesIndustry = $industryFilter === '' || (isset($case['industry']) && $case['industry'] === $industryFilter);
    $matchesGoal = $goalFilter === '' || (isset($case['goal']) && $case['goal'] === $goalFilter);
    return $matchesIndustry && $matchesGoal;
});
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
    <div class="container filters">
      <form class="filters__form" method="get" action="">
        <input type="hidden" name="lang" value="<?= h($lang) ?>">
        <label>
          <span class="muted"><?= h($pageCopy['filters']['industry'] ?? '') ?></span>
          <select name="industry">
            <option value=""><?= h($pageCopy['filters']['all'] ?? '') ?></option>
            <?php foreach ($sharedIndustries as $industry): ?>
              <option value="<?= h($industry) ?>" <?= $industryFilter === $industry ? 'selected' : '' ?>><?= h($industry) ?></option>
            <?php endforeach; ?>
          </select>
        </label>
        <label>
          <span class="muted"><?= h($pageCopy['filters']['goal'] ?? '') ?></span>
          <select name="goal">
            <option value=""><?= h($pageCopy['filters']['all'] ?? '') ?></option>
            <?php foreach ($sharedGoals as $goal): ?>
              <option value="<?= h($goal) ?>" <?= $goalFilter === $goal ? 'selected' : '' ?>><?= h($goal) ?></option>
            <?php endforeach; ?>
          </select>
        </label>
        <button class="btn btn-secondary" type="submit"><?= h($cases['cta'] ?? '') ?></button>
      </form>
    </div>
    <div class="container grid grid--cases">
      <?php foreach ($filtered as $case): ?>
        <article class="card card--static">
          <div class="chip">
            <span><?= h($case['industry'] ?? '') ?></span>
            <span class="chip__pill"><?= h($case['goal'] ?? '') ?></span>
          </div>
          <h3><?= h($case['name'] ?? '') ?></h3>
          <p class="highlight"><?= h($case['result'] ?? '') ?></p>
          <p class="muted"><?= h($case['detail'] ?? '') ?></p>
        </article>
      <?php endforeach; ?>
      <?php if (empty($filtered)): ?>
        <p class="muted"><?= h($pageCopy['intro'] ?? '') ?></p>
      <?php endif; ?>
    </div>
  </section>
</main>
<?php include __DIR__ . '/partials/footer.php'; ?>
