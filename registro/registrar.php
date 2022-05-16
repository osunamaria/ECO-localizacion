<?php

    $servidor = "localhost";
    $baseDatos = "cleanvibes";
    $user = "root";
    $pass = "";

    $usuario=$_POST["usuario"];
    $contrasena= $_POST["contrasena"];
    $nombre=$_POST["nombre"];
    $apellidos=$_POST["apellidos"];
    $dni=$_POST["dni"];
    $correo=$_POST["correo"];
    $telefono=$_POST["telefono"];
    $fecnac=$_POST["fecnac"];
    $num_miembros=$_POST["num_miembros"];

    $letra = substr($dni, -1);
    $numeros = substr($dni, 0, -1);

    //Edad
    list($ano,$mes,$dia) = explode("-",$_POST["fecnac"]);
    $ano_diferencia  = date("Y") - $ano;
    $mes_diferencia = date("m") - $mes;
    $dia_diferencia   = date("d") - $dia;
    if ($dia_diferencia < 0 || $mes_diferencia < 0){
        $ano_diferencia--;
    }
  
    if($usuario=="" || $contrasena=="" || $nombre=="" || $apellidos=="" || $dni=="" || $correo=="" || $telefono=="" || $fecnac=="" || $num_miembros==""){
        
        echo "Debe rellenar todos los campos<br><br>";
        echo "<a href='index.php'>[Volver]</a>";

    }else if(substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1) == $letra && strlen($letra) == 1 && strlen ($numeros) == 8){

        echo "DNI incorrecto<br><br>";
        echo "<a href='index.php'>[Volver]</a>";
    
    }else if($ano_diferencia<=14){
    
        echo "Debes tener más de 14 años<br><br>";
        echo "<a href='index.php'>[Volver]</a>";

    }else{

        try {
            if($num_miembros==1){
                $cuota=60;
            }else if($num_miembros>1 && $num_miembros<6){
                $cuota=70;
            }else if($num_miembros>5 && $num_miembros<11){
                $cuota=85;
            }else if($num_miembros>10){
                $cuota=90;
            }
            $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
            $sql = $con->prepare("INSERT into socios values(null, :usuario , :contrasena , :nombre , :apellidos , :dni , 'socio' , :correo , :telefono ,:fecnac , :num_miembros , :cuota, '0')");
            $sql->bindParam(":usuario", $usuario);
            $sql->bindParam(":contrasena", $contrasena);
            $sql->bindParam(":nombre", $nombre);
            $sql->bindParam(":apellidos", $apellidos);
            $sql->bindParam(":dni", $dni);
            $sql->bindParam(":correo", $correo);
            $sql->bindParam(":telefono", $telefono);
            $sql->bindParam(":fecnac", $fecnac);
            $sql->bindParam(":num_miembros", $num_miembros);
            $sql->bindParam(":cuota", $cuota);
            $sql->execute();
            $id = $con->lastInsertId();
            $con = null;
            if ($id != 0) {
                header("Location: ../index.php");
            } else {
                echo "Datos incorrectos<br><br>";
                echo "<a href='index.php'>[Volver]</a>";
            }
        } catch (PDOException $e) {
            header("location: ../php/error.php");
        }

    }

?>