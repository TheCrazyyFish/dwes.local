<?php
use dwes\app\utils\File;
use dwes\core\database\Connection;
use dwes\core\App;
use dwes\app\exceptions\FileException;
use dwes\app\entity\Asociado;


try {
    $nombre = trim(htmlspecialchars($_POST['nombre'] ?? ""));
    $descripcion = trim(htmlspecialchars($_POST['descripcion'] ?? ""));
    if ($nombre == "") {
        $mensaje = "";
        $errores[] = "El nombre no debe estar vacío";
    } else {
        $captcha = $_POST['captcha'] ?? "";
        if ($captcha != "") {
            if ($_SESSION['captchaGenerado'] != $captcha) {
                $mensaje = "";
                $errores[] = "¡Ha introducido un código de seguridad incorrecto! Inténtelo de nuevo";
            } else { // Todo correcto y se guardan los datos
                $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
                $logo = new File('imagen', $tiposAceptados); // El nombre logo' es el que se ha puesto en elformulario de asociados.view.php
                $logo->saveUploadFile(Asociado::RUTA_LOGOS_ASOCIADOS . "/");

                $conexion = Connection::make();
                $sql = "INSERT INTO asociados (nombre, logo, descripcion) VALUES (:nombre,:logo,:descripcion)";
                $pdoStatement = $conexion->prepare($sql);
                $parametros = [
                    ':nombre' => $nombre,
                    ':logo' => $logo->getFileName(),
                    ':descripcion' => $descripcion
                ];
                if ($pdoStatement->execute($parametros) === false)
                    $errores[] = "No se ha podido guardar la imagen en la base de datos";
                else {
                    $descripcion = "";
                    $mensaje = "Se ha guardado la imagen correctamente";
                }


                $mensaje = 'Datos enviados';
            }
        } else {
            $mensaje = "";
            $errores[] = "Introduzca el código de seguridad";
        }
    }
} catch (FileException $fileException) {
    $errores[] = $fileException->getMessage();
}

App::get('router')->redirect('asociados');
