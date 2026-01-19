# LionScape bilingual site

Complete bilingual (NL default, EN) PHP 8.2 website for a one-person business serving public figures. Text lives in `data/content.json` under `nl` and `en` keys. Routing is handled by `index.php` with PHP templates.

## Run locally
1. `php -S localhost:8000` from the project root.
2. Open `http://localhost:8000`.

## Language logic
- Default language is NL.
- Order: URL `?lang=...` overrides, then `lang_pref` cookie/localStorage, then NL.
- Header (and mobile menu) show `NL | EN` toggles. With JavaScript, switching fetches the fragment (`?fragment=1`) and updates the DOM without reload; without JavaScript, the links reload with the lang query.
- The HTML `lang` attribute updates client-side when switching.

## Forms
- Contact and growth scan forms use server-side validation (name + email) and a honeypot (`note`).
- Submissions are stored as JSON lines in `storage/submissions.log` (created automatically). PRG redirects with `?success=1`.

## PWA
- Manifest at `pwa/manifest.webmanifest`.
- Service worker `pwa/sw.js` caches static assets (cache-first) and HTML (network-first) with offline fallback `pwa/offline.html`.

## Screenshots
- Required outputs are in `assets/img/cases/`. A Playwright script is included in `tools/screenshot.js` to capture real screenshots of `jackontracks.nl` and `canservices.nl` at desktop width.
- Because npm registry access is blocked in this environment (403), the committed PNGs are placeholders. Regenerate real captures in a networked environment:
  ```bash
  cd tools
  npm install
  npm run capture
  ```
  The script saves PNGs to `assets/img/cases/` relative to the repo root.

## SEO and sitemap
- Meta titles/descriptions come from `data/content.json` per page.
- Canonical URLs use clean paths; EN uses `?lang=en`.
- JSON-LD is injected for BreadcrumbList, LocalBusiness, WebSite, and Article on case pages.
- `sitemap.php` outputs `sitemap.xml`; `robots.txt` references it.

## Structure
- `index.php` front controller with fragment responses for language switching.
- `bootstrap.php` helpers for content, routing, meta, schema, forms.
- `pages/` contains templates: home, services (aanpak), cases, individual case pages, pricing, about, contact, legal, 404.
- `assets/css/styles.css` modern responsive styling (no external assets), `assets/js/app.js` for language toggle, mobile nav, SW registration.
- `pwa/` holds manifest, service worker, offline fallback.
- `tools/` contains the screenshot automation.
