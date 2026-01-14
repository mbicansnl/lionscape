<?php
declare(strict_types=1);
require __DIR__ . '/bootstrap.php';
$lang = detect_lang($content);
header('Content-Type: application/xml');
$pages = ['home','services','cases','case-jack','case-canservices','pricing','about','contact','privacy','cookies'];
$urls = [];
foreach ($pages as $page) {
    foreach (supported_langs($content) as $lng) {
        $urls[] = canonical_url($page, $lng);
    }
}
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($urls as $loc): ?>
  <url>
    <loc><?php echo htmlspecialchars($loc, ENT_XML1); ?></loc>
    <changefreq>weekly</changefreq>
  </url>
<?php endforeach; ?>
</urlset>
