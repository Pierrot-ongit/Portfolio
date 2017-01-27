<?php

$idArticle = $_GET['id'];


// Connection à la BDD
include $_SERVER['DOCUMENT_ROOT'].'/Portfolio/connection.php';
$pdo = getConnection();
////////// REQUETE Affichage Articles /////////////
$query = $pdo->prepare
("
SELECT * 
FROM `articles` 
INNER JOIN authors ON authors.id = articles.authorId
WHERE articles.id = $idArticle
");
// Demande à PDO d'envoyer la requête à MySQL pour exécution.
$query->execute();
$articles = $query->fetchAll();


///////////////// Insertion des commentaires dans la base de données ////////////////////
// Récupération des valeurs du formulaire via POST

if (array_key_exists("pseudo", $_POST) && array_key_exists("message", $_POST)) {
    $pseudo = $_POST['pseudo'];
    $message = $_POST['message'];

    //Insertion dans une table
    $query = $pdo->prepare("INSERT INTO comments(username, message, articleId) VALUES(?, ?, ?)"); //NE PAS METTRE l'ID !
    $query->execute([$pseudo, $message, $idArticle]);

}


////////// REQUETE Affichage Commentaires /////////////
$query = $pdo->prepare
("
SELECT * 
FROM `comments` 
INNER JOIN articles ON articles.id = comments.articleId
WHERE articles.id = $idArticle
");
// Demande à PDO d'envoyer la requête à MySQL pour exécution.
$query->execute();
$comments = $query->fetchAll();





//On précise le nom du template
$template = 'show_post';

include 'layout-blog.phtml';