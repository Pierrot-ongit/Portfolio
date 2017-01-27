<?php

$idArticle = $_GET['id'];

// Connection à la BDD
include $_SERVER['DOCUMENT_ROOT'].'/Portfolio/connection.php';

////////// REQUETE Selection Commentaires liés à l'article à effacer (avant de pouvoir effacer l'article) /////////////
$pdo = getConnection();
$query = $pdo->prepare
("
DELETE FROM `comments` 
WHERE articleId = ?
");
// Demande à PDO d'envoyer la requête à MySQL pour exécution.
$query->execute([$idArticle]);

////////// REQUETE Selection Article à effacer /////////////
$query = $pdo->prepare
("
DELETE FROM `articles` 
WHERE articles.id = ?
");
// Demande à PDO d'envoyer la requête à MySQL pour exécution.
$query->execute([$idArticle]);

//Redirection HTTP
header("location: admin.php"); //Redirection vers index.php
exit();