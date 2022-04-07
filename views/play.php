<main>

  <?php
  for ($trial = 0; $trial < 6; $trial++) {
    if (isset($data->game->trials[$trial])):
  ?>

    <p>
      <?php
        foreach ($data->game->trials[$trial] as $letter):
      ?>
      <span class="<?= $letter->color ?>"><?= $letter->value ?></span>
      <?php endforeach; ?>
    </p>

    <?php else: ?>
      
    <div class="try" style="width: calc(<?= strlen($data->game->word) * 48 ?>px + <?= (strlen($data->game->word) - 1) * 12 ?>px)"></div>

  <?php
    endif;
  }
  ?>

  <?php if ($data->game->state === 'progress'): ?>
  <form class="game" method="post">

    <?php foreach (str_split($data->game->word) as $key => $letter): ?>
    <input class="letter" name="<?= $key ?>" type="text" minlength="1" maxlength="1" required <?= $key === 0 ? 'autofocus' : '' ?> />
    <?php endforeach; ?>

    <button type="submit" class="hide">Essayer</button>
  </form>

  <?php
  endif;
  if ($data->game->state !== 'progress'):
  ?>
  <a href="/">Partie <?= $data->game->state === 'win' ? 'gagnée, voir le classement' : "perdue, retour à <strong>l'accueil</strong>" ?></a>
  <?php endif; ?>

</main>