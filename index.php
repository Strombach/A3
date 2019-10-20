<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('Application.php');


session_start();

$app = new Application();
$app->run();
