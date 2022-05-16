<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>

    <!-- linkear con fuente belleza -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Belleza&display=swap" rel="stylesheet">

    <!-- links css -->
    <link rel="stylesheet" href="../css/headers.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/registro.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- link para iconos -->
    <link rel="stylesheet" href="../fontawesome-free-5.15.4-web/css/all.min.css">

    <!-- links js -->
    <script src="../js/registro.js"></script>

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
            </ul>
        </header>
    </div>
    <section>
        <article>
            <div class="opcion">
                <h1 id="registro" class="subrayado">Reg&iacute;strate</h1>
                <h1 id="inicio">Inicia sesi&oacute;n</h1>
            </div>
        </article>
        <article>
            <form action="registrar.php" method="POST" enctype="multipart/form-data" id="formRegistro">
                <table>
                    <tr>
                        <td>
                            <label for="usuario">Usuario</label>
                        </td>
                        <td>
                            <input type="text" name="usuario" id="usuario" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="contrasena">Contrase&ntilde;a</label>
                        </td>
                        <td>
                            <input type="password" name="contrasena" id="contrasena" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="nombre">Nombre</label>
                        </td>
                        <td>
                            <input type="text" name="nombre" id="nombre" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="apellidos">Apellidos</label>
                        </td>
                        <td>
                            <input type="text" name="apellidos" id="apellidos" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="dni">DNI</label>
                        </td>
                        <td>
                            <input type="text" name="dni" id="dni" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="correo">Correo</label>
                        </td>
                        <td>
                            <input type="email" name="correo" id="correo" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="telefono">Telefono</label>
                        </td>
                        <td>
                            <input type="tel" name="telefono" id="telefono" length="9" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="fecnac">Fecha de nacimiento</label>
                        </td>
                        <td>
                            <input type="date" name="fecnac" id="fecnac" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="num_miembros">Miembros de la familia</label>
                        </td>
                        <td>
                            <input type="number" name="num_miembros" id="num_miembros" min="1" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Enviar">
                        </td>
                    </tr>
                </table>
            </form>
        </article>
        <article>
            <form action="iniciarSesion.php" method="POST" enctype="multipart/form-data" id="formInicio" class="oculto">
                <table>
                    <tr>
                        <td>
                            <label for="usuario">Usuario</label>
                        </td>
                        <td>
                            <input type="text" name="usuario" id="usuario">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="contrasena">Contrase&ntilde;a</label>
                        </td>
                        <td>
                            <input type="password" name="contrasena" id="contrasena">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Enviar" class="segundoBoton">
                        </td>
                    </tr>
                </table>
            </form>
        </article>
    </section>
    <footer class="d-flex flex-wrap justify-content-center align-items-center py-3 mt-4 border-top position-absolute top-100 w-100">
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
    <script src="../js/bootstrap.bundle.min"></script>
</body>

</html>