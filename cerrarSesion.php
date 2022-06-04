<?php

    $servidor = "localhost";
    $baseDatos = "eco-localizacion";
    $user = "root";
    $pass = "";


    try {
        $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);

        session_start();
        //Para borrar los datos para que no se queden los datos anteriores guardados
        session_unset();
        session_destroy();
        header("location: index.php");

        $con = null; //Cerramos la conexión
    } catch (PDOException $e) {
        echo $e;
    }
?>