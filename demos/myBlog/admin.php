<?php

include 'models/posts.php';

$articles = getPosts();

// Sélection et affichage du template PHTML.
$template = 'admin';
include 'layout-blog.phtml';