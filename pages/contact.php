<?php $data = content_for($content, $lang, 'contact', []); ?>
<section class="page-hero"><div class="container"><h1>Vertel wat je wilt bouwen.</h1><p>Of je nu een website, app, AI-agent of automatisering nodig hebt: stuur je idee of probleem door en we denken met je mee.</p></div></section>
<section class="form-block"><div class="container form-grid"><div>
<?php if (!empty($messages['success'])): ?><div class="notice success" role="status"><?php echo htmlspecialchars($messages['success']); ?></div><?php elseif (!empty($messages['error'])): ?><div class="notice error" role="alert"><?php echo htmlspecialchars($messages['error']); ?></div><?php endif; ?>
<h2>Start je aanvraag</h2><p>Beschrijf kort waar je tegenaan loopt of wat je wilt bouwen. Je hoeft nog geen uitgewerkt plan te hebben.</p>
</div><?php include __DIR__ . '/partials/lead-form.php'; ?></div></section>
<section class="approach"><div class="container"><h2>Wat gebeurt er daarna?</h2><ol class="step-list"><li>We bekijken je aanvraag</li><li>We denken mee over de slimste oplossing</li><li>Je krijgt een voorstel voor de volgende stap</li></ol><p class="muted">Weet je nog niet precies wat je nodig hebt? Geen probleem. Vaak begint een goed project met een vaag idee, probleem of proces dat slimmer kan.</p></div></section>
