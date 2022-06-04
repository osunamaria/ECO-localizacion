<?php

    $servidor = "localhost";
    $baseDatos = "eco-localizacion";
    $user = "root";
    $pass = "";

    $usuario=$_POST["usuario"];
    $contrasena= $_POST["contrasena"];
    $nombre=$_POST["nombre"];
    $apellidos=$_POST["apellidos"];
    $dni=$_POST["dni"];
    $correo=$_POST["correo"];
    $telefono=$_POST["telefono"];
    $ciudad=$_POST["ciudad"];
    $localidad=$_POST["localidad"];
    $direccion=$_POST["direccion"];
    $cp=$_POST["cp"];


    $letra = substr($dni, -1);
    $numeros = substr($dni, 0, -1);
  
    if($usuario=="" || $contrasena=="" || $nombre=="" || $apellidos=="" || $dni=="" || $correo=="" || $telefono==""){
        
        echo "Debe rellenar todos los campos<br><br>";
        echo "<a href='index.php'>[Volver]</a>";

    }else if(substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1) == $letra && strlen($letra) == 1 && strlen ($numeros) == 8){

        echo "DNI incorrecto<br><br>";
        echo "<a href='index.php'>[Volver]</a>";

    }else{

        try {
            $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
            $sql = $con->prepare("SELECT * from clientes WHERE nombre = $nombre;");
            $sql2 = $con->prepare("SELECT * from vendedores WHERE nombre = $nombre;");
            $mensaje='';
            if($sql == null && $sql2 == null){
                $sql = $con->prepare("INSERT into clientes values(null, :usuario , :contrasena , :nombre , :apellidos , :dni , 'socio' , :correo , :telefono, :ciudad, :localidad, :direccion, :cp)");
                $sql->bindParam(":usuario", $usuario);
                $sql->bindParam(":contrasena", $contrasena);
                $sql->bindParam(":nombre", $nombre);
                $sql->bindParam(":apellidos", $apellidos);
                $sql->bindParam(":dni", $dni);
                $sql->bindParam(":correo", $correo);
                $sql->bindParam(":telefono", $telefono);
                $sql->bindParam(":ciudad", $ciudad);
                $sql->bindParam(":localidad", $localidad);
                $sql->bindParam(":direccion", $direccion);
                $sql->bindParam(":cp", $cp);
                $sql->execute();
                $id = $con->lastInsertId();
                $con = null;
                if ($id != 0) {
                    header("Location: ../index.php");
                } else {
                    header("Location: index.php");
                    $mensaje = "Datos incorrectos";
                }
            }else{
                header("Location: index.php");
                $mensaje = "Ese nombre de usuario ya existe";
            }
            return $mensaje;
        } catch (PDOException $e) {
            header("location: ../php/error.php");
        }

    }

?>