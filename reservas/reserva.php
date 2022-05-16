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
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/reservas.css">
    <link rel="stylesheet" href="../css/tablaReservas.css">
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
        <form action="hacerReserva.php" method="POST">
            <table class="table">
                <thead>
                    <tr>

                <?php
                //Conectar base de datos
                $servidor = "localhost";
                $baseDatos = "cleanvibes";
                $user = "root";
                $pass = "";

                $id_instalacion = $_POST['id_instalacion'];

                $fecha_actual = date("Y-m-d");

                for($i=0;$i<7;$i++){
                    echo "<th>".date("Y-m-d",strtotime($fecha_actual."+ ".$i." days"))."</th>";
                }//Fin Para

                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                //Luego en la tabla de reservas, me traigo las hora inicio/hora fin, distinguiendo las fechas
                //Desde la misma consulta, y seis dias mas
                //Tabla de 7 columnas, distinguiendo horarios disponibles

                //Generar tabla, preguntar las horas que estan registradas en la base de datos, que seran las que no estan disponibles

                try {
                    $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
                    $sql = $con->prepare("SELECT hora_inicio,fecha
                                            FROM `reservas`
                                            WHERE id_instalacion=:id_instalacion ");
                    $sql->bindParam(":id_instalacion", $id_instalacion);
                    $sql->execute();
                    $miArray=[];
                    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) { //Haciendo uso de PDO iremos creando el array dinámicamente
                        $miArray[] = $row; //https://www.it-swarm-es.com/es/php/rellenar-php-array-desde-while-loop/972445501/
                    }//Fin Mientras


                    //Si no es una pista, tendra un horario diferente
                    if($id_instalacion!=7){

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

                        //i: dias
                        //n: cada reserva que existe en nuestra bd
                        //j: las horas de reserva

                        //Cojo la fecha actual
                        $fecha_actual = date("Y-m-d");

                        //Recorriendo horas
                        for($j=0;$j<sizeof($horario);$j++){
                            echo "<tr>";
                            //Recorro los dias
                            for($i=0;$i<7;$i++){
                                $fecha = date("Y-m-d",strtotime($fecha_actual."+ ".$i." days"));

                                //Recorro el array mientras me de falso
                                //Interruptor para saber si esta reservada 
                                $n = 0;
                                $pistaReservada = false;
                                while(!$pistaReservada && $n<sizeof($miArray)){
                                    $pistaReservada = $miArray[$n]['fecha'] == $fecha && $miArray[$n]['hora_inicio'] == $horario[$j];
                                    $n++;
                                }//Fin Mientras

                                if($pistaReservada){
                                    echo "<td class='bg-danger'>".$horario[$j]."</td>";
                                }else{
                                    echo "<td class='bg-success'>".$horario[$j]."<input type='checkbox' id='id_reserva[]' name='id_reserva[]' value='".$id_instalacion."/".$fecha."/".$horario[$j]."'></td>";
                                }//Fin Si
                            }//Fin Para
                            echo "</tr>";
                        }//Fin Para
                    }else{
                    
                        $horario = array(
                            0 => "08:00:00",
                            1 => "12:00:00",
                            2 => "16:00:00",
                            3 => "20:00:00"
                        );

                        //i: dias
                        //n: cada reserva que existe en nuestra bd
                        //j: las horas de reserva

                        //Cojo la fecha actual
                        $fecha_actual = date("Y-m-d");

                        //Recorriendo horas
                        for($j=0;$j<sizeof($horario);$j++){
                            echo "<tr>";
                            //Recorro los dias
                            for($i=0;$i<7;$i++){
                                $fecha = date("Y-m-d",strtotime($fecha_actual."+ ".$i." days"));

                                //Recorro el array mientras me de falso
                                //Interruptor para saber si esta reservada 
                                $n = 0;
                                $pistaReservada = false;
                                while(!$pistaReservada && $n<sizeof($miArray)){
                                    $pistaReservada = $miArray[$n]['fecha'] == $fecha && $miArray[$n]['hora_inicio'] == $horario[$j];
                                    $n++;
                                }//Fin Mientras

                                if($pistaReservada){
                                    echo "<td class='bg-danger'>".$horario[$j]."</td>";
                                }else{
                                    echo "<td class='bg-success'>".$horario[$j]."<input type='checkbox' id='id_reserva[]' name='id_reserva[]' value='".$id_instalacion."/".$fecha."/".$horario[$j]."'></td>";
                                }//Fin Si
                            }//Fin Para
                            echo "</tr>";
                        }//Fin Para

                    }//Fin Si

                    $con = null; //Cerramos la conexión
                } catch (PDOException $e) {
                    header("location: ../php/error.php");
                }
                ?>
                </tbody>
            </table>
            
            <div class="row my-2">
                <label for="num_socio" class="form-label col-2">Num socios:</label>
                <input type="number" name="num_socios" id="num_socio" class="col-4" min="0" required>
            </div>
            <div class="row my-2">
                <label for="num_no_socio" class="form-label col-2">Num NO socios:</label>
                <input type="number" name="num_no_socios" id="num_no_socio" class="col-4" min="0" required>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <button class="btn btn-primary" type="submit">Reservar</button>
            </div>           
        </form>
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