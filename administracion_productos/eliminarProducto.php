<?php include_once "operacionesGenerales.php";
    if(isset($_GET['varId'])){
        eliminarProducto($_GET['varId']);
    }
    header("location: index.php");
?>