<?php

    $servidor = "localhost";
    $baseDatos = "eco-localizacion";
    $user = "root";
    $pass = "";

    function obtenerVendedores(){
        try {
            $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
            $sql = $con->prepare("SELECT * from clientes WHERE confirmado = '1' AND cp = :cp;");
            $sql->bindParam(":cp", $cp); //Para evitar inyecciones SQL
            $sql->execute();
            $miArray = [];
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) { //Haciendo uso de PDO iremos creando el array dinámicamente
                $miArray[] = $row; //https://www.it-swarm-es.com/es/php/rellenar-php-array-desde-while-loop/972445501/
            }
            $con = null; //Cerramos la conexión
        } catch (PDOException $e) {
            header("location: ../php/error.php");
        }
        return $miArray;
    }

    function obtenerCompra($id){
        try {
            $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
            $sql = $con->prepare("SELECT * from precios,productos WHERE precios.id_producto=productos.id AND precios.id = :id;");
            $sql->bindParam(":id", $id); //Para evitar inyecciones SQL
            $sql->execute();
            $row = $sql->fetch(PDO::FETCH_ASSOC); //Recibimos la linea correspondiente en ROW
            $con = null; //Cerramos la conexión
            return $row;
        } catch (PDOException $e) {
            header("location: ../php/error.php");
        }
    }

    function insertarCompra($usuario,$contrasena,$nombre,$apellidos,$dni,$correo,$telefono,$tipo){
        
        try {
            $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
            $sql = $con->prepare("INSERT into clientes values(null, :usuario , :contrasena , :nombre , :apellidos , :dni , :correo , :telefono, :tipo ,'0')");
            $sql->bindParam(":usuario", $usuario);
            $sql->bindParam(":contrasena", $contrasena);
            $sql->bindParam(":nombre", $nombre);
            $sql->bindParam(":apellidos", $apellidos);
            $sql->bindParam(":dni", $dni);
            $sql->bindParam(":correo", $correo);
            $sql->bindParam(":telefono", $telefono);
            $sql->bindParam(":tipo", $tipo);
            $sql->execute();
            $id = $con->lastInsertId();
            $con = null;
            if ($id == 0) {
                echo "Datos incorrectos";
            }
        } catch (PDOException $e) {
            header("location: ../php/error.php");
        }

    }
?>