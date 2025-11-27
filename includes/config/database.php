<?php 

function conectarDB() : mysqli {
    $host = $_ENV['DB_HOST'] ?? 'db'; 
    
    $db = new mysqli(
        $host,             
        'root',            
        'root',           
        'bienesraices_crud' 
    );

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    } 

    return $db;
}