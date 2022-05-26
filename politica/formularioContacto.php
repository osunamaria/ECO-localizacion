<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- linkear con fuente belleza -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Calligraffitti&display=swap" rel="stylesheet">

    <!-- link para iconos -->
    <link rel="stylesheet" href="fontawesome-free-5.15.4-web/css/all.min.css">

    <!-- bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- links css -->
    <link rel="stylesheet" href="../css/headers.css">
    <link rel="stylesheet" href="../css/formContacto.css">
    <title>Contacto</title>
</head>

<body>
    <header class="d-flex flex-wrap justify-content-center py-3 cabecera">
        <a href="../index.php" class="me-md-auto ms-5">
            <img src="../img/Captura-removebg-preview.png" class="logo">
        </a>

        <ul class="nav nav-pills mt-4">
            <li class="nav-item"><a href="../index.php" class="nav-link text-white">Inicio</a></li>
            <li class="nav-item"><a href="../productos/index.php" class="nav-link text-white">Productos</a></li>
            <li class="nav-item"><a href="../vendedores/index.php" class="nav-link text-white">Vendedores</a></li>
            <?php
                // Continuar la sesión
                session_start();

                if(isset($_SESSION['sesion_iniciada']) == true ){
                    $tipo = session_id();
                    if($tipo=="vendedor"){
                        echo "<li class='nav-item'><a href='ventas/index.php' class='nav-link text-white'>Ventas</a></li>";
                        echo "<li class='nav-item'><a href='administracion_productos/index.php' class='nav-link text-white'>Administrar productos</a></li>";
                    }
                    if($tipo=="administrador"){
                        echo "<li class='nav-item dropdown'>";
                            echo "<a class='nav-link dropdown-toggle text-white' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>";
                                echo "Gestiones";
                            echo "</a>";
                            echo "<ul class='dropdown-menu' aria-labelledby='navbarDropdown'>";
                                echo "<li><a class='dropdown-item' href='gestion_cuentas/index.php'>Usuarios</a></li>";
                                echo "<li><a class='dropdown-item' href='gestion_publicaciones/index.php'>Publicaciones</a></li>";
                                echo "<li><a class='dropdown-item' href='ventas/index.php'>Ventas</a></li>";
                                echo "<li><a class='dropdown-item' href='atencion_cliente/index.php'>Atención al cliente</a></li>";
                            echo "</ul>";
                        echo "</li>";
                    }
                    echo "<li class='nav-item me-md-auto'><a href='../cerrarSesion.php' class='nav-link active bg-secondary rounded-pill me-5' aria-current='page'>Cerrar sesión</a></li>";
                }else{
                    echo "<li class='nav-item me-md-auto'><a href='../registro/index.html' class='nav-link active bg-success rounded-pill me-5' aria-current='page'>Entrar</a></li>";
                }//Fin si
            ?>
        </ul>
    </header>

    <section>
        <article>
            <h3 class="text-center tamano">CONTACTO</h3>
        </article>
        
        <article>
            <div class="container mb-5">
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <form action="envioContacto.php" method="POST" enctype="multipart/form-data" id="formRegistro">
                            <table>
                                <tr>
                                    <td>
                                        <label for="correo">Correo</label>
                                    </td>
                                    <td class="justify-content-between">
                                        <input type="text" name="correo" id="correo" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <label for="mensaje">Mensaje</label>
                                        <br><br>
                                        <textarea name="mensaje" id="mensaje" rows="10"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <input class="botones" type="submit" value="Enviar">
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </article>
    </section>

    <footer class="d-flex text-white cabecera">
        <div class="container-fluid py-3">
            <div class="row justify-content-around align-items-center text-center">

                <div class="col-xl-4 col-sm-12">
                    <ul class="d-flex lista justify-content-around align-items-center">
                        <li><a class="text-decoration-none text-white" href="privacidad.php">Política de privacidad</a></li>
                        <li><a class="text-decoration-none text-white" href="cookies.php">Política de cookies</a></li>
                        <li><a class="text-decoration-none text-white" href="contacto.php">Contacto</a></li>
                    </ul>
                </div>

                <div class="col-xl-4 col-sm-12">
                    <a href="../index.php" class="text-decoration-none">
                        <h3 class="text-white text-center">ECO-localización</h3>
                    </a>
                </div>

                <div class="col-xl-4 mt-4 col-sm-12">
                    <p>© ECO-localización, todos los derechos reservados</p>
                </div>

            </div>
        </div>
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>