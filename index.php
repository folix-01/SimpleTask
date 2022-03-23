<?php

ini_set('display_errors', 0);

define('ROOT', dirname(__FILE__));
require_once(ROOT . '/components/Router.php');
require_once(ROOT . '/components/Autoload.php');

session_start();

$router = new Router();
$router->run();

?>
