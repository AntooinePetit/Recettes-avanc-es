<?php
require_once('functions.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recette</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php
    $id = $_GET['id'];
    $recette = getRecipe($pdo, $id);
    $tags = getTags($pdo, $id);
    $ingredients = getIngredients($pdo, $id);
  ?>
  
  <section>
    <h1><?= $recette['nom_recette'] ?></h1>
    <p>Catégorie : <?= $recette['nom_categorie'] ?></p>
    <div>
      <p>Tags : </p>
      <?php foreach($tags as $tag): ?>
        <p><?= $tag['nom_tag'] ?></p>
      <?php endforeach; ?>
    </div>
    <div>
      <p>Temps de préparation : <?= number_format($recette['temps_preparation_min']/60) ?>H<?php if($recette['temps_preparation_min']%60 != 0){echo $recette['temps_preparation_min']%60;} ?></p>
      <p>Temps de cuisson : <?= number_format($recette['temps_cuisson_min']/60) ?>H<?php if($recette['temps_cuisson_min']%60 != 0){echo $recette['temps_cuisson_min']%60;} ?></p>
      <p>Difficulté : <?= $recette['difficulte'] ?></p>
    </div>
    <h2>Ingrédients :</h2>
    <div>
      <?php foreach($ingredients as $ingredient): ?>
        <p><?= $ingredient['nom_ingredient'] ?> : <?= $ingredient['quantite'].' '.$ingredient['unite'] ?></p>
      <?php endforeach; ?>
    </div>
    <h2>Étapes de préparation :</h2>
    <p><?= $recette['instructions'] ?></p>
  </section>

  <section>
    <h2>Commentaires</h2>
    <?php 
    $evaluations = getComments($pdo, $id);
    ?>
    <div>
        <?php foreach($evaluations as $evaluation): ?>
          <article>
            <h3><?= $evaluation['nom_utilisateur'] ?> - <?= $evaluation['note'] ?>/5 - <?= $evaluation['date_evaluation'] ?></h3>
            <p><?= $evaluation['commentaire'] ?></p>
          </artc>
        <?php endforeach; ?>
    </div>
  </section>
</body>
</html>