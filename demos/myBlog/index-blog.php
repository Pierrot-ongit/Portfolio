<?php
include $_SERVER['DOCUMENT_ROOT']."/Portfolio/rooter.php";
session_start();

//Inclusion du modèle pour pouvoir utiliser les fonctions
include 'models/posts.php';

//Appel la fonction qui récupère tous les articles
$articles = getPosts();

// Sélection et affichage du template PHTML.
$template = 'index';
include 'layout-blog.phtml';