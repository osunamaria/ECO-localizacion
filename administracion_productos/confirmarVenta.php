<?php include_once "operacionesGenerales.php";
    if(isset($_GET['varId'])){
        confirmarVenta($_GET['varId']);
    }
    header("location: ventas.php");
?>