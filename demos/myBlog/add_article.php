<?php

include 'models/authors.php';
include 'models/categories.php';
include 'models/posts.php';

if (empty($_POST))
{
    // Récupération de tous les auteurs du blog.
    $authors = getAuthors();

    // Récupération de toutes les catégories du blog.
    $categories = getCategories();

    // Sélection et affichage du template PHTML.
    $template = 'add_article';
    include 'layout-blog.phtml';
}
else
{
    if(empty($_POST['title']) && empty($_POST['contents']))
    {
        header("location: add_article.php");
        exit();
    }

    // Ajout d'un article du blog.
    $newArticle = addPost($_POST['title'], $_POST['contents'], $_POST['author'], $_POST['category']);

    // Retour à la page d'accueil une fois que le nouvel article du blog a été ajouté.
    header('Location: index-blog.php');
    exit();
}