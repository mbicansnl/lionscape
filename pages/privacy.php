<?php
$data = content_for($content, $lang, 'legal.privacy', []);
$shared = content_for($content, $lang, 'shared', []);
?>
<section class="page-hero">
  <div class="container">
    <h1><?php echo htmlspecialchars($data['title'] ?? 'Privacy'); ?></h1>
    <p><?php echo htmlspecialchars($data['body'] ?? ''); ?></p>
    <p class="muted"><?php echo htmlspecialchars($shared['last_update_label'] ?? ''); ?>: <?php echo date('Y-m-d'); ?></p>
  </div>
</section>
