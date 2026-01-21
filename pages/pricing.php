<?php
$shared = content_for($content, $lang, 'shared', []);
?>
<section class="page-hero">
  <div class="container">
    <h1>Prijzen</h1>
  </div>
</section>
<section class="pricing-body">
  <div class="container">
    <h2>Structuren</h2>
    <div class="pricing-structures">
      <details class="pricing-pill">
        <summary>fixed price</summary>
        <div class="pricing-pill__content">
          <h3>Fixed Price</h3>
          <p>
            Voor opdrachten werken we met fixed price: vooraf spreken we een vaste prijs en duidelijke scope af,
            zodat er geen verrassingen ontstaan en beide kanten precies weten waar ze aan toe zijn.
          </p>
        </div>
      </details>
      <details class="pricing-pill">
        <summary>abbonnement</summary>
        <div class="pricing-pill__content">
          <h3>abonnement</h3>
          <p>
            Voor onderhoud, updates en het bijhouden van socials werken we met abonnementen: vaste afspraken per maand
            voor doorlopende ondersteuning, zodat je website en online uitstraling actueel, veilig en consistent blijven.
          </p>
        </div>
      </details>
    </div>
    <h2>Fixed price: duidelijkheid vooraf</h2>
    <p>
      Bij LionScape werken we met fixed price. Dat betekent dat we vooraf een vaste prijs afspreken voor een
      duidelijke opdracht. Geen verrassingen achteraf en geen discussies over uren. Jij weet precies wat het
      kost en wat je ervoor krijgt, en wij weten precies wat we moeten opleveren.
    </p>

    <h2>Waarom we hiervoor kiezen</h2>
    <p>
      In veel trajecten ontstaat gedoe door werken op uurbasis. Een klant wil vooral een goed eindresultaat,
      maar krijgt uiteindelijk een rekening die vooral over tijd gaat. Dat voelt niet altijd eerlijk, zeker als
      iets meer tijd kost dan verwacht.
    </p>
    <p>
      Fixed price haalt die spanning weg. Jij wordt niet "gestraft" als iets complexer blijkt, en wij hoeven niet
      te haasten om binnen een aantal uren te blijven. Daardoor kunnen we focussen op wat telt: kwaliteit, een
      consistente uitstraling en een website die echt af is.
    </p>

    <h2>Heldere scope is de basis</h2>
    <p>
      Een vaste prijs werkt alleen als we vooraf goed afspreken wat er binnen de opdracht valt. Daarom starten we
      met een korte intake en maken we de scope concreet: welke pagina's, welke onderdelen, welke contentblokken,
      welke functies en eventuele integraties. Op basis daarvan ontvang je een voorstel met een vaste prijs en
      duidelijke opleverpunten.
    </p>
    <p>
      Dit geeft rust. Jij hoeft niet te twijfelen of een vraag extra kosten betekent, en wij kunnen doorbouwen
      zonder dat er voortdurend opnieuw onderhandeld hoeft te worden.
    </p>

    <h2>Wat meestal inbegrepen is</h2>
    <p>
      Afhankelijk van het pakket en de scope kan een fixed price traject bijvoorbeeld bestaan uit:
    </p>
    <ul>
      <li>Design en unificatie van de look &amp; feel (kleurenpalet, typografie, basisstijl)</li>
      <li>Realisatie van de website (desktop en mobiel)</li>
      <li>Opbouw van pagina's en herbruikbare contentmodules</li>
      <li>Basis SEO (technische basis, metadata, indexeerbaarheid)</li>
      <li>Performance en veiligheid (snelle laadtijden, technische checks)</li>
      <li>Optioneel: ondersteuning bij socials (templates en consistente uitstraling)</li>
    </ul>

    <h2>Wijzigingen: flexibel, maar wel netjes geregeld</h2>
    <p>
      Tijdens een traject komen er vaak nieuwe ideeen. Dat is normaal. Als een wijziging binnen de afgesproken
      scope past, nemen we die mee. Als het buiten de scope valt, maken we het concreet en spreken we een
      aanvullende fixed price af voor dat extra onderdeel. Zo houd jij de controle over het budget en blijft het
      voor ons haalbaar om kwaliteit te blijven leveren.
    </p>

    <h2>Onderhoud en doorontwikkeling</h2>
    <p>
      Een website is nooit echt "klaar". Er komen updates, verbeteringen, nieuwe pagina's en kleine optimalisaties.
      Daarom bieden we ook onderhoud en doorontwikkeling. Dat kan met vaste afspraken, bijvoorbeeld per maand of
      per wijzigingspakket, zodat je weet waar je aan toe bent en je website gezond blijft.
    </p>

    <h2>Samenwerken zonder ruis</h2>
    <p>
      Het doel van fixed price is simpel: helderheid en een prettige samenwerking. Jij koopt een resultaat, geen
      uren. En wij leveren dat resultaat met focus op consistentie, snelheid en een professionele uitstraling.
    </p>
  </div>
</section>
<section class="final-cta">
  <div class="container final-grid">
    <div>
      <h2><?php echo htmlspecialchars(content_for($content, $lang, 'home.final_cta.title', '')); ?></h2>
      <p><?php echo htmlspecialchars(content_for($content, $lang, 'home.final_cta.text', '')); ?></p>
    </div>
    <div class="cta-actions">
      <a class="button primary" href="/contact"><?php echo htmlspecialchars(content_for($content, $lang, 'home.final_cta.cta', '')); ?></a>
    </div>
  </div>
</section>
