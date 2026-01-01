# LionScape Website

Premium, high-conversion marketing site for LionScape (webdesign & SEO agency in Bergen op Zoom). Built with plain PHP, HTML, CSS, and vanilla JS—no build tools needed.

## Run locally
1. Install PHP 8+
2. From the project root, start the server:
   ```bash
   php -S localhost:8080
   ```
3. Open http://localhost:8080/index.php

## Content management
- All copy (EN/NL) lives in `content/site.json`.
- Update text there; PHP templates render from this single source of truth.
- Language is toggled via the `lang` query parameter or the header toggle.

## Forms & storage
- Contact form posts to `api/contact.php` (works without JS).
- Leads append to `storage/leads.csv` (CSV injection-safe, includes timestamp + IP).
- Basic anti-spam: honeypot + IP rate limiting.

## Structure
- `index.php` — Landing page
- `cases.php` — Case study listing with filters
- `privacy.php` — Privacy & cookie policy
- `partials/` — Shared head, header, footer
- `assets/css/style.css` — Single stylesheet
- `assets/js/main.js` — Progressive enhancement (nav, FAQ, cookie banner)
- `assets/img/logo.svg` — Logo used for meta/structured data

## Privacy & cookies
- Minimal cookie banner stores consent in `localStorage`.
- Analytics placeholder only triggers after consent (hook event `lionscape:consent`).

