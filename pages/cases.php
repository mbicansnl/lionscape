<?php
$cases = [
  ['slug'=>'case-jack','title'=>'Jack Plooij','label'=>'Website','image'=>'assets/img/jackontracks-logo.png','alt'=>'Jack Plooij website','situation'=>'Jack Plooij had een persoonlijke online plek nodig waar zijn activiteiten, content en Formule 1-gerelateerde informatie overzichtelijk samenkomen.','approach'=>'We bouwden een persoonlijke website met focus op herkenbaarheid, duidelijke navigatie en een professionele online presentatie.','result'=>'Bezoekers krijgen sneller overzicht van zijn activiteiten en kunnen makkelijker doorklikken naar relevante informatie.','cta'=>'Bekijk project'],
  ['slug'=>'case-canservices','title'=>'CANSERVICES.nl','label'=>'Website','image'=>'assets/img/canservices.nl-logo.png','alt'=>'CANSERVICES.nl website','situation'=>'CANSERVICES.nl had een zakelijke website nodig die diensten helder presenteert en bezoekers logisch richting contact stuurt.','approach'=>'We bouwden een website met duidelijke dienstenstructuur, professionele uitstraling en overzichtelijke contactroutes.','result'=>'De site helpt bezoekers sneller begrijpen wat het bedrijf doet en hoe ze contact kunnen opnemen.','cta'=>'Bekijk project'],
];
?>
<section class="page-hero"><div class="container"><h1>Projecten die laten zien wat een goed digitaal systeem kan doen.</h1><p>Van professionele websites tot toekomstige apps en AI-agents: Lionscape bouwt oplossingen die duidelijker communiceren, processen simpeler maken en bedrijven professioneler laten groeien.</p><div class="cta-group"><a class="button primary" href="/contact">Bespreek mijn project</a></div></div></section>
<section class="cards"><div class="container grid-2">
<?php foreach ($cases as $case): ?>
  <article class="card">
    <figure><img src="/<?php echo htmlspecialchars($case['image']); ?>" alt="<?php echo htmlspecialchars($case['alt']); ?>" width="540" height="320" loading="lazy" decoding="async"></figure>
    <p class="eyebrow"><?php echo htmlspecialchars($case['label']); ?></p>
    <h2><?php echo htmlspecialchars($case['title']); ?></h2>
    <h3>Situatie</h3><p><?php echo htmlspecialchars($case['situation']); ?></p>
    <h3>Aanpak</h3><p><?php echo htmlspecialchars($case['approach']); ?></p>
    <h3>Resultaat</h3><p><?php echo htmlspecialchars($case['result']); ?></p>
    <a class="button primary" href="/<?php echo htmlspecialchars($case['slug']); ?>"><?php echo htmlspecialchars($case['cta']); ?></a>
  </article>
<?php endforeach; ?>
</div></section>
<section class="final-cta"><div class="container final-grid"><div><h2>Jouw project hier?</h2><p>Of je nu een website, klantportaal, dashboard of AI-agent wilt bouwen: we denken mee vanaf idee tot werkende oplossing.</p></div><div class="cta-actions"><a class="button primary" href="/contact">Plan gratis strategiegesprek</a></div></div></section>
