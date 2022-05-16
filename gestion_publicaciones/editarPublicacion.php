<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- linkear con fuente belleza -->
   <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Belleza&display=swap" rel="stylesheet">

    <!-- links css -->
    <link rel="stylesheet" href="../css/headers.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/publicaciones.css">
    <link rel="stylesheet" href="../css/formPublicacion.css">


    <!-- link para iconos -->
    <link rel="stylesheet" href="../fontawesome-free-5.15.4-web/css/all.min.css">

    <!-- bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Editar Publicaciones</title>
</head>
<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <a href="../index.php" class="me-md-auto">
                <span class="fs-4"><img src="../img/logoOriginal.png" class="img-fluid"></span>
            </a>

            <ul class="nav nav-pills mt-4">
                <li class="nav-item"><a href="../index.php" class="nav-link text-secondary">Inicio</a></li>
                <li class="nav-item"><a href="../publicaciones/index.php" class="nav-link text-secondary">Publicaciones</a></li>
                <?php
                // Continuar la sesión
                session_start();

                if(isset($_SESSION['sesion_iniciada']) == true ){
                    $tipo = session_id();
                    if($tipo=="presidente" || $tipo=="administrador" || $tipo=="socio"){
                        echo "<li class='nav-item'><a href='../reservas/index.php' class='nav-link text-secondary'>Reservas</a></li>";
                    }
                    if($tipo=="presidente" || $tipo=="administrador"){
                        echo "<li class='nav-item dropdown'>";
                            echo "<a class='nav-link dropdown-toggle text-secondary' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>";
                                echo "Gestiones";
                            echo "</a>";
                            echo "<ul class='dropdown-menu' aria-labelledby='navbarDropdown'>";
                                    echo "<li><a class='dropdown-item' href='../gestion_cuentas/index.php'>Usuarios</a></li>";
                                    echo "<li><a class='dropdown-item' href='index.php'>Publicaciones</a></li>";
                                    echo "<li><a class='dropdown-item' href='../instalaciones/index.php'>Instalaciones</a></li>";
                                    echo "<li><a class='dropdown-item' href='../contabilidad/index.php'>Contabilidad</a></li>";
                                echo "</ul>";
                        echo "</li>";
                    }
                    echo "<li class='nav-item me-md-auto'><a href='../cerrarSesion.php' class='nav-link active bg-secondary rounded-pill' aria-current='page'>Cerrar sesión</a></li>";
                }else{
                    echo "<li class='nav-item me-md-auto'><a href='../registro/index.php' class='nav-link active bg-secondary rounded-pill' aria-current='page'>Entrar</a></li>";
                }//Fin si
            ?>
            </ul>
    </header>
    </div>
<body>

    <?php include "metodos.php";

    if (count($_GET) > 0) {
        $id = $_GET["varId"];
        $publicacion = obtenerPublicacion($id);
    } else {
        $id = $_POST["id"];
        $publicacion = obtenerPublicacion($id);
    }
    $error = '';
    if (count($_POST) > 0) {
        function seguro($valor)
        {
            $valor = strip_tags($valor);
            $valor = stripslashes($valor);
            $valor = htmlspecialchars($valor);
            return $valor;
        }

        $cumplido = editarPublicacion($id, $_POST["titulo"], $_POST["publicacion"], $_POST["tipo"], $_POST["contenido"], $_POST["fecha"]);
        if ($cumplido == true) {
            header("Location: index.php?varId=" . $id);
            exit();
        } else {
            $error = "Datos incorrectos o no se ha actualizado nada";
        }
    }
    ?>
<article>
    <form class="form-register" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
        <h2 class="form-titulo">Características:</h2>
        <div class="contenedor-inputs">
            <input type="hidden" name="id" value="<?php echo $publicacion["id"]; ?>">
            <!--aquí va el id, es hidden por lo tanto no es visible en la web, pero si accesible desde PHP -->
            

            <input type="text" name="titulo" placeholder='<?php echo $publicacion["titulo"]; ?>' class="input-100" required value='<?php echo $publicacion["titulo"]; ?>'><br><br>

            <!-- CHECKEAR REQUIRE -->
            Evento<input type="radio" name="publicacion" class="input-100" required value='<?php $publicacion["publicacion"] = "evento"; echo $publicacion["publicacion"]; ?>'>
            Noticia<input type="radio" name="publicacion" class="input-100" value='<?php $publicacion["publicacion"] = "noticia"; echo $publicacion["publicacion"]; ?>'><br><br>

            Publico<input type="radio" name="tipo" class="input-100" value='<?php $publicacion["tipo"] = "publico"; echo $publicacion["tipo"]; ?>'>
            Privado<input type="radio" name="tipo" class="input-100" value='<?php $publicacion["tipo"] = "privado"; echo $publicacion["tipo"]; ?>' required><br><br>

            <textarea name="contenido" id="contenido" placeholder='<?php echo $publicacion["contenido"]; ?>' required value='<?php echo $publicacion["contenido"]; ?>'></textarea><br><br>

            <input type="date" name="fecha" placeholder='<?php echo $publicacion["fecha"]; ?>' class="input-100" required value='<?php echo $publicacion["fecha"]; ?>'><br><br>

            <input type="submit" value="Guardar Cambios" class="btn-enviar">
            <div id="errores"><?php echo $error; ?></div>
        </div>
    </form>
    </article>

    <footer class="fixed-bottom d-flex flex-wrap justify-content-center align-items-center py-3 mt-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
            <a href="../index.php" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                <img src="../img/logoNaranja.png" alt="logo">
            </a>
            <span class="text-muted">&copy; 2021 Company, Inc</span>
        </div>

        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex fs-1">
            <li class="m-5"><i class="fab fa-instagram"></i></li>
            <li class="m-5"><i class="fab fa-twitter"></i></li>
            <li class="m-5"><i class="fab fa-facebook-square"></i></li>
        </ul>
    </footer>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>