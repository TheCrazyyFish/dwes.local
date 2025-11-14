<?php

$router->get ('', 'PagesController@index');
$router->get ('about', 'PagesController@about');
$router->get ('asociados', 'app/controllers/asociados.php');
$router->get ('blog', 'PagesController@blog');
$router->get ('contact', 'PagesController@contact');
$router->get ('galeria', 'app/controllers/galeria.php');
$router->get ('post', 'PagesController@post');
$router->get ('galeria', 'GaleriaController@index');
$router->post('galeria/nueva', 'GaleriaController@nueva');
$router->get ('galeria/:id', 'GaleriaController@show');


$router->post('asociado/nuevo', 'app/controllers/asociado_nuevo.php');