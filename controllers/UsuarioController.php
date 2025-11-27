<?php
namespace Controllers;

use MVC\Router;
use Model\Admin;
use Model\Rol;

class UsuarioController {

    public static function index(Router $router) {
        $usuarios = Admin::all();
        $roles = Rol::all();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if($_POST['id'] != 6) { 
                $usuario = Admin::find($_POST['id']);    
                /** @var \Model\Admin $usuario */          
                $usuario->guardarRol($_POST['rol_id']); 
            }
            header('Location: /usuarios');
        }

        $router->render('usuarios/admin', [
            'usuarios' => $usuarios,
            'roles' => $roles
        ]);
    }
}