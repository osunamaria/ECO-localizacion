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
    <link rel="stylesheet" href="../css/metodoPago.css">
    <title>Comprar</title>
</head>

<body>
    <header class="d-flex flex-wrap justify-content-center py-3 cabecera">
        <a href="../index.php" class="me-md-auto ms-5">
            <img src="../img/Captura-removebg-preview.png" class="logo">
        </a>

        <ul class="nav nav-pills mt-4">
            <li class="nav-item"><a href="index.php" class="nav-link text-white">Inicio</a></li>
            <li class="nav-item"><a href="../vendedores/index.php" class="nav-link text-white">Vendedores</a></li>
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

    <section class="container text-center">
        
        <article">
            <div class="row">
                <h3 class="mb-3 text-center mt-5">Tu compra</h3>
                <div>
                    <table class="d-flex justify-content-center mt-5">
                        <form class="needs-validation form-register" action="insertarCompra.php" method="POST" enctype="multipart/form-data" id="formRegistro" novalidate>
                            <?php include_once "operacionesGenerales.php";
                                $id=$_POST['id'];
                                $producto=$_POST['producto'];
                                $cantidad=$_POST['cantidad'];
                                $precioProducto=obtenerPrecio($id,$producto);
                                $id_producto=obtenerIdProducto($producto);
                                echo "<input type='hidden' name='id_vendedor' value='".$id."'>";
                                echo "<input type='hidden' name='id_cliente' value='".$_SESSION['id']."'>";
                                echo "<input type='hidden' name='id_producto' value='".$id_producto['id']."'>";
                                echo "<input type='hidden' name='cantidad' value='".$cantidad."'>";
                                echo "<div class='mb-5'>";
                                    echo "<table class='mb-2'>";
                                        echo "<tr>";
                                            if($cantidad>1){
                                                echo "<td class='text-center' colspan='2'>".$cantidad." ".$producto."s por ".($cantidad*$precioProducto['precio'])."&#8364</td>";
                                            }else{
                                                echo "<td class='text-center' colspan='2'>1 ".$producto." por ".$precioProducto['precio']."&#8364</td>";
                                            }
                                        echo "</tr>";
                                        echo "<tr>";
                                            echo "<td colspan='2'><hr></td>";
                                        echo "</tr>";
                                        
                            ?>
                            <tr>
                                <td colspan="2" class="py-2"><br></td>
                            </tr>
                            <tr>
                                <td><label for="pago">Método de pago</label></td>
                                <td>
                                    <select class='form-control' name="pago" id="pago" class="datos">
                                        <option value="bizum">Bizum</option>
                                        <option value="paypal">Paypal</option>
                                    </select>
                                </td>
                            </tr>
                            <?php include_once "operacionesGenerales.php";
                                        echo "<tr>";
                                            echo "<td><input class='botonComprar' type='submit' value='Comprar'></td>";
                                            echo "<td class='text-center py-5'><a class='botonComprar' href='index.php'>Cancelar</a></td>";
                                        echo "</tr>";
                                    echo "</table>";
                                echo "</div>";
                            ?>
                        </form>
                    </table>
                </div>
            </div>
        </article>
    </section>
    
    <footer class="d-flex text-white pie cabecera piePag">
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