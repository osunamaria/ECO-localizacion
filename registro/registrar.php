<?php include_once "../php/databaseManagement.inc.php";
      include_once "operacionesGenerales.php";

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
        $error="";
        $mismoUsuario=false;
        $nombresUsuario=obtenerNombresUsuario();
        for ($i=0;$i<sizeof($nombresUsuario);$i++){
            
            if($nombresUsuario[$i]['usuario']==$usuario){
                $mismoUsuario=true;                        
            }
        }


        $letra = substr($dni, -1);
        $numeros = substr($dni, 0, -1);
    
        if($usuario=="" || $contrasena=="" || $nombre=="" || $apellidos=="" || $dni=="" || $correo=="" || $telefono==""){
            
            $error = "Debe rellenar todos los campos.<br><br>";

        }else if($mismoUsuario){

            $error = "Ese nombre de usuario ya existe.<br><br>";

        }else if(!substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1) == $letra && strlen($letra) == 1 && strlen ($numeros) == 8){

            $error = "DNI incorrecto.<br><br>";

        }else if(!strpos($correo,'.') || strpos($correo,'.')<strpos($correo,'@')){

            $error = "Correo incorrecto.<br><br>";

        }else{

            try {
                $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
                $sql = $con->prepare("INSERT into clientes values(null, :usuario , :contrasena , :nombre , :apellidos , :dni , :correo , :telefono, 'cliente' , '0' , :ciudad, :localidad, :direccion, :cp)");
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
                    $error = "Datos incorrectos.<br><br>";
                }
            } catch (PDOException $e) {
                // header("location: ../php/error.php");
                echo $e;
            }

        }

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>

    <!-- linkear con fuente belleza -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Calligraffitti&display=swap" rel="stylesheet">

    <!-- links css -->
    <link rel="stylesheet" href="../css/headers.css">
    <link rel="stylesheet" href="../css/registro.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- link para iconos -->
    <link rel="stylesheet" href="../fontawesome-free-5.15.4-web/css/all.min.css">

    <!-- links js -->
    <script src="../js/registro.js"></script>

</head>

<body>
    <header class="d-flex flex-wrap justify-content-center py-3 border-bottom cabecera">
        <a href="../index.php" class="me-md-auto ms-5">
            <img src="../img/Captura-removebg-preview.png" class="logo">
        </a>

        <ul class="nav nav-pills mt-4">
            <li class="nav-item"><a href="../index.php" class="nav-link text-white">Inicio</a></li>
            <li class="nav-item"><a href="../vendedores/index.php" class="nav-link text-white">Vendedores</a></li>
        </ul>
    </header>
    <section>
        <article>
            <div class="container d-flex justify-content-center">
                <div class="error">
                    <?php 
                        echo $error;
                        echo "<a href='index.php' class='text-center botonComprar'>Volver</a>";
                    ?>
                </div>
            </div>
        </article>
    </section>
    <script src="../js/bootstrap.bundle.min"></script>
</body>

</html>