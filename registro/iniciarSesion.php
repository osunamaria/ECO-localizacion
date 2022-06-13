<?php include_once "../php/databaseManagement.inc.php";


    $usuario=$_POST["usuario"];
    $contrasena= $_POST["contrasena"];
    $error="";

    try {
        $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
        $sql = $con->prepare("SELECT id,tipo,confirmado FROM clientes WHERE usuario=:usuario AND contrasena=:contrasena");
        $sql->bindParam(":usuario", $usuario);
        $sql->bindParam(":contrasena", $contrasena);
        $sql->execute();

        $persona = $sql->fetch(PDO::FETCH_ASSOC); //Recibimos el id

        if ($persona!="") {
            if($persona['tipo']=='vendedor'){
                if($persona['confirmado']!='1'){
                    $error = "Tu usuario aun no ha sido confirmado, puede tardar un par de dias en estar activo.<br><br>";
                }else{
                    //Inicio sesion
                    //Sesion id seria el tipo de usuario
                    session_id($persona['tipo']);
                    session_start();
                        
                    // Variables de sesión:
                    $_SESSION['sesion_iniciada'] = true;
                    $_SESSION['username'] = $usuario;
                    $_SESSION['id'] = $persona['id'];
                    header("location: ../index.php");  
                }
            }else{
                //Inicio sesion
                //Sesion id seria el tipo de usuario
                session_id($persona['tipo']);
                session_start();
                    
                // Variables de sesión:
                $_SESSION['sesion_iniciada'] = true;
                $_SESSION['username'] = $usuario;
                $_SESSION['id'] = $persona['id'];
                header("location: ../index.php");  
            }
            
        } else {
            //Error inicio sesion
            $error = "Datos incorrectos.<br><br>";

        }
        $con = null; //Cerramos la conexión
    } catch (PDOException $e) {
        header("location: ../php/error.php");
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
    <link rel="stylesheet" href="../css/erroresRegistro.css">
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
            <div class="container mt-5">
                <div class="error">
                    <div class="text-center">
                        <?php 
                            echo $error;
                            // echo "<a href='index.php' class='text-center botonComprar'>Volver</a>";
                        ?>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href='index.php' class='text-center botonComprar'>Volver</a>
                    </div>
                </div>
            </div>
        </article>
    </section>
    <script src="../js/bootstrap.bundle.min"></script>
</body>

</html>