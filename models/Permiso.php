<?php
namespace Model;

class Permiso extends ActiveRecord {
    protected static $tabla = 'permisos';
    protected static $columnasDb = ['id', 'nombre', 'slug'];

    public $id;
    public $nombre;
    public $slug;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->slug = $args['slug'] ?? '';
    }
}