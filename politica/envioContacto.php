<?php include_once "operacionesGenerales.php";
    if (count($_POST) > 0) {
        $correo=$_POST['correo'];
        $mensaje=$_POST['mensaje'];
        confirmarVenta($correo,$mensaje);
    }
?>