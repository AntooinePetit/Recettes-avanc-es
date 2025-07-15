<?php

require_once('db.php');

// Fonction pour récupérer toutes les recettes
function getRecipes($pdo){
  $stmt = $pdo->prepare('SELECT r.id_recette, r.nom_recette, r.temps_preparation_min, r.temps_cuisson_min, r.difficulte, c.nom_categorie FROM recettes as r INNER JOIN categories_recettes as c ON r.fk_id_categorie = c.id_categorie');
  $stmt->execute();
  return $stmt->fetchAll();
}

// Fonction pour mettre à jour la difficulté des recettes
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

// Fonction pour récupérer les tags d'une recette
function getTags($pdo, $id){
  $stmt = $pdo->prepare('SELECT t.nom_tag FROM recette_tag as r INNER JOIN tags_recettes as t ON r.fk_id_tag = t.id_tag WHERE r.fk_id_recette = :id');
  $stmt->execute(["id" => $id]);
  return $stmt->fetchAll();
}

// Fonction pour récupérer une recette précise
function getRecipe($pdo, $id){
  $stmt = $pdo->prepare('SELECT r.id_recette, r.nom_recette, r.temps_preparation_min, r.temps_cuisson_min, r.instructions, r.difficulte, c.nom_categorie FROM recettes as r INNER JOIN categories_recettes as c ON r.fk_id_categorie = c.id_categorie');
  $stmt->execute();
  return $stmt->fetch();
}

// Fonction pour récupérer les ingrédients d'une recette
function getIngredients($pdo, $id){
  $stmt = $pdo->prepare('SELECT i.nom_ingredient, ri.quantite, ri.unite FROM recette_ingredients as ri INNER JOIN ingredients as i ON ri.fk_id_ingredient = i.id_ingredient WHERE ri.fk_id_recette = :id');
  $stmt->execute(["id" => $id]);
  return $stmt->fetchAll();
}