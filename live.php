<?php

include 'rooter.php';

$nav_template = templateRequest('nav-live');
$template = templateRequest('live');

include $viewsPath.'templates/layout.phtml';
