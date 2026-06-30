<?php
$help = $_GET['help'] ?? '';
$selected = match ($help) {
  'website' => 'Website',
  'app' => 'Applicatie / systeem',
  'ai' => 'AI-agent / automatisering',
  'unknown' => 'Ik weet het nog niet',
  default => ''
};
$options = ['Website', 'Applicatie / systeem', 'AI-agent / automatisering', 'Ik weet het nog niet'];
?>
<form method="post" novalidate>
  <input type="hidden" name="form_type" value="scan">
  <label><span>Naam</span><input type="text" name="name" autocomplete="name" required></label>
  <label><span>E-mailadres</span><input type="email" name="email" autocomplete="email" inputmode="email" required></label>
  <label><span>Bedrijf</span><input type="text" name="company" autocomplete="organization"></label>
  <label><span>Waar wil je hulp bij?</span><select name="help_type" required><option value="">Kies een optie</option><?php foreach ($options as $option): ?><option<?php echo $selected === $option ? ' selected' : ''; ?>><?php echo htmlspecialchars($option); ?></option><?php endforeach; ?></select></label>
  <label><span>Beschrijf kort je idee of probleem</span><textarea name="message" rows="5" placeholder="Bijvoorbeeld: ik wil een klantportaal bouwen, mijn website verbeteren of leads automatisch laten opvolgen."></textarea></label>
  <label class="hidden"><span>Laat dit veld leeg</span><input type="text" name="note" tabindex="-1" autocomplete="off"></label>
  <button class="button primary" type="submit">Verstuur mijn aanvraag</button>
</form>
