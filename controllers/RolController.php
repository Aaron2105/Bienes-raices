<?php
namespace Controllers;

use MVC\Router;
use Model\Rol;
use Model\Permiso;

class RolController {

    public static function crear(Router $router) {
        $rol = new Rol;
        $errores = Rol::getErrores();
        
        // Obtener todos los permisos para pintarlos en la vista
        $permisos = Permiso::all();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rol = new Rol($_POST['rol']);
            $errores = $rol->validar();

            if(empty($errores)) {
                // Usamos nuestro método crear() personalizado que no redirige
                if($rol->crear()) {
                    // Si se creó el rol, ahora guardamos sus permisos seleccionados
                    $permisos_seleccionados = $_POST['permisos'] ?? [];
                    $rol->guardarPermisos($permisos_seleccionados);

                    header('Location: /admin');
                }
            }
        }

        $router->render('roles/crear', [
            'rol' => $rol,
            'errores' => $errores,
            'permisos' => $permisos
        ]);
    }
}