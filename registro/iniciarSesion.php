<?php

    $servidor = "localhost";
    $baseDatos = "cleanvibes";
    $user = "root";
    $pass = "";

    $usuario=$_POST["usuario"];
    $contrasena= $_POST["contrasena"];

    try {
        $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
        $sql = $con->prepare("SELECT id,tipo,confirmado FROM socios WHERE usuario=:usuario AND contrasena=:contrasena");
        $sql->bindParam(":usuario", $usuario);
        $sql->bindParam(":contrasena", $contrasena);
        $sql->execute();

        $persona = $sql->fetch(PDO::FETCH_ASSOC); //Recibimos el id

        if ($persona!="") {
            if($persona['confirmado']=='1'){
                //Inicio sesion
                //Sesion id seria el tipo de usuario
                session_id($persona['tipo']);
                session_start();
                
                // Variables de sesión:
                $_SESSION['sesion_iniciada'] = true;
                $_SESSION['username'] = $usuario;
                $_SESSION['id'] = $persona['id'];
                header("location: ../index.php");   
            }else{
                echo "Tu usuario aun no ha sido confirmado, puede tardar un par de dias en estar activo<br><br>";
                echo "<a href='index.php'>[Volver]</a>";
            }
            
        } else {
            //Error inicio sesion
            echo "Datos incorrectos<br><br>";
            echo "<a href='index.php'>[Volver]</a>";
        }

        $con = null; //Cerramos la conexión
    } catch (PDOException $e) {
        header("location: ../php/error.php");
    }
?>