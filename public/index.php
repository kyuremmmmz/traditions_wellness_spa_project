<?php

use Project\App\Core\Router;

require_once 'C:\xampp\htdocs\TraditionsWellnessSpa\Project\app\core\Router.php';
require_once 'C:\xampp\htdocs\TraditionsWellnessSpa\Project\app\config\connection.php';

$router = new Router();

$router->get('/auth', [CrudController::class, 'index']);