<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar usuario</title>

    <!-- linkear con fuente belleza -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Belleza&display=swap" rel="stylesheet">

    <!-- links css -->
    <link rel="stylesheet" href="../css/headers.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/gestion_cuentas.css">

    <!-- link para iconos -->
    <link rel="stylesheet" href="../fontawesome-free-5.15.4-web/css/all.min.css">

    <!-- bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

</head>

<body>
    <div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <a href="../index.php" class="me-md-auto">
                <span class="fs-4"><img src="../img/logoOriginal.png" class="img-fluid"></span>
            </a>

            <ul class="nav nav-pills mt-4">
                <li class="nav-item"><a href="../index.php" class="nav-link text-secondary">Inicio</a></li>
                <li class="nav-item"><a href="../publicaciones/index.html" class="nav-link text-secondary">Publicaciones</a></li>
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
                                    echo "<li><a class='dropdown-item' href='index.php'>Usuarios</a></li>";
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
    <?php include_once "operacionesGeneralesUsuarios.php";

    if (count($_POST) > 0) {
        //Edad
        list($ano,$mes,$dia) = explode("-",$_POST["fecnac"]);
        $ano_diferencia  = date("Y") - $ano;
        $mes_diferencia = date("m") - $mes;
        $dia_diferencia   = date("d") - $dia;
        if ($dia_diferencia < 0 || $mes_diferencia < 0){
            $ano_diferencia--;
        }
        //Tipo de socio
        $tipo="";
        $socio=array_key_exists("socio",$_POST) ? $_POST["socio"] : "";
        $presidente=array_key_exists("presidente",$_POST) ? $_POST["presidente"] : "";
        $administrador=array_key_exists("administrador",$_POST) ? $_POST["administrador"] : "";
        if($socio!="" || $administrador=="" && $presidente=="" && $socio==""){
            $tipo .= "socio";
        }
        if($presidente!="" && $socio!=""){
            $tipo .= ",".$_POST["presidente"];
        }else if($presidente!="" && $socio==""){
            $tipo .= $_POST["presidente"];
        }
        if($administrador!="" && ($presidente!="" || $socio!="")){
            $tipo .= ",".$_POST["administrador"];
        }else if($administrador!="" && $presidente=="" && $socio==""){
            $tipo .= $_POST["administrador"];
        }
        //comprobación
        if($_POST["usuario"]=="" || $_POST["contrasena"]=="" || $_POST["nombre"]=="" || $_POST["apellidos"]=="" || $_POST["dni"]=="" || $_POST["correo"]=="" || $_POST["telefono"]=="" || $_POST["fecnac"]=="" || $_POST["num_miembros"]==""){
            
            echo "Debe rellenar todos los campos";

        }else if($ano_diferencia<=14){

            echo "Debe tener mas de 14 años";

        }else{

            insertarUsuario($_POST["usuario"], $_POST["contrasena"], $_POST["nombre"], $_POST["apellidos"], $_POST["dni"], $tipo, $_POST["correo"], $_POST["telefono"], $_POST["fecnac"], $_POST["num_miembros"]);
            header("Location: index.php");

        }
    }
    ?>
    <article>
        <div class="container">
            <h4 class="mb-3 text-center">Información</h4>
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data" id="formRegistro">
                <table>
                    <tr>
                        <td>
                            <label for="nombre">Usuario</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="usuario" placeholder="USUARIO" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="nombre">Contraseña</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="contrasena" placeholder="CONTRASEÑA" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="nombre">Nombre</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="nombre" placeholder="NOMBRE" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="apellidos">Apellidos</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="apellidos" placeholder="APELLIDOS" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="dni">DNI</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="dni" placeholder="DNI" required><br><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="correo">Correo</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="correo" placeholder="CORREO" required><br><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="correo">Fecha de nacimiento</label>
                        </td>
                        <td>
                            <input type="date" class="form-control" name="fecnac" required><br><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="telefono">Telefono</label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="telefono" placeholder="TELEFONO" required><br><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="num_miembros">Miembros de la familia</label>
                        </td>
                        <td>
                            <input type="number" class="form-control" name="num_miembros" placeholder="NUMERO DE MIEMBROS" min="1" required><br><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label for="tipo">Tipo (Debe tener mínimo un roll, sino se le asignará socio)</label>
                        </td>
                        <td>
                            Socio <input name="socio" id="socio" value="socio" type="checkbox">
                            Presidente <input name="presidente" id="presidente" value="presidente" type="checkbox">
                            Administrador <input name="administrador" id="administrador" value="administrador" type="checkbox"><br><br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Enviar">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    </article>

    <footer class="d-flex flex-wrap justify-content-center align-items-center py-3 mt-4 border-top">
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