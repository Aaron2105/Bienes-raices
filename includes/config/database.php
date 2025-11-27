<?php

function conectarDB() : mysqli{
    $db = new mysqli("localhost", "root", "@aron2105", "bienesraices_crud");
    mysqli_set_charset($db, "utf8");

    if(!$db){
        echo "Error! Conexión fallida";
        exit;
    }

    return $db;
}
