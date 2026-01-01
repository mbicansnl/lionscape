\# AGENTS.md - LionScape Website Consistency Guide



This file defines non-negotiable rules for Codex/agents working on the LionScape website. Follow these rules to keep the codebase consistent, fast, accessible, and easy to maintain.



\## 1) Project goals

\- Primary goal: generate qualified leads.

\- Secondary goal: establish trust and premium positioning.

\- Tertiary goal: performance + SEO excellence.



\## 2) Stack and constraints (do not violate)

\- Plain PHP + HTML5 + CSS + vanilla JavaScript only.

\- No build step required.

\- No external runtime dependencies needed to run locally.

\- Progressive enhancement: core navigation and contact form must work without JavaScript.



\## 3) Architecture and file structure

Keep and use this structure:

\- `index.php`: landing page (section-based).

\- `cases.php`: optional cases listing (if present, keep it lightweight).

\- `privacy.php`: privacy and cookie policy.

\- `/partials`: reusable layout fragments only.

&nbsp; - `head.php`, `header.php`, `footer.php`

\- `/content/site.json`: single source of truth for copy (NL/EN).

\- `/assets/css/style.css`: one stylesheet (prefer extending with sections, not new files).

\- `/assets/js/main.js`: one JS file (modular via IIFE or simple modules).

\- `/api/contact.php`: contact form endpoint.

\- `/storage/leads.csv`: lead storage (create if missing).



Do not add new top-level folders unless required.



\## 4) Content rules (single source of truth)

\- All user-facing copy must live in `/content/site.json` (NL and EN).

\- PHP files must render copy from the JSON model.

\- Never hardcode text in templates except:

&nbsp; - minimal ARIA labels

&nbsp; - error fallbacks (short)

\- If adding a new section:

&nbsp; - add corresponding JSON keys for NL/EN

&nbsp; - keep key naming consistent and predictable



\## 5) Design system rules (CSS variables + components)

\- All colors are defined via CSS variables in `:root` and `.theme-dark` (if used).

\- No arbitrary hex colors inside component rules (except gradients that reference variables).

\- Use a consistent spacing scale (e.g., 4/8/12/16/24/32/48/64).

\- Use a consistent radius scale (e.g., 12/16/24).

\- Typography:

&nbsp; - Use system font stack only (no external fonts).

&nbsp; - Maintain clear hierarchy (H1 > H2 > H3).

\- Components must follow a small set of patterns:

&nbsp; - `.btn`, `.btn-primary`, `.btn-secondary`

&nbsp; - `.card` (base), `.card--action` (clickable), `.card--static` (non-clickable)

&nbsp; - `.pill`, `.chip`, `.kicker`

&nbsp; - `.grid`, `.bento`, `.container`, `.section`



\## 6) Interactivity consistency rule (CRITICAL)

Hover effects must communicate action.



\- Clickable elements (links, buttons, cards that navigate/open):

&nbsp; - must use `cursor: pointer;`

&nbsp; - must have hover + focus-visible styles

&nbsp; - may include subtle lift/glow/translate (small, tasteful)



\- Non-clickable elements (informational cards/blocks):

&nbsp; - must NOT use hover lift or glow

&nbsp; - must NOT use pointer cursor

&nbsp; - must remain visually stable on hover



Implementation guideline:

\- Use `.card--action` for clickable cards.

\- Use `.card--static` for non-clickable cards.

\- Never attach click handlers to `.card--static`.



\## 7) JavaScript rules (small, safe, accessible)

\- Keep JS minimal and defensive.

\- Always use `defer` on script includes.

\- Never rely on JS for:

&nbsp; - essential navigation

&nbsp; - submitting the contact form

\- Respect user preferences:

&nbsp; - implement `prefers-reduced-motion` in CSS

&nbsp; - avoid heavy animations; keep transitions subtle

\- Mobile nav:

&nbsp; - focus trap

&nbsp; - ESC closes

&nbsp; - body scroll lock

\- FAQ accordion:

&nbsp; - buttons for toggles (not div click)

&nbsp; - aria-expanded and aria-controls updated properly



\## 8) Forms and API rules

Contact form requirements:

\- Works without JS (standard POST).

\- Client-side validation is optional but must mirror server rules.

\- Server-side validation is mandatory.

\- Anti-spam:

&nbsp; - honeypot field must exist and be checked server-side

&nbsp; - basic rate limiting (IP + time window) in PHP

\- Storage:

&nbsp; - append to `/storage/leads.csv`

&nbsp; - sanitize inputs and prevent CSV injection (prefix dangerous leading chars)

\- Response:

&nbsp; - On success: redirect to same page with `?sent=1` or render success message.

&nbsp; - On failure: show field-level errors (accessible).



\## 9) Accessibility (do not regress)

\- Semantic HTML: header/nav/main/section/footer.

\- One H1 per page.

\- All interactive elements keyboard reachable.

\- Use `:focus-visible` styles (never remove focus outlines without replacement).

\- Provide ARIA labels only when needed; do not over-ARIA.

\- Ensure contrast meets WCAG AA.



\## 10) Performance rules (do not regress)

\- Avoid large images; prefer SVG + CSS visuals.

\- If images are used:

&nbsp; - specify width/height to prevent layout shift

&nbsp; - `loading="lazy"` when below the fold

\- Keep JS under control:

&nbsp; - no large libraries

&nbsp; - no heavy DOM loops

\- Avoid CLS:

&nbsp; - reserve space for UI elements

&nbsp; - stable hero layout



\## 11) SEO rules (do not regress)

\- Titles and meta descriptions come from JSON.

\- Add/maintain:

&nbsp; - canonical URLs

&nbsp; - Open Graph tags

&nbsp; - Organization/LocalBusiness JSON-LD

\- Keep heading structure logical.

\- Internal links:

&nbsp; - use descriptive anchor text

\- Maintain `robots.txt` and `sitemap.xml` (static is fine).

\- Use clean URLs (file-based is fine: `privacy.php`, `cases.php`).



\## 12) Cookie consent rules

\- Cookie banner must be neutral and minimal (no dark patterns).

\- Store consent in `localStorage`.

\- Only load analytics placeholder script after consent.

\- Default: no tracking until consent is granted.



\## 13) Coding style rules

PHP:

\- Use short echo `<?= ?>` consistently.

\- Escape output with a single helper (e.g., `h()`).

\- Keep templates clean; no business logic in views.

\- All config and content come from JSON.



HTML:

\- Semantic sections with `aria-label` only when beneficial.

\- Keep class naming consistent (kebab-case).



CSS:

\- Prefer component classes over deep nesting.

\- Use variables; avoid magic numbers.

\- Media queries: mobile-first.



JS:

\- Use strict mode.

\- Wrap in an IIFE or module pattern to avoid globals.

\- Use event delegation where appropriate.



\## 14) Change process (how to modify safely)

When making changes, always:

1\) Identify the section/component being modified.

2\) Update `/content/site.json` if text changes.

3\) Ensure hover/action rule remains correct.

4\) Check:

&nbsp;  - mobile layout

&nbsp;  - keyboard navigation

&nbsp;  - form submission without JS

&nbsp;  - performance (no new heavy assets)



\## 15) Definition of done (for any task)

A change is complete only if:

\- Design stays consistent with the premium dark metallic blue theme.

\- Hover effects correctly indicate action vs non-action.

\- No accessibility regressions.

\- No performance regressions.

\- Copy is maintained in JSON (NL/EN).

\- Code remains framework-free and runnable with PHP built-in server.



\## 16) Quick local run

\- Run: `php -S localhost:8080` from project root.

\- Open: `http://localhost:8080/index.php`



End of file.



