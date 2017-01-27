<?php

$idArticle = $_GET['id'];

// Connection à la BDD
include $_SERVER['DOCUMENT_ROOT'].'/Portfolio/connection.php';
$pdo = getConnection();
//Si mon tableau est vide ça veut dire que j'ai envoyé aucune donnée
//Donc on fait l'affichage du formulaire d'édition
if(empty($_POST))
{
////////// REQUETE Selection autors et catégories /////////////
    $query = $pdo->prepare
    ("SELECT * FROM `authors`");
    $query->execute();
    $authors = $query->fetchAll();

    $query = $pdo->prepare
    ("SELECT * FROM categories ");
    $query->execute();
    $categories = $query->fetchAll();

////////// REQUETE Selection contenu de l'article /////////////
    $query = $pdo->prepare
    ("SELECT * FROM articles WHERE id = $idArticle");
    $query->execute();
    $articles = $query->fetch();
    //var_dump($articles);

//On précise le nom du template
    $template = 'edit_post';

    include 'layout-blog.phtml';
}
else {

//Update dans une table
$query = $pdo->prepare
("
  UPDATE articles
  SET title = ?, content = ?, authorId = ?, categoryId = ?, EditTime = NOW() 
  WHERE id = $idArticle
"); //NE PAS OUBLIER DE DESIGNER L' ARTICLE PAR l'ID !
    $query->execute([$_POST['title'], $_POST['contents'], $_POST['author'], $_POST['category']]);


//Redirection HTTP
    header("location: admin.php"); //Redirection vers index-blog.php
    exit();
}



