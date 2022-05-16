<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de usuarios</title>

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
                                echo "<li><a class='dropdown-item' href='index.php'>Usuarios</a></li>";
                                echo "<li><a class='dropdown-item' href='../gestion_publicaciones/index.php'>Publicaciones</a></li>";
                                echo "<li><a class='dropdown-item' href='../instalaciones/index.php'>Instalaciones</a></li>";
                                echo "<li><a class='dropdown-item' href='../contabilidad/index.php'>Contabilidad</a></li>";
                            echo "</ul>";
                        echo "</li>";
                    }
                    echo "<li class='nav-item me-md-auto'><a href='../cerrarSesion.php' class='nav-link active bg-secondary rounded-pill' aria-current='page'>Cerrar sesión</a></li>";
                }else{
                    echo "<li class='nav-item me-md-auto'><a href='registro/index.php' class='nav-link active bg-secondary rounded-pill' aria-current='page'>Entrar</a></li>";
                }//Fin si
            ?>
        </ul>
        </header>
    </div>
    <section>
        <article class="container">
        <form class="form-register" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
            <div class="tablon">
                <h2>Gestión de usuarios</h2>
                <div class="row">
                    <div class="col-3">
                        <select class="filtro" name="tema" id="tema">
                            <option value="usuarios">Usuarios</option>
                            <option value="nuevos">Nuevos registros</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <input type="submit" class="anadirAnuncio" value="Buscar"></input>
                    </div>
            </form>
                    <div class="col-7 justify-content-end">
                        <a href="insertarUsuario.php" class="anadirAnuncio"><i class="far fa-plus-square"></i> Nuevo usuario</a>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <!-- Obtener todas -->
                        <table class="fixed_headers">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>DNI</th>
                                    <th>Tipo</th>
                                    <th>Correo</th>
                                    <th>Telefono</th>
                                    <th>Fecha de nacimiento</th>
                                    <th>Número de miembros</th>
                                    <th>Cuota</th>
                                    <?php
                                        $busqueda=array_key_exists("tema",$_POST) ? $_POST["tema"] : "";
                                        if($busqueda=='nuevos'){
                                            echo "<th>Añadir</th>";
                                        }else{
                                            echo "<th>Editar</th>";
                                        }
                                    ?>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php include_once "operacionesGeneralesUsuarios.php";

                                    $busqueda=array_key_exists("tema",$_POST) ? $_POST["tema"] : "";
                                
                                    $usuarios = obtenerTodos($busqueda);
                        
                                    for ($i=0;$i<sizeof($usuarios);$i++){
                                        echo "<tr>";
                                            echo "<td>".$usuarios[$i]['nombre']."</td>";
                                            echo "<td>".$usuarios[$i]['apellidos']."</td>";
                                            echo "<td>".$usuarios[$i]['dni']."</td>";
                                            echo "<td>".$usuarios[$i]['tipo']."</td>";
                                            echo "<td>".$usuarios[$i]['correo']."</td>";
                                            echo "<td>".$usuarios[$i]['telefono']."</td>";
                                            echo "<td>".$usuarios[$i]['fecnac']."</td>";
                                            echo "<td>".$usuarios[$i]['num_miembros']."</td>";
                                            echo "<td>".$usuarios[$i]['cuota']."</td>";
                                            // Añadir foto de editar y eliminar fontawesaome
                                            if($busqueda=='nuevos'){
                                                echo "<td><a href='confirmarUsuario.php?varId=".$usuarios[$i]["id"]."'><i class='fas fa-solid fa-check'></i></a></td>";
                                            }else{
                                                echo "<td><a href='editarUsuario.php?varId=".$usuarios[$i]["id"]."'><i class='fas fa-edit'></i></a></td>";
                                            }
                                        echo "<td><a href='eliminarUsuario.php?varId=".$usuarios[$i]["id"]."'><i class='fas fa-trash-alt'></i></a></td>";
                                        echo "</tr>";
                                    }//Fin Para
                                ?>
                            </tbody>
                        </table>
                        <!-- Obtener todas Fin -->
                    </div>
                </div>
            </div>
        </article>
    </section>
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