<?php

namespace dwes\app\controllers;

use dwes\app\entity\Asociado;
use dwes\app\entity\Imagen;
use dwes\core\App;
use dwes\app\utils\Utils;
use dwes\app\repository\ImagenesRepository;
use dwes\app\repository\AsociadosRepository;
use dwes\core\Response;

class PagesController
{
    /**
     * @throws QueryException
     */
    public function index()
    {

        $imagenes[] = new Imagen("1.jpg", "Descripcion imagen 1", 10, 10, 10);
        $imagenes[] = new Imagen("2.jpg", "Descripcion imagen 2", 10, 10, 10);
        $imagenes[] = new Imagen("3.jpg", "Descripcion imagen 3", 10, 10, 10);
        $imagenes[] = new Imagen("4.jpg", "Descripcion imagen 4", 10, 10, 10);
        $imagenes[] = new Imagen("5.jpg", "Descripcion imagen 5", 10, 10, 10);
        $imagenes[] = new Imagen("6.jpg", "Descripcion imagen 6", 10, 10, 10);
        $imagenes[] = new Imagen("7.jpg", "Descripcion imagen 7", 10, 10, 10);
        $imagenes[] = new Imagen("8.jpg", "Descripcion imagen 8", 10, 10, 10);
        $imagenes[] = new Imagen("9.jpg", "Descripcion imagen 9", 10, 10, 10);
        $imagenes[] = new Imagen("10.jpg", "Descripcion imagen 10", 10, 10, 10);
        $imagenes[] = new Imagen("11.jpg", "Descripcion imagen 11", 10, 10, 10);
        $imagenes[] = new Imagen("12.jpg", "Descripcion imagen 12", 10, 10, 10);


        $asociados[] = new Asociado("log1.jpg", "Logo 1", "Descripción logo 1");
        $asociados[] = new Asociado("log2.jpg", "Logo 2", "Descripción logo 2");
        $asociados[] = new Asociado("log3.jpg", "Logo 3", "Descripción logo 3");
        $asociados = Utils::extraeElementosAleatorios($asociados, 3);


        $imagenGaleria = App::getRepository(ImagenesRepository::class)->findAll();
        $asociadosLista = App::getRepository(AsociadosRepository::class)->findAll();
        Response::renderView(
            'index',
            'layout',
            compact('imagenes', 'asociados')
        );
    }
    public function about()
    {
        $imagenesClientes[] = new Imagen('client1.jpg', 'MISS BELLA');
        $imagenesClientes[] = new Imagen('client2.jpg', 'DON LUIS');
        $imagenesClientes[] = new Imagen('client3.jpg', 'MISS ARABELLA');
        $imagenesClientes[] = new Imagen('client4.jpg', 'DON LORENZO');

        Response::renderView(
            'about',
            'layout',
            compact('imagenesClientes')
        );
    }
    public function blog()
    {
        Response::renderView(
            'blog'
        );
    }

    public function contact()
    {
       Response::renderView(
            'contact'
        );;
    }
    public function post()
    {
        Response::renderView(
            'single_post'
        );
    }
}
