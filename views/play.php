<main>

  <?php
  for ($trial = 0; $trial < 6; ++$trial) {
      if (isset($data->game->trials[$trial])) {
          ?>

    <p>
      <?php
        foreach ($data->game->trials[$trial] as $letter) {
            ?>
      <span class="<?php echo $letter->color; ?>"><?php echo $letter->value; ?></span>
      <?php
        } ?>
    </p>

    <?php
      } else { ?>

    <div class="try" style="width: calc(<?php echo strlen($data->game->word) * 48; ?>px + <?php echo (strlen($data->game->word) - 1) * 12; ?>px)"></div>

  <?php
    }
  }
  ?>

  <?php if ('progress' === $data->game->state) { ?>
  <form class="game" method="post">

    <?php foreach (str_split($data->game->word) as $key => $letter) { ?>
    <input class="letter" name="<?php echo $key; ?>" type="text" minlength="1" maxlength="1" required <?php echo 0 === $key ? 'autofocus' : ''; ?> />
    <?php } ?>

    <button type="submit" class="hide">Essayer</button>
  </form>

  <?php
  }
  if ('progress' !== $data->game->state) {
      ?>
  <a href="/">Partie <?php echo 'win' === $data->game->state ? 'gagnée, voir le classement' : "perdue, retour à <strong>l'accueil</strong>"; ?></a>
  <?php
  } ?>

</main>