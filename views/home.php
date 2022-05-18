<main>
  <h1>MOTUS</h1>
  <form class="home" method="post">
    <input
      class="player"
      name="name"
      type="text"
      placeholder="Pseudo"
      maxlength="20"
      required

      <?php if ($data->player->name) { ?>
      value="<?php echo $data->player->name; ?>"
      readonly
      <?php } ?>

    />
    <button class="play" type="submit">Jouer</button>
  </form>
  <table>
    <thead>
      <tr>
        <th class="right">
          <abbr title="Position">Pos</abbr>
        </th>
        <th>Joueur</th>
        <th>Score</th>
      </tr>
    </thead>
    <tbody>

      <?php foreach ($data->playersStandings as $key => $player) { ?>
      <tr>
        <td class="right position"><?php echo $key + 1; ?></td>
        <td class="player"><?php echo $player->name; ?></td>
        <td class="right"><?php echo $player->score; ?></td>
      </tr>
      <?php } ?>

    </tbody>
  </table>
</main>
