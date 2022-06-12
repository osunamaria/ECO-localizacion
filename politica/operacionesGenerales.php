<?php include_once "../php/databaseManagement.inc.php";
    function confirmarVenta($correo,$mensaje){
        try {
            $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
            $sql = $con->prepare("INSERT into mensajes values(null, :correo , :mensaje , '0')");
            $sql->bindParam(":correo", $correo);
            $sql->bindParam(":mensaje", $mensaje);
            $sql->execute();
            $id = $con->lastInsertId();
            $con = null;
            if ($id == 0) {
                echo "Datos incorrectos";
            }
            header("location: ../index.php");
        } catch (PDOException $e) {
            // header("location: ../php/error.php");
            echo $e;
        }
    }
?>