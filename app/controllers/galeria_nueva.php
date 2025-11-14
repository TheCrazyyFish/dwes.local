<?php
use dwes\app\utils\File;
use dwes\core\App;
use dwes\app\exceptions\AppException;
use dwes\app\exceptions\FileException;
use dwes\app\exceptions\QueryException;
use dwes\app\entity\Imagen;
use dwes\app\repository\ImagenesRepository;




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
    App::get('logger')->add("Se ha guardado una imagen: ".$imagenGaleria->getNombre());
    $mensaje = 'Datos enviados';
    $imagenes = $imagenesRepository->findAll();
} catch (FileException $fileException) {
    $errores[] = $fileException->getMessage();
} catch (QueryException $queryException) {
    $errores[] = $queryException->getMessage();
} catch (AppException $appException) {
    $errores[] = $appException->getMessage();
}



App::get('router')->redirect('galeria');
