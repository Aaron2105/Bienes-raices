<?php

namespace Model;

class Admin extends ActiveRecord {
    //Base de datos 
    protected static $tabla = "usuarios";
    protected static $columnasDb = ["id", "email", "password", "rol_id"];

    public $id;
    public $email;
    public $password;
    public $rol;
    public $rol_id;

    public function __construct($args = []){
        $this->id = $args["id"] ?? null;
        $this->email = $args["email"] ?? "";
        $this->password = $args["password"] ?? "";
        $this->rol_id = $args["rol_id"] ?? null;
    }

    public function validar(){
        if(!$this->email){
            self::$errores[] = "Debe agregar un E-mail";
        }
        if(!$this->password){
            self::$errores[] = "Debe agregar una contraseña";
        }

        return self::$errores;
    }

    public function existe(){
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";


        $resultado = self::$db->query($query);

        if(!$resultado->num_rows){
            self::$errores[] = "El usuario no existe";
            return;
        }

        return $resultado;
    }

    public function comprobarPassword($resultado){
        $usuario = $resultado->fetch_object();

        $auth = password_verify($this->password, $usuario->password);

        if(!$auth){
            self::$errores[] = "Contraseña Incorrecta";
        } else {
            $this->rol_id = $usuario->rol_id; 
            $query = "SELECT nombre FROM roles WHERE id = '" . self::$db->escape_string($this->rol_id) . "' LIMIT 1";
            $resultado_rol = self::$db->query($query);
            $rol_info = $resultado_rol->fetch_assoc();

            $this->rol = $rol_info['nombre'] ?? 'visitante';
        }
        return $auth;
    }

    public function autenticar() {
        session_start();

        $_SESSION["usuario"] = $this->email;
        $_SESSION["login"] = true;
        $_SESSION["rol"] = $this->rol;
        $_SESSION["rol_id"] = $this->rol_id;

        $query = "SELECT p.slug FROM permisos p 
                INNER JOIN roles_permisos rp ON p.id = rp.permiso_id 
                WHERE rp.rol_id = '" . self::$db->escape_string($this->rol_id) . "'";
        
        $resultado = self::$db->query($query);
        
        $permisos = [];
        while($row = $resultado->fetch_assoc()) {
            $permisos[] = $row['slug'];
        }

        $_SESSION['permisos'] = $permisos;

        $permisos_admin = [
            'ver_admin',
            'crear_propiedad', 'actualizar_propiedad', 'eliminar_propiedad',
            'crear_vendedor', 'actualizar_vendedor', 'eliminar_vendedor',
        ];

        $tiene_acceso_admin = !empty(array_intersect($permisos, $permisos_admin));

        if($this->rol === 'Super Admin' || $tiene_acceso_admin) {
            $_SESSION['acceso_admin'] = $tiene_acceso_admin;
            header("Location: /admin");
        } else {
            header("Location: /");
        }
    }
    
    public function guardarRol($rol_id) {
        if($rol_id === "") {
            $query = "UPDATE " . self::$tabla . " SET rol_id = NULL WHERE id = '" . self::$db->escape_string($this->id) . "' LIMIT 1";
        } else {
            $query = "UPDATE " . self::$tabla . " SET rol_id = '" . self::$db->escape_string($rol_id) . "' WHERE id = '" . self::$db->escape_string($this->id) . "' LIMIT 1";
        }

        $resultado = self::$db->query($query);
        return $resultado;
    }
}