<?php include "operacionesGenerales.php";
    $cumplido=insertarCompra($_POST['id_vendedor'],$_POST['id_cliente'], $_POST['id_producto'], $_POST['cantidad']);
    if ($cumplido==true) {
        
        header("Location: ../index.php");

    } else {

        $error = "Datos incorrectos o no se ha actualizado nada";
                        
    }
?>