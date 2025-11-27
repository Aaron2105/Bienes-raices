<?php
namespace Model;

class Rol extends ActiveRecord {
    protected static $tabla = 'roles';
    protected static $columnasDb = ['id', 'nombre'];

    public $id;
    public $nombre;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
    }

    public function validar() {
        if(!$this->nombre) {
            self::$errores[] = "El Nombre del Rol es obligatorio";
        }
        return self::$errores;
    }

    public function guardarPermisos($permisos) {
        if($this->id) {
            $query = "DELETE FROM roles_permisos WHERE rol_id = " . self::$db->escape_string($this->id);
            self::$db->query($query);
        }

        foreach($permisos as $permiso_id) {
            $query = "INSERT INTO roles_permisos (rol_id, permiso_id) VALUES (" . self::$db->escape_string($this->id) . ", " . self::$db->escape_string($permiso_id) . ")";
            self::$db->query($query);
        }
    }
    
    public function obtenerPermisos() {
        $query = "SELECT permiso_id FROM roles_permisos WHERE rol_id = " . self::$db->escape_string($this->id);
        $resultado = self::$db->query($query);
        $permisos = [];
        while($row = $resultado->fetch_assoc()) {
            $permisos[] = $row['permiso_id'];
        }
        return $permisos;
    }

    public function crear() {
        $atributos = $this->sanitizarDatos();

        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= join(', ', array_keys($atributos));
        $query .= ") VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= "')";

        $resultado = self::$db->query($query);

        if($resultado) {
            $this->id = self::$db->insert_id;
            return true;
        }
        return false;
    }
}