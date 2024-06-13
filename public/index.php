<?php

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$param = htmlspecialchars($_GET['page']);
$viewPath = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views';

$router = new App\Router($viewPath, $param);
$router -> get();

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR . 'layouts.php';