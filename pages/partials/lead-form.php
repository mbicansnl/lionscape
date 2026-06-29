<form method="post" novalidate>
  <input type="hidden" name="form_type" value="scan">
  <label><span>Naam</span><input type="text" name="name" autocomplete="name" required></label>
  <label><span>E-mail</span><input type="email" name="email" autocomplete="email" inputmode="email" required></label>
  <label><span>Bedrijf</span><input type="text" name="company" autocomplete="organization"></label>
  <label><span>Waar wil je hulp bij?</span><select name="help_type" required><option value="">Kies een optie</option><option>Website</option><option>Applicatie</option><option>AI-agent / automatisering</option><option>Ik weet het nog niet</option></select></label>
  <label><span>Beschrijf kort je idee of probleem</span><textarea name="message" rows="4"></textarea></label>
  <label class="hidden"><span>Laat dit veld leeg</span><input type="text" name="note" tabindex="-1" autocomplete="off"></label>
  <button class="button primary" type="submit">Plan gratis gesprek</button>
</form>
