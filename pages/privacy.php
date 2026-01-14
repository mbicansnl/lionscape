<?php
$data = content_for($content, $lang, 'legal.privacy', []);
?>
<section class="page-hero">
  <div class="container">
    <h1><?php echo htmlspecialchars($data['title'] ?? 'Privacy'); ?></h1>
    <p><?php echo htmlspecialchars($data['body'] ?? ''); ?></p>
    <p class="muted">Last update: <?php echo date('Y-m-d'); ?></p>
  </div>
</section>
