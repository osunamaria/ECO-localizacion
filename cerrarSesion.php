<?php

    $servidor = "localhost";
    $baseDatos = "cleanvibes";
    $user = "root";
    $pass = "";

    $usuario=$_POST["usuario"];
    $contrasena= $_POST["contrasena"];

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