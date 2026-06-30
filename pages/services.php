<section class="page-hero">
  <div class="container">
    <h1>Digitale oplossingen die je bedrijf vooruithelpen.</h1>
    <p>Lionscape bouwt websites, apps en AI-agents voor ondernemers die meer aanvragen willen, slimmer willen werken of processen willen automatiseren.</p>
    <div class="cta-group"><a class="button primary" href="/contact">Vertel wat je wilt bouwen</a></div>
  </div>
</section>
<?php
$services = [
  ['title'=>'Websites die duidelijk maken waarom klanten voor jou moeten kiezen.','problems'=>['Je website voelt verouderd','Bezoekers snappen niet snel genoeg wat je doet','Je krijgt weinig aanvragen','Je mist een duidelijke funnel'],'solution'=>'We bouwen een professionele website met sterke structuur, duidelijke copy, snelle laadtijd en logische contactroutes.','examples'=>['Bedrijfswebsite','Onepager','Landingspagina','Portfolio','Website met SEO-basis','Conversiegerichte contactpagina'],'cta'=>'Laat mijn website checken','href'=>'/contact?help=website'],
  ['title'=>'Maatwerk software voor processen die niet meer in Excel horen.','problems'=>['Je gebruikt te veel losse tools','Je werkt nog met spreadsheets','Je mist overzicht','Klanten of medewerkers hebben geen centrale plek','Je hebt een app-idee, maar geen technische partner'],'solution'=>'We bouwen maatwerk applicaties zoals dashboards, klantportalen, boekingssystemen, interne tools en MVP’s.','examples'=>['Dashboard','Klantportaal','Boekingssysteem','Interne workflowtool','MVP','CRM-achtig systeem'],'cta'=>'Check mijn app-idee','href'=>'/contact?help=app'],
  ['title'=>'AI-agents die terugkerend werk slimmer afhandelen.','problems'=>['Leads blijven liggen','Je beantwoordt steeds dezelfde vragen','Je verwerkt handmatig data','Je mist overzicht in je tools','Je wilt AI gebruiken, maar weet niet waar te starten'],'solution'=>'We bouwen AI-agents en automatiseringen die taken uitvoeren, informatie verwerken, leads opvolgen en systemen met elkaar verbinden.','examples'=>['AI-chatbot','Lead-opvolging','E-mailagent','Interne kennisbank-agent','Automatische rapportages','Data verwerken','Toolkoppelingen'],'cta'=>'Doe de AI-kansen scan','href'=>'/contact?help=ai'],
];
?>
<section class="offers">
  <div class="container offer-grid">
    <?php foreach ($services as $service): ?>
      <article class="card">
        <h2><?php echo htmlspecialchars($service['title']); ?></h2>
        <h3>Herkenbare problemen</h3>
        <ul class="check-list"><?php foreach ($service['problems'] as $item): ?><li><?php echo htmlspecialchars($item); ?></li><?php endforeach; ?></ul>
        <h3>Oplossing</h3>
        <p><?php echo htmlspecialchars($service['solution']); ?></p>
        <h3>Voorbeelden</h3>
        <ul class="check-list"><?php foreach ($service['examples'] as $item): ?><li><?php echo htmlspecialchars($item); ?></li><?php endforeach; ?></ul>
        <a class="button primary" href="<?php echo htmlspecialchars($service['href']); ?>"><?php echo htmlspecialchars($service['cta']); ?></a>
      </article>
    <?php endforeach; ?>
  </div>
</section>
<section class="final-cta">
  <div class="container final-grid">
    <div>
      <h2>Weet je nog niet wat je nodig hebt?</h2>
      <p>Geen probleem. Tijdens een strategiegesprek kijken we naar je bedrijf, je processen en je doelen. Daarna bepalen we of een website, app, AI-agent of combinatie het slimst is.</p>
    </div>
    <div class="cta-actions"><a class="button primary" href="/contact?help=unknown">Plan gratis strategiegesprek</a></div>
  </div>
</section>
