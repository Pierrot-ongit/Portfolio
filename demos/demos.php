<?php

include $_SERVER['DOCUMENT_ROOT']."/Portfolio/rooter.php";

$nav_template = templateRequest('nav-demos');
$template = templateRequest('demos');

include $viewsPath.'templates/layout.phtml';