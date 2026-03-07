<?php
declare(strict_types=1);

function terms_markdown_to_html(string $markdown, string $lang): string
{
    $normalized = str_replace(["\r\n", "\r"], "\n", $markdown);
    $normalized = str_replace(['\\#', '\\-', '\\.', '\\---'], ['#', '-', '.', '---'], $normalized);
    $lines = explode("\n", $normalized);

    $html = [];
    $inUnorderedList = false;
    $inOrderedList = false;

    $closeLists = static function () use (&$html, &$inUnorderedList, &$inOrderedList): void {
        if ($inUnorderedList) {
            $html[] = '</ul>';
            $inUnorderedList = false;
        }
        if ($inOrderedList) {
            $html[] = '</ol>';
            $inOrderedList = false;
        }
    };

    foreach ($lines as $rawLine) {
        $line = trim($rawLine);

        if ($line === '') {
            continue;
        }

        if ($line === '---') {
            $closeLists();
            $html[] = '<hr>';
            continue;
        }

        if (preg_match('/^###\s+(.+)$/', $line, $match)) {
            $closeLists();
            $html[] = '<h3>' . htmlspecialchars($match[1]) . '</h3>';
            continue;
        }

        if (preg_match('/^##\s+(.+)$/', $line, $match)) {
            $closeLists();
            $html[] = '<h2>' . htmlspecialchars($match[1]) . '</h2>';
            continue;
        }

        if (preg_match('/^#\s+(.+)$/', $line, $match)) {
            $closeLists();
            $html[] = '<h1>' . htmlspecialchars($match[1]) . '</h1>';
            continue;
        }

        if (preg_match('/^\d+\.\s+(.+)$/', $line, $match)) {
            if ($inUnorderedList) {
                $html[] = '</ul>';
                $inUnorderedList = false;
            }
            if (!$inOrderedList) {
                $html[] = '<ol>';
                $inOrderedList = true;
            }
            $html[] = '<li>' . htmlspecialchars($match[1]) . '</li>';
            continue;
        }

        if (preg_match('/^-\s+(.+)$/', $line, $match)) {
            if ($inOrderedList) {
                $html[] = '</ol>';
                $inOrderedList = false;
            }
            if (!$inUnorderedList) {
                $html[] = '<ul>';
                $inUnorderedList = true;
            }
            $html[] = '<li>' . htmlspecialchars($match[1]) . '</li>';
            continue;
        }

        if (filter_var($line, FILTER_VALIDATE_URL)) {
            $closeLists();
            $escaped = htmlspecialchars($line);
            $html[] = '<p><a href="' . $escaped . '" target="_blank" rel="noopener noreferrer">' . $escaped . '</a></p>';
            continue;
        }

        $closeLists();
        $class = str_starts_with(strtolower($line), 'last updated:')
            ? 'legal-doc__updated'
            : '';
        $classAttribute = $class !== '' ? ' class="' . $class . '"' : '';
        $html[] = '<p' . $classAttribute . '>' . htmlspecialchars($line) . '</p>';
    }

    $closeLists();

    return implode("\n", $html);
}

$termsFile = __DIR__ . '/../lionscape_terms.md';
$termsMarkdown = file_exists($termsFile)
    ? (string) file_get_contents($termsFile)
    : '# Terms and Conditions' . "\n\n" . ($lang === 'en' ? 'Content unavailable.' : 'Inhoud niet beschikbaar.');

$docHtml = terms_markdown_to_html($termsMarkdown, $lang);
?>
<section class="page-hero legal-doc">
  <div class="container legal-doc__container">
    <?php echo $docHtml; ?>
  </div>
</section>
