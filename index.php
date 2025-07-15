<?php

require_once('functions.php');

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recettes avancées</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="table_component" role="region" tabindex="0">
    <h1>Recettes</h1>
    <table>
      <caption>Liste des recettes</caption>
      <thead>
        <tr>
          <th>Recette</th>
          <th>Catégorie</th>
          <th>Tags</th>
          <th>Temps de préparation</th>
          <th>Difficulté</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $recettes = getRecipes($pdo);
      // var_dump($recettes);
      foreach($recettes as $recette):
        $tempsTotal = $recette['temps_preparation_min'] + $recette['temps_cuisson_min'];
        $difficulte = updateDifficulty($pdo, $tempsTotal, $recette['difficulte'], $recette['id_recette']);
      ?>
        <tr>
          <td><?= $recette['nom_recette'] ?></td>
          <td><?= $recette['nom_categorie'] ?></td>
          <td></td>
          <td><?= number_format($tempsTotal/60) ?>H<?php if($tempsTotal%60 != 0){echo $tempsTotal%60;} ?></td>
          <td><?= $difficulte ?></td>
          <td><a href="recette.php?id=<?= $recette['id_recette'] ?>">Voir la recette</a></td>
        </tr>

      <?php
      endforeach;
      ?>
      </tbody>
    </table>

  </div>
</body>
</html>