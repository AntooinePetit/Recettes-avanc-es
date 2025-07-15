<?php

require_once('db.php');

function getRecipes($pdo){
  $stmt = $pdo->prepare('SELECT r.id_recette, r.nom_recette, r.temps_preparation_min, r.temps_cuisson_min, r.difficulte, c.nom_categorie FROM recettes as r INNER JOIN categories_recettes as c ON r.fk_id_categorie = c.id_categorie');
  $stmt->execute();
  return $stmt->fetchAll();
}

function updateDifficulty($pdo, $tempsTotal, $difficulte, $id){
  if($tempsTotal <= 180){
    $nouvelleDifficulte = 'Facile';
  }
  if($tempsTotal >= 450){
    $nouvelleDifficulte = 'Difficile';
  }
  if($tempsTotal > 180 && $tempsTotal < 450){
    $nouvelleDifficulte = 'Moyenne';
  }
  if($difficulte != $nouvelleDifficulte){
    $stmt = $pdo->prepare('UPDATE recettes SET difficulte = :difficulte WHERE id_recette = :id');
    $stmt->execute([
      "difficulte" => $nouvelleDifficulte,
      "id" => $id
    ]);
    return $nouvelleDifficulte;
  }
  return $difficulte;
}