<?php include "operacionesGenerales.php";
    echo "<script>alert('Compra realizada. El vendedor se pondrá en contacto contigo')</script>";
    $cumplido=insertarCompra($_POST['id_vendedor'],$_POST['id_cliente'], $_POST['id_producto'], $_POST['cantidad']);
    if ($cumplido==true) {
        
        header("Location: ../index.php");

    } else {

        $error = "Datos incorrectos o no se ha actualizado nada";
                        
    }
?>