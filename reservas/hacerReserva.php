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
    <link rel="stylesheet" href="../css/footer.css">
    <title>Reservas</title>
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
                        echo "<li class='nav-item'><a href='../reservas/index.php' class='nav-link text-secondary'>Reservas</a></li>";
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

    <div class="container">

<?php
    //Si la sesión esta iniciada lo hago
    if(isset($_SESSION['sesion_iniciada']) == true ){
        //Conectar base de datos
        $servidor = "localhost";
        $baseDatos = "cleanvibes";
        $user = "root";
        $pass = "";

        //Recojo un array con las reservas, en caso de que sean varias
        $reservas = $_POST["id_reserva"];
        $num_socios = $_POST['num_socios'];
        $num_no_socios = $_POST['num_no_socios'];

        $horario = array(
            0 => "08:00:00",
            1 => "09:30:00",
            2 => "11:00:00",
            3 => "12:30:00",
            4 => "14:00:00",
            5 => "16:00:00",
            6 => "17:30:00",
            7 => "19:00:00",
            8 => "20:30:00"
        );

        try {
            $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
            $sql = $con->prepare("SELECT tipo
                                    FROM `instalaciones`
                                    WHERE id=:id_instalacion");
            //Cojo el id de la instalacion de la primera reserva.
            list($id_instalacion,$n,$m) = explode("/", $reservas[0]);
            $sql->bindParam(":id_instalacion", $id_instalacion);
            $sql->execute();
            $tipo_instalacion = $sql->fetch(PDO::FETCH_ASSOC); //Recojo el tipo de instalacion
            $con = null;
        } catch (PDOException $e) {
            header("location: ../php/error.php");
        }

        //Depende de la pista, tendra unas condiciones especificas
        switch($tipo_instalacion['tipo']){
            case "padel":
                //Para las pistas de padel tienen que ser 4 
                if(($num_no_socios+$num_socios)==4){
                    //Procedo a hacer las reservas
                    foreach ($reservas as $reserva){
                        //Como recojo tres variables juntas, las separo con el metodo explode
                        list($id_instalacion, $fecha, $hora_inicio) = explode("/", $reserva);
                        try {
                            $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
                            $sql = $con->prepare("INSERT into reservas values(:id_instalacion,:id_socio,:fecha,:hora_inicio,:hora_fin,:num_socios,:num_no_socios)");
                            $sql->bindParam(":id_instalacion", $id_instalacion);
                            $sql->bindParam(":id_socio", $_SESSION['id']);
                            $sql->bindParam(":fecha", $fecha);
                            $sql->bindParam(":hora_inicio", $hora_inicio);
                            //hora_fin sera la siguiente hora_inicio, y si es la ultima, sera 1 hora y media más
                            if(array_search($hora_inicio, $horario)==8){
                                $hora_fin = "21:30:00";
                            }else{
                                $hora_fin = $horario[array_search($hora_inicio, $horario)+1];
                            }//Fin Si
                            $sql->bindParam(":hora_fin", $hora_fin);
                            $sql->bindParam(":num_socios", $num_socios);
                            $sql->bindParam(":num_no_socios", $num_no_socios);
                            $sql->execute();
                            $con = null;
                        } catch (PDOException $e) {
                            header("location: ../php/error.php");
                        }
                    }//Fin foreach
                    echo "<h3>RESERVA REALIZADA CON ÉXITO. GRACIAS!</h3>";
                    echo "<a href='index.php'>Volver a página de reservas</a>";
                }else{
                    //Muestro error
                    echo "<h3>Para la pista de padel deben ser 4 participantes.</h3><br>";
                    echo "<a href='index.php'>Volver a página de reservas</a>";
                }//Fin Si
                break;
            case "tenis":
                //Para las pistas de tenis deben ser 2 o 4
                if(($num_no_socios+$num_socios)==2||($num_no_socios+$num_socios)==4){
                    //Procedo a hacer las reservas
                    foreach ($reservas as $reserva){
                        //Como recojo tres variables juntas, las separo con el metodo explode
                        list($id_instalacion, $fecha, $hora_inicio) = explode("/", $reserva);
                        try {
                            $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
                            $sql = $con->prepare("INSERT into reservas values(:id_instalacion,:id_socio,:fecha,:hora_inicio,:hora_fin,:num_socios,:num_no_socios)");
                            $sql->bindParam(":id_instalacion", $id_instalacion);
                            $sql->bindParam(":id_socio", $_SESSION['id']);
                            $sql->bindParam(":fecha", $fecha);
                            $sql->bindParam(":hora_inicio", $hora_inicio);
                            //hora_fin sera la siguiente hora_inicio, y si es la ultima, sera 1 hora y media más
                            if(array_search($hora_inicio, $horario)==8){
                                $hora_fin = "21:30:00";
                            }else{
                                $hora_fin = $horario[array_search($hora_inicio, $horario)+1];
                            }//Fin Si
                            $sql->bindParam(":hora_fin", $hora_fin);
                            $sql->bindParam(":num_socios", $num_socios);
                            $sql->bindParam(":num_no_socios", $num_no_socios);
                            $sql->execute();
                            $con = null;
                        } catch (PDOException $e) {
                            header("location: ../php/error.php");
                        }
                    }//Fin foreach
                    echo "<h3>RESERVA REALIZADA CON ÉXITO. GRACIAS!</h3>";
                    echo "<a href='index.php'>Volver a página de reservas</a>";
                }else{
                    //Muestro error
                    echo "<h3>Para la pista de tenis deben ser 2 o 4 participantes.</h3><br>";
                    echo "<a href='index.php'>Volver a página de reservas</a>";
                }//Fin Si
                break;
            case "futbol":
                //Futbol deben de ser 10
                if(($num_no_socios+$num_socios)==10){
                   //Procedo a hacer las reservas
                   foreach ($reservas as $reserva){
                    //Como recojo tres variables juntas, las separo con el metodo explode
                    list($id_instalacion, $fecha, $hora_inicio) = explode("/", $reserva);
                    try {
                        $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
                        $sql = $con->prepare("INSERT into reservas values(:id_instalacion,:id_socio,:fecha,:hora_inicio,:hora_fin,:num_socios,:num_no_socios)");
                        $sql->bindParam(":id_instalacion", $id_instalacion);
                        $sql->bindParam(":id_socio", $_SESSION['id']);
                        $sql->bindParam(":fecha", $fecha);
                        $sql->bindParam(":hora_inicio", $hora_inicio);
                        //hora_fin sera la siguiente hora_inicio, y si es la ultima, sera 1 hora y media más
                        if(array_search($hora_inicio, $horario)==8){
                            $hora_fin = "21:30:00";
                        }else{
                            $hora_fin = $horario[array_search($hora_inicio, $horario)+1];
                        }//Fin Si
                        $sql->bindParam(":hora_fin", $hora_fin);
                        $sql->bindParam(":num_socios", $num_socios);
                        $sql->bindParam(":num_no_socios", $num_no_socios);
                        $sql->execute();
                        $con = null;
                    } catch (PDOException $e) {
                        header("location: ../php/error.php");
                    }
                }//Fin foreach
                echo "<h3>RESERVA REALIZADA CON ÉXITO. GRACIAS!</h3>";
                echo "<a href='index.php'>Volver a página de reservas</a>";
                }else{
                    //Muestro error
                    echo "<h3>Para la pista de fútbol deben ser 10 participantes.</h3><br>";
                    echo "<a href='index.php'>Volver a página de reservas</a>";
                }//Fin Si
                break;
            case "baloncesto":
                //Baloncesto deben de ser 10
                if(($num_no_socios+$num_socios)==10){
                    //Procedo a hacer las reservas
                    foreach ($reservas as $reserva){
                        //Como recojo tres variables juntas, las separo con el metodo explode
                        list($id_instalacion, $fecha, $hora_inicio) = explode("/", $reserva);
                        try {
                            $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
                            $sql = $con->prepare("INSERT into reservas values(:id_instalacion,:id_socio,:fecha,:hora_inicio,:hora_fin,:num_socios,:num_no_socios)");
                            $sql->bindParam(":id_instalacion", $id_instalacion);
                            $sql->bindParam(":id_socio", $_SESSION['id']);
                            $sql->bindParam(":fecha", $fecha);
                            $sql->bindParam(":hora_inicio", $hora_inicio);
                            //hora_fin sera la siguiente hora_inicio, y si es la ultima, sera 1 hora y media más
                            if(array_search($hora_inicio, $horario)==8){
                                $hora_fin = "21:30:00";
                            }else{
                                $hora_fin = $horario[array_search($hora_inicio, $horario)+1];
                            }//Fin Si
                            $sql->bindParam(":hora_fin", $hora_fin);
                            $sql->bindParam(":num_socios", $num_socios);
                            $sql->bindParam(":num_no_socios", $num_no_socios);
                            $sql->execute();
                            $con = null;
                        } catch (PDOException $e) {
                            header("location: ../php/error.php");
                        }
                    }//Fin foreach
                    echo "<h3>RESERVA REALIZADA CON ÉXITO. GRACIAS!</h3>";
                    echo "<a href='index.php'>Volver a página de reservas</a>";
                }else{
                    //Muestro error
                    echo "<h3>Para la pista de baloncesto deben ser 10 participantes.</h3><br>";
                    echo "<a href='index.php'>Volver a página de reservas</a>";
                }//Fin Si
                break;
            case "barbacoa":
                //Procedo a la reserva si hay minimo un socio
                if($num_socios>0){
                    //Hago la reserva
                    foreach ($reservas as $reserva){
                        //Como recojo tres variables juntas, las separo con el metodo explode
                        list($id_instalacion, $fecha, $hora_inicio) = explode("/", $reserva);
                        try {
                            $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
                            $sql = $con->prepare("INSERT into reservas values(:id_instalacion,:id_socio,:fecha,:hora_inicio,:hora_fin,:num_socios,:num_no_socios)");
                            $sql->bindParam(":id_instalacion", $id_instalacion);
                            $sql->bindParam(":id_socio", $_SESSION['id']);
                            $sql->bindParam(":fecha", $fecha);
                            $sql->bindParam(":hora_inicio", $hora_inicio);
                            //hora_fin sera la siguiente hora_inicio, y si es la ultima, sera 1 hora y media más
                            if(array_search($hora_inicio, $horario)==8){
                                $hora_fin = "21:30:00";
                            }else{
                                $hora_fin = $horario[array_search($hora_inicio, $horario)+1];
                            }//Fin Si
                            $sql->bindParam(":hora_fin", $hora_fin);
                            $sql->bindParam(":num_socios", $num_socios);
                            $sql->bindParam(":num_no_socios", $num_no_socios);
                            $sql->execute();
                            $con = null;
                        } catch (PDOException $e) {
                            header("location: ../php/error.php");
                        }
                    }//Fin foreach
                    echo "<h3>RESERVA REALIZADA CON ÉXITO. GRACIAS!</h3>";
                    echo "<a href='index.php'>Volver a página de reservas</a>";
                }else{
                    //Muestro error
                    echo "<h3>Para la barbacoa debe de haber mínimo un socio.</h3><br>";
                    echo "<a href='index.php'>Volver a página de reservas</a>";
                }
                break;
            default:
                //Muestro error
                echo "<h3>El tipo de la instalación no se encuentra en nuestra base de datos.</h3><br>";
                echo "<a href='index.php'>Volver a página de reservas</a>";
        }//Fin Segun Sea
    }else{
        //Si no esta iniciada, le aviso
        echo "<h3>Debe iniciar sesión para hacer la reserva.</h3><br>";
        echo "<a href='index.php'>Volver a página de reservas</a>";
    }//Fin Si
?>

    </div>

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