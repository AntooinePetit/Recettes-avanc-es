<?php 
require_once('functions.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Poster un commentaire</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<?php  
// On vérifie sur les données ont été remplies correctement
if(!empty($_POST['note']) && !empty($_POST['id']) && !empty($_POST['note'])){
  $utilisateur = $_POST['utilisateur'];
  $id = $_POST['id'];
  $comment = $_POST['commentaire'];
  $note = $_POST['note'];
  $utilisateurExistant = checkUser($pdo, $utilisateur);
  // Si le nom d'utilisateur n'est pas reconnu on propose à l'utilisateur de s'inscrire
  if($utilisateurExistant === false): ?>
    <h1>Erreur : cet utilisateur n'existe pas</h1>
    <div id="error-user">
      <a href="recette.php?id=<?= $id ?>">Revenir à la recette</a>
      <a href="signup.php">S'inscrire</a>
    </div>
  <?php 
    die();
  endif;
  // Si l'utilisateur est reconnu on poste l'évaluation
  $retour = postComment($pdo, $id, $utilisateurExistant['id_utilisateur'], $comment, $note);
  if($retour > 0){ ?>
    <h1>Mise en ligne de l'évaluation réussie</h1>
    <a href="index.php">Revenir à l'accueil</a>
  <?php } else { ?>
    <h1>Erreur : Echec de la mise en ligne de l'évaluation</h1>
  <?php }
// Sinon on vérifie si l'id est présent ou non, si non on retourne à la page d'accueil
} elseif(empty($_POST['id'])) { ?>
  <h1>Erreur : tous les champs n'ont pas été remplis</h1>
  <div id="error-user">
    <a href="index.php">Revenir à la liste des recettes</a>
  </div>
<?php 
// si oui on permet à l'utilisateur de retourner sur la page de la recette
} else { ?>
  <h1>Erreur : tous les champs n'ont pas été remplis</h1>
  <div id="error-user">
    <a href="recette.php?id=<?= $_POST['id'] ?>">Revenir à la recette</a>
  </div>
<?php
}
?>
</body>
</html>