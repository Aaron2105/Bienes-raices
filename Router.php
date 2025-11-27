<?php
namespace MVC;

class Router {

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fun){
        $this->rutasGET[$url] = $fun;
    }

    public function post($url, $fun){
        $this->rutasPOST[$url] = $fun;
    }

    public function comprobarRutas(){

        session_start();

        $auth = $_SESSION["login"] ?? null;
        
        // Rutas que requieren estar logueado (Cualquier rol)
        $rutas_protegidas = [
            "/admin", 
            "/propiedades/crear", 
            "/propiedades/actualizar", 
            "/propiedades/eliminar", 
            "/vendedores/crear", 
            "/vendedores/actualizar", 
            "/vendedores/eliminar",
            "/usuarios",     // <--- Nueva
            "/roles/crear"   // <--- Nueva
        ];

        $urlActual = $_SERVER["PATH_INFO"] ?? "/";
        $metodo = $_SERVER["REQUEST_METHOD"];

        if($metodo === "GET"){
            $fun = $this->rutasGET[$urlActual] ?? null;
        } else {
            $fun = $this->rutasPOST[$urlActual] ?? null;
        }

        // 1. Protección Básica: ¿Estás logueado?
        if(in_array($urlActual, $rutas_protegidas) && !$auth){
            header("Location: /");
            return;
        }

        // 2. Protección por PERMISOS (RBAC) - Lo nuevo y dinámico 🛡️
        // Mapeamos: Ruta => Permiso necesario en la BD
        $mapa_permisos = [
            '/propiedades/crear'      => 'crear_propiedad',
            '/propiedades/actualizar' => 'actualizar_propiedad',
            '/propiedades/eliminar'   => 'eliminar_propiedad',
            '/vendedores/crear'       => 'crear_vendedor',
            '/vendedores/actualizar'  => 'actualizar_vendedor',
            '/vendedores/eliminar'    => 'eliminar_vendedor',
        ];

        // Si la URL actual está en nuestro mapa, verificamos el permiso
        if(array_key_exists($urlActual, $mapa_permisos)) {
            // Nota: tienePermiso() viene de includes/funciones.php
            if(!tienePermiso($mapa_permisos[$urlActual])) {
                header('Location: /admin');
                return;
            }
        }

        // 3. Protección Especial SUPER ADMIN (Usuarios y Roles) 👮‍♂️
        // Estas rutas son exclusivas para el jefe (ID 1)
        $rutas_super_admin = ['/usuarios', '/roles/crear'];
        
        if(in_array($urlActual, $rutas_super_admin)) {
            // Verificamos si es el ID 1 (o el ID que uses para Super Admin)
            if($_SESSION['rol_id'] != 1) {
                header('Location: /admin');
                return;
            }
        }

        if($fun){
            call_user_func($fun, $this); 
        } else {
            echo "Página no encontrada";
        }
    }

    public function render($view, $datos = []){
        foreach($datos as $key => $value){
            $$key = $value; 
        }
        ob_start(); 
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); 
        include __DIR__ . "/views/Layout.php";
    }
}