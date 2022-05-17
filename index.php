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
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- links css -->
    <link rel="stylesheet" href="css/headers.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/inicio.css">
    <title>Inicio</title>
</head>

<body>
    <div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="index.php" class="me-md-auto">
            <img src="img/Captura-removebg-preview.png" class="logo">
        </a>

        <ul class="nav nav-pills mt-4">
            <li class="nav-item"><a href="index.php" class="nav-link text-secondary">Inicio</a></li>
            <li class="nav-item"><a href="productos/index.php" class="nav-link text-secondary">Productos</a></li>
            <li class="nav-item"><a href="vendedores/index.php" class="nav-link text-secondary">Vendedores</a></li>
            <?php
                // Continuar la sesión
                session_start();

                if(isset($_SESSION['sesion_iniciada']) == true ){
                    $tipo = session_id();
                    if($tipo=="vendedor"){
                        echo "<li class='nav-item'><a href='ventas/index.php' class='nav-link text-secondary'>Ventas</a></li>";
                        echo "<li class='nav-item'><a href='administracion_productos/index.php' class='nav-link text-secondary'>Administrar productos</a></li>";
                    }
                    if($tipo=="administrador"){
                        echo "<li class='nav-item dropdown'>";
                            echo "<a class='nav-link dropdown-toggle text-secondary' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>";
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
                    echo "<li class='nav-item me-md-auto'><a href='cerrarSesion.php' class='nav-link active bg-secondary rounded-pill' aria-current='page'>Cerrar sesión</a></li>";
                }else{
                    echo "<li class='nav-item me-md-auto'><a href='registro/index.php' class='nav-link active bg-success rounded-pill' aria-current='page'>Entrar</a></li>";
                }//Fin si
            ?>
        </ul>
        </header>
    </div>

    <section class="container">
        <article class="d-flex justify-content-around align-items-center fondo">
            <h3 class="tamano">ECO-localización</h3>
        </article>
        <article>
            <h3>¿Quiénes somos?</h3>
            <p>Somos un pequeño grupo de informáticos que decidió dar un paso para mejorar la vida y la salud de esas personas que quieren ser parte de ese cambio tan necesario e inevitable que estamos viviendo. 
            El mundo está evolucionando y las personas cada vez están más concienciadas con ellos mismos y su entorno. 
            Nosotros proponemos un tipo de comercio nuevo que apoya la ecología autosostenible y que refuerza el mercado local.
            </p>
        </article>
        <hr>
        <article>
            <h3>¿Qué hacemos?</h3>
            <p>Nuestrá página ofrece la posibilidad de que las personas que tienen huertos urbanos y tienen exceso de producción puedan ganar dinero vendiendo esos productos,
            a la vez que la gente que quiere productos ecológicos tenga acceso a estos por un precio más asequible.</p>
        </article>
        <hr>
    </section>
    
    <footer class="d-flex flex-wrap justify-content-center align-items-center py-3 mt-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
            <a href="index.php" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                <img src="img/Captura-removebg-preview.png" alt="logo">
            </a>
        </div>
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>