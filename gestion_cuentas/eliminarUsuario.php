<?php include_once "operacionesGenerales.php";
    if(isset($_GET['varId'])){
        eliminarUsuario($_GET['varId']);
    }
    header("location: index.php");
    //Al confirmar venta debería bajar la cantidad de producto del vendedor
?>