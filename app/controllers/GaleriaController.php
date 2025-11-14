<?php

namespace dwes\app\controllers;

use dwes\core\App;
use dwes\app\repository\ImagenesRepository;
use dwes\core\Response;
use dwes\app\exceptions\QueryException;
use dwes\app\exceptions\AppException;

use dwes\app\utils\File;
use dwes\app\exceptions\FileException;
use dwes\app\entity\Imagen;
use dwes\core\database\QueryBuilder;
use dwes\core\helpers\FlashMessage;

class GaleriaController
{
    /**
     * @throws QueryException
     */
    public function index()
    {
        $errores = FlashMessage::get('errores', []);
        $mensaje = FlashMessage::get('mensaje');
        $titulo = FlashMessage::get('titulo');
        $descripcion = FlashMessage::get('descripcion');


        try {
            $conexion = App::getConnection();
            $imagenes = App::getRepository(ImagenesRepository::class)->findAll();
        } catch (QueryException $queryException) {
            $_SESSION['errores'][] = $queryException->getMessage();
        } catch (AppException $appException) {
            $_SESSION['errores'][] = $appException->getMessage();
        }


        Response::renderView('galeria', 'layout', compact(
            'imagenes',
            'titulo',
            'descripcion',
            'errores',
            'mensaje'
        ));
    }

    function nueva()
    {
        try {
            $imagenesRepository = new ImagenesRepository();

            $imagenes = $imagenesRepository->findAll();

            $titulo = trim(htmlspecialchars($_POST['titulo'] ?? ""));
            $descripcion = trim(htmlspecialchars($_POST['descripcion'] ?? ""));
            $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
            $imagen = new File('imagen', $tiposAceptados); // El nombre 'imagen' es el que se ha puesto en el formulario de galeria.view.php

            $imagen->saveUploadFile(Imagen::RUTA_IMAGENES_SUBIDAS);

            $imagenGaleria = new Imagen($imagen->getFileName(), $descripcion);
            $imagenGaleria->setCategoria(1);

            $imagenesRepository->save($imagenGaleria);
            $mensaje = "Se ha guardado una imagen: " . $imagenGaleria->getNombre();
            App::get('logger')->add($mensaje);


            FlashMessage::set('titulo', $titulo);
            FlashMessage::set('descripcion', $descripcion);

            $imagenes = $imagenesRepository->findAll();
        } catch (FileException $fileException) {
            FlashMessage::set('errores', [$fileException->getMessage()]);
        } catch (QueryException $queryException) {
            FlashMessage::set('errores', [$queryException->getMessage()]);
        } catch (AppException $appException) {
            FlashMessage::set('errores', [$appException->getMessage()]);
        }



        App::get('router')->redirect('galeria');

    }

    public function show($id)
    {
        $imagenesRepository = App::getRepository(ImagenesRepository::class);
        $imagen = $imagenesRepository->find($id);
        Response::renderView(
            'imagen-show',
            'layout',
            compact('imagen', 'imagenesRepository')
        );
    }
}
