<?php
declare(strict_types=1);

session_start();

function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function load_content_data(): array
{
    static $data = null;
    if ($data === null) {
        $path = __DIR__ . '/content/site.json';
        $json = file_get_contents($path);
        $data = $json ? json_decode($json, true) : [];
        if (!is_array($data)) {
            $data = [];
        }
    }
    return $data;
}

function available_languages(array $data): array
{
    return $data['languages'] ?? ['en'];
}

function default_language(array $data): string
{
    $languages = available_languages($data);
    return $languages[0] ?? 'en';
}

function current_language(array $data): string
{
    $languages = available_languages($data);
    $default = default_language($data);
    $requested = isset($_GET['lang']) ? preg_replace('/[^a-z]/', '', (string) $_GET['lang']) : '';
    if ($requested && in_array($requested, $languages, true)) {
        setcookie('lionscape_lang', $requested, time() + 60 * 60 * 24 * 30, '/');
        return $requested;
    }
    $cookie = isset($_COOKIE['lionscape_lang']) ? preg_replace('/[^a-z]/', '', (string) $_COOKIE['lionscape_lang']) : '';
    if ($cookie && in_array($cookie, $languages, true)) {
        return $cookie;
    }
    return $default;
}

function content_value(string $path, ?string $lang = null)
{
    $data = load_content_data();
    $lang = $lang ?: current_language($data);
    $default = default_language($data);

    $root = null;
    if (str_starts_with($path, 'company') || str_starts_with($path, 'shared')) {
        $root = $data;
    } else {
        $root = $data[$lang] ?? [];
    }

    $segments = explode('.', $path);
    $value = $root;
    foreach ($segments as $segment) {
        if (!is_array($value) || !array_key_exists($segment, $value)) {
            $value = null;
            break;
        }
        $value = $value[$segment];
    }

    if ($value === null && $lang !== $default && !str_starts_with($path, 'company') && !str_starts_with($path, 'shared')) {
        $fallback = $data[$default] ?? [];
        $value = $fallback;
        foreach ($segments as $segment) {
            if (!is_array($value) || !array_key_exists($segment, $value)) {
                $value = null;
                break;
            }
            $value = $value[$segment];
        }
    }

    return $value;
}

function build_url(string $path = '', array $params = [], string $anchor = ''): string
{
    $query = http_build_query($params);
    $url = $path ?: basename(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '');
    if ($query !== '') {
        $url .= '?' . $query;
    }
    if ($anchor) {
        $url .= '#' . $anchor;
    }
    return $url;
}

function nav_link(string $sectionId, string $lang): string
{
    $current = basename(parse_url($_SERVER['PHP_SELF'] ?? '', PHP_URL_PATH) ?: '');
    if ($current === 'index.php') {
        return '#' . $sectionId;
    }
    $params = $lang ? ['lang' => $lang] : [];
    return build_url('index.php', $params, $sectionId);
}

function page_url(string $file, string $lang): string
{
    $params = [];
    if ($lang) {
        $params['lang'] = $lang;
    }
    return build_url($file, $params);
}

function consume_flash(string $key, $default = null)
{
    $value = $_SESSION[$key] ?? $default;
    if (isset($_SESSION[$key])) {
        unset($_SESSION[$key]);
    }
    return $value;
}

function sanitize_csv_field(string $value): string
{
    $trimmed = trim($value);
    if ($trimmed === '') {
        return '';
    }
    $first = substr($trimmed, 0, 1);
    if (in_array($first, ['=', '+', '-', '@'], true)) {
        return "'" . $trimmed;
    }
    return $trimmed;
}

function svg_icon(string $name): string
{
    $icons = [
        'interface' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 6.5h16v-2H4v2Zm0 6h16v-2H4v2Zm0 6h16v-2H4v2Z" fill="currentColor" opacity="0.7"/><path d="M8 5v14M16 5v14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',
        'seo' => '<svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="9" cy="9" r="5" stroke="currentColor" stroke-width="1.5"/><path d="m14 14 6 6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><path d="M7 9h4M9 7v4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',
        'ads' => '<svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3.5" y="5" width="17" height="14" rx="2.5" stroke="currentColor" stroke-width="1.5"/><path d="M7.5 9.5h5.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><path d="M7.5 12H16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><path d="M7.5 14.5H12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><path d="M16 16.5c1.5 0 2.7-1.2 2.7-2.7S17.5 11 16 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',
        'conversion' => '<svg viewBox="0 0 24 24" aria-hidden="true"><rect x="4" y="4" width="16" height="16" rx="3" stroke="currentColor" stroke-width="1.5"/><path d="M7 12.5 10 16l7-8" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'content' => '<svg viewBox="0 0 24 24" aria-hidden="true"><rect x="5" y="3" width="14" height="18" rx="2.5" stroke="currentColor" stroke-width="1.5"/><path d="M8 8.5h8M8 12h6M8 15.5h5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',
        'social' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 6.5c0-.8.7-1.5 1.5-1.5h13c.8 0 1.5.7 1.5 1.5v11c0 .8-.7 1.5-1.5 1.5h-13C4.7 19 4 18.3 4 17.5v-11Z" stroke="currentColor" stroke-width="1.5"/><path d="M8 10a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm8.5-2h-5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><circle cx="16.5" cy="12" r="2" fill="currentColor" opacity="0.6"/></svg>',
        'data' => '<svg viewBox="0 0 24 24" aria-hidden="true"><ellipse cx="12" cy="6" rx="7.5" ry="3.5" stroke="currentColor" stroke-width="1.5"/><path d="M4.5 6v12c0 1.9 3.4 3.5 7.5 3.5s7.5-1.6 7.5-3.5V6" stroke="currentColor" stroke-width="1.5"/><path d="M4.8 12c1.1 1.2 3.8 2 7.2 2s6.1-.8 7.2-2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>'
    ];

    return $icons[$name] ?? '';
}
