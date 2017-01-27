<?php

// Connection à la BDD
include 'connection.php';
include 'rooter.php';

$nav_template = templateRequest('nav-home');
$template = templateRequest('home');

include $viewsPath.'templates/layout.phtml';

