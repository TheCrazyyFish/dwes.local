<?php
use dwes\app\exceptions\NotFoundException;
use dwes\core\Router;
use dwes\core\Request;
use dwes\core\App;
try {
    require_once 'core/bootstrap.php';

    // $routes = require 'app/routes.php'; // Obtenemos la tabla de rutas
    App::get('router')->direct(Request::uri(), Request::method());

} catch (NotFoundException $notFoundException) {
    die($notFoundException->getMessage());
}
