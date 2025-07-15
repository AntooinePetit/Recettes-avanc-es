<?php 
require_once('functions.php');
if(!empty($_GET['mode']) && $_GET['mode'] == 'register'){
  echo "Test";
  if(!empty($_POST['username']) && !empty($_POST['email'])){
    $retour = signUp($pdo, $_POST['username'], $_POST['email']) ;
    if($retour > 0){
      header('Location: index.php');
    } else {
      echo 'Erreur survenue';
    }
  }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Créer un compte</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <form action="signup.php?mode=register" method="post">
    <div>
      <label for="username">Nom d'utilisateur</label>
      <input type="text" name="username" id="username">
    </div>

    <div>
      <label for="email">Email :</label>
      <input type="email" name="email" id="email">
    </div>

    <input type="submit" value="S'inscrire et retourner à l'accueil">
  </form>
</body>
</html>