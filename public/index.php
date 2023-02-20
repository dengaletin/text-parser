<?php

use App\Facade;
use App\Container;

require '../vendor/autoload.php';

$container = new Container();
/** @var Facade $facade */
$facade = $container->get(Facade::class);
echo $facade->response($_POST['json']);