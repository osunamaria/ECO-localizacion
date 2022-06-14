<?php include_once "operacionesGenerales.php";


    //Comprobacion
    if (count($_POST) > 0) {

        $error = '';

        //comprobación
        if($_POST["cantidad"]=="" || $_POST["precio"]==""){
            
            echo "Debe rellenar todos los campos";

        }else{

            $cumplido = editarProducto($_POST["id"], $_POST["cantidad"], $_POST["precio"]);

            if ($cumplido==true) {

                header("Location: index.php");

            } else {

                $error = "Datos incorrectos o no se ha actualizado nada";
                
            }
        }
    }
?>