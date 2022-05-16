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

    <!-- link para iconos -->
    <link rel="stylesheet" href="../fontawesome-free-5.15.4-web/css/all.min.css">

    <!-- bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- links css -->
    <link rel="stylesheet" href="../css/headers.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/contabilidad.css">
    <title>Contabilidad</title>
</head>

<body>
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
                        echo "<li class='nav-item'><a href='index.php' class='nav-link text-secondary'>Reservas</a></li>";
                    }
                    if($tipo=="presidente" || $tipo=="administrador"){
                        echo "<li class='nav-item dropdown'>";
                            echo "<a class='nav-link dropdown-toggle text-secondary' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>";
                                echo "Gestiones";
                            echo "</a>";
                            echo "<ul class='dropdown-menu' aria-labelledby='navbarDropdown'>";
                                echo "<li><a class='dropdown-item' href='../gestion_cuentas/index.php'>Usuarios</a></li>";
                                echo "<li><a class='dropdown-item' href='../gestion_publicaciones/index.php'>Publicaciones</a></li>";
                                echo "<li><a class='dropdown-item' href='../instalaciones/index.php'>Instalaciones</a></li>";
                                echo "<li><a class='dropdown-item' href='index.php'>Contabilidad</a></li>";
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

    <article class="container">

        <!-- Para poder ver el total de un vistazo -->
        <?php include_once "metodos.php";

            $contabilidad = obtenerTodas();
            
            for ($i=0;$i<sizeof($contabilidad);$i++){
                //Gastos
                $total_gasto = $contabilidad[$i]['gasto_evento'] + $contabilidad[$i]['gasto_instalacion'] + $contabilidad[$i]['gasto_otro'];
                //Ingresos
                $total_ingreso = $contabilidad[$i]['ingreso_cuotas']+$contabilidad[$i]['ingreso_reservas'];
            }
            
            //Total
            $total = $total_ingreso - $total_gasto;

            //Diferencia positiva o negativa
            if($total_ingreso>$total_gasto){
                $signo = "+";
                $back = "bg-success";
            }else if($total_ingreso<$total_gasto){
                $signo = "-";
                $back = "bg-danger";
            }else{
                $signo = "";
                $back = "bg-secondary";
            }
            
            echo "<h2 class='gastos text-center mb-3 $back p-2'>Total = " . $signo . " " . $total . "</h2>";
        ?>
                
        <div class="col-12">
            <div class="row">
                <div class="ingresos col-6 bg-success p-3">
                    <h3 class="text-center">Ingresos</h3>
                    <hr>
                    <table class="fixed_headers">
                        <thead>
                            <tr>
                                <th scope="col">Cuotas</th>
                                <th scope="col">Reservas</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php include_once "metodos.php";
                        $contabilidad = obtenerTodas();
                        
                            for ($i=0;$i<sizeof($contabilidad);$i++){
                                // Total
                                echo "<tr>";
                                    echo "<td>".$contabilidad[$i]['ingreso_cuotas']."</td>";
                                    echo "<td>".$contabilidad[$i]['ingreso_reservas']."</td>";
                                    echo "<td>".$total_ingreso."</td>";
                                echo "</tr>";
                            }//Fin Para
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="gastos col-6 bg-danger p-3">
                    <h3 class="text-center">Gastos</h3>
                    <hr>
                    <table class="fixed_headers">
                        <thead>
                            <tr>
                                <th scope="col">Evento</th>
                                <th scope="col">Instalacion</th>
                                <th scope="col">Otros</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <?php include_once "metodos.php";
                        $contabilidad = obtenerTodas();
                        
                            for ($i=0;$i<sizeof($contabilidad);$i++){
                                // Total
                                echo "<tr>";
                                    echo "<td>".$contabilidad[$i]['gasto_evento']."</td>";
                                    echo "<td>".$contabilidad[$i]['gasto_instalacion']."</td>";
                                    echo "<td>".$contabilidad[$i]['gasto_otro']."</td>";
                                    echo "<td>".$total_gasto."</td>";
                                echo "</tr>";
                            }//Fin Para
                        ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </article>

    <footer class="d-flex flex-wrap justify-content-center align-items-center py-3 mt-4 border-top position-absolute bottom-0 w-100">
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
    <!-- Bootstrap JavaScript Libraries -->
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>