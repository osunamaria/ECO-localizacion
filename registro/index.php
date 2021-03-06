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
    <link href="https://fonts.googleapis.com/css2?family=Calligraffitti&display=swap" rel="stylesheet">

    <!-- links css -->
    <link rel="stylesheet" href="../css/headers.css">
    <link rel="stylesheet" href="../css/registro.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- link para iconos -->
    <link rel="stylesheet" href="../fontawesome-free-5.15.4-web/css/all.min.css">

    <!-- links js -->
    <script src="../js/registro.js"></script>

</head>

<body>
    <header class="d-flex flex-wrap justify-content-center py-3 border-bottom cabecera">
        <a href="../index.php" class="me-md-auto ms-5">
            <img src="../img/Captura-removebg-preview.png" class="logo">
        </a>

        <ul class="nav nav-pills mt-4">
            <li class="nav-item"><a href="../index.php" class="nav-link text-white">Inicio</a></li>
            <li class="nav-item"><a href="../vendedores/index.php" class="nav-link text-white">Vendedores</a></li>
        </ul>
    </header>
    <section>
        <article>
            <div class="opcion mt-5">
                <h3 id="registro" class="subrayado">Reg&iacute;strate</h3>
                <h3 id="inicio">Inicia sesi&oacute;n</h3>
            </div>
        </article>
        <article>
            <div class="container mt-5 mb-5">
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6">
                        <form action="registrar.php" method="POST" enctype="multipart/form-data" id="formRegistro">
                            <table>
                                <tr>
                                    <td>
                                        <label for="usuario">Usuario</label>
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" name="usuario" id="usuario" required>
                                        <?php?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="contrasena">Contrase&ntilde;a</label>
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" name="contrasena" id="contrasena" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="nombre">Nombre</label>
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" name="nombre" id="nombre" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="apellidos">Apellidos</label>
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" name="apellidos" id="apellidos" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="dni">DNI</label>
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" name="dni" id="dni" maxlength="9" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="correo">Correo</label>
                                    </td>
                                    <td>
                                        <input class="form-control" type="email" name="correo" id="correo" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="telefono">Telefono</label>
                                    </td>
                                    <td>
                                        <input class="form-control" type="tel" name="telefono" id="telefono" maxlength="9" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="ciudad">Ciudad</label>
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" name="ciudad" id="ciudad" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="localidad">Localidad</label>
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" name="localidad" id="localidad" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="direccion">Direccion</label>
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" name="direccion" id="direccion" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="cp">Codigo postal</label>
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" name="cp" id="cp" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <input class="botones" type="submit" value="Registrarse">
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </article>
        <article>
            <div class="container">
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6">
                        <form action="iniciarSesion.php" method="POST" enctype="multipart/form-data" id="formInicio" class="oculto">
                            <table>
                                <tr>
                                    <td>
                                        <label for="usuario">Usuario</label>
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" name="usuario" id="usuario">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="contrasena">Contrase&ntilde;a</label>
                                    </td>
                                    <td>
                                        <input class="form-control" type="password" name="contrasena" id="contrasena">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <input class="botones" type="submit" value="Iniciar sesi??n">
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </article>
    </section>
    <script src="../js/bootstrap.bundle.min"></script>
</body>

</html>