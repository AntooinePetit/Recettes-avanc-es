<?php

$host = 'localhost';
$dbname = 'recettes_avancees_db';
$username = 'recettesOwner';
$password = 'recettes1234';

try{
  $pdo = new PDO(
    "mysql:host=$host;dbname=$dbname;charset=utf8",
    $username,
    $password,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
  );
} catch (PDOException $e) {
  die('Erreur de connexion : '.$e->getMessage());
}

