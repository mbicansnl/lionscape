<?php
$data = content_for($content, $lang, 'case_jack', []);
?>
<section class="page-hero">
  <div class="container">
    <h1><?php echo htmlspecialchars($data['hero'] ?? ''); ?></h1>
    <p><?php echo htmlspecialchars($data['ask'] ?? ''); ?></p>
  </div>
</section>
section class="case-body">
  <div class="container grid-2">
    <div>
      <h2><?php echo htmlspecialchars($data['built'] ?? ''); ?></h2>
      <p><?php echo htmlspecialchars($data['why'] ?? ''); ?></p>
      <h3>Features</h3>
      <h4><a href="https://jackontracks.com/f1">Downloadable interactive calendar</a></h4>
      <p>Visitors can subscribe to the F1 calendar (webcal) so race weekends appear automatically in their own calendar app. Updates are pushed when the schedule changes, so they always have the latest dates and times without having to check the site again. It turns the website into a practical tool they use all season.</p>
      <h4><a href="https://jackontracks.com/pandora">Interactive schedule</a></h4>
      <p>Instead of a static table, the schedule is clickable and easy to scan. Users can quickly jump to a race weekend, see key sessions, and move through the season without endless scrolling. It reduces friction and keeps people engaged longer because the information is always one click away.</p>
      <h4><a href="https://jackontracks.com/f1">Interactive gallery</a></h4>
      <p>Images open in a clean viewer so visitors can browse without leaving the page. It feels fast and modern: click, view, next/previous, close, continue reading. This keeps the story flow intact while still giving the visuals the attention they deserve.</p>
      <h4><a href="https://jackontracks.com">Interactive carousel slider</a></h4>
      <p>A carousel highlights key content (for example: latest items, featured stories, partners, or highlights) in a compact space. Users can swipe/click through items quickly, which helps guide attention and makes the page feel dynamic without becoming cluttered.</p>
      <h4><a href="https://jackontracks.com/spreker">Expandable text modules</a></h4>
      <p>Longer explanations are stored behind expandable sections (read more / collapse). Visitors who want detail can open it, and visitors who want speed can keep the page short and readable. This improves mobile readability and keeps the page structure clean while still offering depth.</p>
      <a class="button primary" href="/contact" data-i18n="case_jack.cta"><?php echo htmlspecialchars($data['cta'] ?? ''); ?></a>
    </div>
    <div class="gallery">
      <?php foreach (($data['gallery'] ?? []) as $item): ?>
        <figure>
          <img src="/<?php echo htmlspecialchars($item['src']); ?>" alt="<?php echo htmlspecialchars($item['caption']); ?>" width="720" height="420" loading="lazy">
          <figcaption><?php echo htmlspecialchars($item['caption']); ?></figcaption>
        </figure>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<section class="final-cta">
  <div class="container final-grid">
    <div>
      <h2><?php echo htmlspecialchars(content_for($content, $lang, 'home.final_cta.title', '')); ?></h2>
      <p><?php echo htmlspecialchars(content_for($content, $lang, 'home.final_cta.text', '')); ?></p>
    </div>
    <div class="cta-actions">
      <a class="button primary" href="/contact"><?php echo htmlspecialchars(content_for($content, $lang, 'home.final_cta.cta', '')); ?></a>
      <a class="button ghost" href="/case-canservices"><?php echo htmlspecialchars(content_for($content, $lang, 'cases.list.1.title', '')); ?></a>
    </div>
  </div>
</section>
