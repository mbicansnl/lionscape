<?php
$data = content_for($content, $lang, 'legal.cookies', []);
?>
<section class="page-hero">
  <div class="container">
    <h1><?php echo htmlspecialchars($data['title'] ?? 'Cookies'); ?></h1>
    <p><?php echo htmlspecialchars($data['body'] ?? ''); ?></p>
    <p class="muted"><?php echo htmlspecialchars($data['toggle'] ?? ''); ?></p>
  </div>
</section>
