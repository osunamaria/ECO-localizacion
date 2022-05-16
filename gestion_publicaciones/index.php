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

    <!-- link para iconos -->
    <link rel="stylesheet" href="../fontawesome-free-5.15.4-web/css/all.min.css">

    <!-- bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    
    <title>Publicaciones</title>
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
    <article class="container">
        <div class="tablon">
            <h2>TABLÓN DE ANUNCIOS</h2>
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-3">
                        
                            <select class="filtro" name="tema" id="tema">
                                <option value="">Filtrar</option>
                                <option value="evento">Eventos</option>
                                <option value="noticia">Noticias</option>
                            </select>
                        
                    </div>
                    <div class="col-2">
                        <input type="submit" class="anadirAnuncio" value="Buscar"></input>
                    </div>
                    <div class="col-7 justify-content-end">
                        <a href="form.php" class="anadirAnuncio"><i class="far fa-plus-square"></i> Nueva publicación</a>
                    </div>
                </div>
            </form>
            <div class="row">
                <div>
                    <!-- Obtener todas -->
                    <table class="fixed_headers">
                        <thead>
                            <tr>
                                <th>Titulo</th>
                                <th>Publicacion</th>
                                <th>Tipo</th>
                                <th>Contenido</th>
                                <th>Fecha</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php include_once "metodos.php";
                
                            // error_reporting(0);
                            
                            $tema=array_key_exists("tema",$_POST) ? $_POST["tema"] : "";
                            $evento_noticia = obtenerTodas($tema);
                            
                            for ($i=0;$i<sizeof($evento_noticia);$i++){
                                echo "<tr>";
                                    echo "<td>".$evento_noticia[$i]['titulo']."</td>";
                                    echo "<td>".$evento_noticia[$i]['publicacion']."</td>";
                                    echo "<td>".$evento_noticia[$i]['tipo']."</td>";
                                    echo "<td>".$evento_noticia[$i]['contenido']."</td>";
                                    echo "<td>".$evento_noticia[$i]['fecha']."</td>";
                                    // Añadir foto de editar y eliminar fontawesaome
                                    echo "<td><a href='editarPublicacion.php?varId=".$evento_noticia[$i]["id"]."'><i class='fas fa-edit'></i></a></td>";
                                    echo "<td><a href='eliminarPublicacion.php?varId=".$evento_noticia[$i]["id"]."'><i class='fas fa-trash-alt'></i></a></td>";
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
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>