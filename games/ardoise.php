<?php
include $_SERVER['DOCUMENT_ROOT']."/Portfolio/rooter.php";

$nav_template = templateRequest('nav-jeux');
$template = templateRequest('ardoise');

include $viewsPath.'templates/layout.phtml';
