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
    <link rel="stylesheet" href="../css/mostrarVendedores.css">
    <title>Vendedores</title>
</head>

<body>
    <header class="d-flex flex-wrap justify-content-center py-3 cabecera">
        <a href="../index.php" class="me-md-auto ms-5">
            <img src="../img/Captura-removebg-preview.png" class="logo">
        </a>

        <ul class="nav nav-pills mt-4">
            <li class="nav-item"><a href="../index.php" class="nav-link text-white">Inicio</a></li>
            <li class="nav-item"><a href="index.php" class="nav-link text-white">Vendedores</a></li>
            <?php
                // Continuar la sesión
                session_start();

                if(isset($_SESSION['sesion_iniciada']) == true ){
                    $tipo = session_id();
                    if($tipo=="vendedor"){
                        echo "<li class='nav-item'><a href='../administracion_productos/ventas.php' class='nav-link text-white'>Ventas</a></li>";
                        echo "<li class='nav-item'><a href='../administracion_productos/index.php' class='nav-link text-white'>Administrar productos</a></li>";
                    }
                    if($tipo=="administrador"){
                        echo "<li class='nav-item dropdown'>";
                            echo "<a class='nav-link dropdown-toggle text-white' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>";
                                echo "Gestiones";
                            echo "</a>";
                            echo "<ul class='dropdown-menu' aria-labelledby='navbarDropdown'>";
                                echo "<li><a class='dropdown-item' href='../gestion_cuentas/index.php'>Nuevos vendedores</a></li>";
                                echo "<li><a class='dropdown-item' href='../atencion_cliente/index.php'>Atención al cliente</a></li>";
                            echo "</ul>";
                        echo "</li>";
                    }
                    echo "<li class='nav-item me-md-auto'><a href='../cerrarSesion.php' class='nav-link active bg-secondary rounded-pill me-5' aria-current='page'>Cerrar sesión</a></li>";
                }else{
                    echo "<li class='nav-item me-md-auto'><a href='../registro/index.php' class='nav-link active bg-success rounded-pill me-5' aria-current='page'>Entrar</a></li>";
                }//Fin si
            ?>
        </ul>
    </header>

    <section>
        <article class="d-flex justify-content-around align-items-center">
            <div class="container" id="contenedor">


                    <?php include_once "operacionesGenerales.php";
                    $cp = $_POST['cp'];
                    $vendedores = obtenerVendedores ($cp);
                    if(sizeof($vendedores)<1){
                        header("location: 404.php");
                    }

                    echo "<h3 class='tamano text-center mb-5'>Vendedores en el área $cp</h3>";

                    for ($i=0;$i<sizeof($vendedores);$i++){
                        echo "<div class='contenedores mb-5'>";
                            echo "<fieldset>";
                                echo "<legend class='text-center py-1'>".$vendedores[$i]['usuario']."</legend>";
                                echo "<table class='mb-2'>";
                                    echo "<tr>";
                                        echo "<th class='text-center'><u>Productos</u></th>";
                                        echo "<th class='text-center'><u>Cantidad</u></th>";
                                        echo "<th class='text-center'><u>Precio/Unidad</u></th>";
                                    echo "</tr>";
                                    $productos=obtenerProductos($vendedores[$i]['id']);
                                    for ($n=0;$n<sizeof($productos);$n++){
                                        echo "<tr>";
                                            echo "<td>".$productos[$n]['producto']."</td>";
                                            echo "<td>".$productos[$n]['cantidad']."</td>";
                                            echo "<td>".$productos[$n]['precio']."&#8364</td>";
                                        echo "</tr>";
                                    }
                                    
                                    if(isset($_SESSION['sesion_iniciada']) == true ){
                                        echo "<tr>";
                                            echo "<td class='text-center py-4' colspan='3'><a class='botonComprar' href='comprar.php?varId=".$vendedores[$i]["id"]."'>Comprar a este vendedor</a></td>";
                                        echo "</tr>";
                                    }
                                    
                                echo "</table>";
                            echo "</fieldset>";  
                        echo "</div>";
                    }
                    ?>                   

            </div>
        </article>
    </section>

    <?php include_once "operacionesGenerales.php";
        if(sizeof($vendedores)>2){
            echo "<footer class='d-flex text-white cabecera'>";
        }else{
            echo "<footer class='pie text-white cabecera'>";
        }
    ?>
        <div class="container-fluid py-3">
            <div class="row justify-content-around align-items-center text-center">
                
                <div class="col-xl-4 col-sm-12">
                    <ul class="d-flex lista justify-content-around align-items-center">
                        <li><a class="text-decoration-none text-white" href="../politica/privacidad.php">Política de privacidad</a></li>
                        <li><a class="text-decoration-none text-white" href="../politica/cookies.php">Política de cookies</a></li>
                        <li><a class="text-decoration-none text-white" href="../politica/contacto.php">Contacto</a></li>
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