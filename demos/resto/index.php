<?php

// Save the project root directory as a global constant.
define('ROOT_PATH', __DIR__);

/*
 * Create a global constant used to get the filesystem path to the
 * application configuration directory.
 */
define('CFG_PATH', realpath(ROOT_PATH.'/application/config'));

/*
 * Create a global constant used to get the filesystem path to the
 * application public web root directory.
 *
 * Can be used to handle file uploads for example.
 */
define('WWW_PATH', realpath(ROOT_PATH.'/application/www'));


require_once 'library/Configuration.php';
require_once 'library/Database.php';
require_once 'library/FlashBag.php';
require_once 'library/Form.php';
require_once 'library/FrontController.php';
require_once 'library/MicroKernel.php';
require_once 'library/Http.php';
require_once 'library/InterceptingFilter.php';
require_once 'library/Password.php';
require_once 'library/Session.php';


$microKernel = new MicroKernel();
$microKernel->bootstrap()->run(new FrontController());