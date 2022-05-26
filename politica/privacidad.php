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
    <link rel="stylesheet" href="../css/privacidad.css">
    <title>Privacidad</title>
</head>

<body>
    <header class="d-flex flex-wrap justify-content-center py-3 cabecera">
        <a href="../index.php" class="me-md-auto ms-5">
            <img src="../img/Captura-removebg-preview.png" class="logo">
        </a>

        <ul class="nav nav-pills mt-4">
            <li class="nav-item"><a href="../index.php" class="nav-link text-white">Inicio</a></li>
            <li class="nav-item"><a href="../productos/index.php" class="nav-link text-white">Productos</a></li>
            <li class="nav-item"><a href="../vendedores/index.php" class="nav-link text-white">Vendedores</a></li>
            <?php
                // Continuar la sesión
                session_start();

                if(isset($_SESSION['sesion_iniciada']) == true ){
                    $tipo = session_id();
                    if($tipo=="vendedor"){
                        echo "<li class='nav-item'><a href='ventas/index.php' class='nav-link text-white'>Ventas</a></li>";
                        echo "<li class='nav-item'><a href='administracion_productos/index.php' class='nav-link text-white'>Administrar productos</a></li>";
                    }
                    if($tipo=="administrador"){
                        echo "<li class='nav-item dropdown'>";
                            echo "<a class='nav-link dropdown-toggle text-white' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>";
                                echo "Gestiones";
                            echo "</a>";
                            echo "<ul class='dropdown-menu' aria-labelledby='navbarDropdown'>";
                                echo "<li><a class='dropdown-item' href='gestion_cuentas/index.php'>Usuarios</a></li>";
                                echo "<li><a class='dropdown-item' href='gestion_publicaciones/index.php'>Publicaciones</a></li>";
                                echo "<li><a class='dropdown-item' href='ventas/index.php'>Ventas</a></li>";
                                echo "<li><a class='dropdown-item' href='atencion_cliente/index.php'>Atención al cliente</a></li>";
                            echo "</ul>";
                        echo "</li>";
                    }
                    echo "<li class='nav-item me-md-auto'><a href='../cerrarSesion.php' class='nav-link active bg-secondary rounded-pill me-5' aria-current='page'>Cerrar sesión</a></li>";
                }else{
                    echo "<li class='nav-item me-md-auto'><a href='../registro/index.html' class='nav-link active bg-success rounded-pill me-5' aria-current='page'>Entrar</a></li>";
                }//Fin si
            ?>
        </ul>
    </header>

    <section class="mb-5">
        <div class="container">
            <article>
                <h3 class="text-center tamano">AVISO DE PRIVACIDAD DE ECO-LOCALIZACIÓN</h3>
            </article>
            <article>
                <h3>¿QUIÉN ES EL RESPONSABLE DEL TRATAMIENTO?</h3>
                <p>El responsable del tratamiento de los datos es NV ECO-localización Services SA, una sociedad con domicilio social en Mairena del Aljarafe, Sevilla.</p>
            </article>
            <article>
                <h3>¿CÓMO UTILIZAMOS LA INFORMACIÓN PERSONAL Y CÓMO SE RECOGE?</h3>
                <p>Recogemos diferentes categorías de información personal. Las categorías que recogemos pueden incluir: Información de contacto y de perfil; Información 
                    sobre preferencias e intereses; Contenidos generados por el usuario (CGU); Información sobre ubicación; Información proporcionada por redes sociales y por terceros.</p>
                <p>Esta información personal sobre ti se recoge de muchas formas; algunos de sus ejemplos incluyen:</p>
                <ul>
                    <li>Cuando nos remites información personal. Recogemos información personal sobre ti cuando nos la proporcionas activamente; por ejemplo, cuando te registras para crear 
                        una cuenta, o publicas comentarios, fotografías y vídeos, o grabas tu voz en el contexto de tu participación en una promoción, o participas en chats con usuarios.</li>
                    <li>Cuando utilizas nuestros Portales. Recogemos (nosotros y socios terceros en nuestro nombre) automáticamente cierta información personal sobre ti cuando visitas nuestros Portales.</li>
                    <li>Cuando estás offline: También recogemos tus datos personales cuando interactúas de forma diferente a la visita a nuestros Portales; por ejemplo, cuando te pones en 
                        contacto con nosotros a través de Portales de nuestros socios.</li>
                </ul>
                <p>Podemos vincular o combinar la información que recogemos sobre ti procedente de diversas fuentes para ayudarnos a asegurar una experiencia del usuario coherente independientemente 
                    del modo en que interactúes con nosotros: online, por móvil, o en una red social.</p>
                <p>Usamos la información personal con diferentes propósitos: por ejemplo, para satisfacer tus peticiones y ponernos en contacto contigo; para enviarte publicidad personalizada y 
                    contenidos y materiales promocionales; para analizar y mejorar nuestros Portales y nuestro negocio; y para otros motivos que se describen con más detalle en nuestro Aviso 
                    de Privacidad.</p>
                <p>Para saber más sobre la información que recogemos y cómo la utilizamos, consulta nuestro Aviso de Privacidad completo.</p>
            </article>
            <article>
                    <h3>¿CÓMO COMPARTIMOS INFORMACIÓN?</h3>
                    <p>Compartimos información en una amplia variedad de circunstancias para el funcionamiento de nuestros Portales, para responder a tus peticiones, para mejorar tu experiencia, 
                        y para dirigir de otra manera nuestro negocio. Por ejemplo, podemos compartir información:</p>
                    <ul>
                        <li>Con nuestras filiales y compañías del Grupo ECO-localización, que pueden utilizar tu información de manera coherente con el presente Aviso de Privacidad.</li>
                        <li>Con terceros para satisfacer tus peticiones, como cuando decides compartir tus actividades con tus amigos y contactos.</li>
                    </ul>
            </article>
            <article>
                    <h3>¿QUÉ DERECHOS Y QUÉ OPCIONES TIENES?</h3>
                    <p>Con respecto al tratamiento de tus Datos Personales que hacemos nosotros tienes los siguientes derechos: acceso, rectificación, supresión, oposición, 
                        limitación del tratamiento, no ser sometido a una decisión basada exclusivamente en un tratamiento automatizado, incluida la elaboración de perfiles, y portabilidad.</p>
                    <p>Queremos que conozcas tus derechos y opciones respecto al modo en que podemos tratar tu información personal. En función de cómo utilices nuestros Portales, estos derechos 
                        y obligaciones pueden incluir: </p>
                    <p>Derechos individuales. Disfruta de derechos concretos, en virtud de la legislación sobre privacidad aplicable, respecto a la información personal que mantenemos, incluido 
                        el derecho de acceso y de supresión, y el derecho a restringir determinadas actividades de tratamiento. </p>
                    <p>Publicidad basada en intereses. Visita la European Interactive Digital Advertising Alliance, los recursos online de la Network Advertising Initiative, y/o los recursos de DAA 
                        para saber más sobre cómo puedes no recibir determinada publicidad basada en intereses. Algunas de estas opciones de exclusión pueden no ser efectivas a menos que tu navegador 
                        esté configurado para que acepte cookies. Además, si utilizas un dispositivo diferente, cambias de navegador o eliminas cookies, puedes tener que llevar a cabo la actividad de 
                        exclusión de nuevo. También puedes limitar la publicidad basada en intereses mediante los ajustes de su dispositivo móvil seleccionando “limitar seguimiento de anuncios” (iOS) 
                        o “desactivar anuncios personalizados” (Android). </p>
                    <p>Ajustes y preferencias de cookies. Puedes gestionar cookies y otras tecnologías de seguimiento mediante los ajustes de tu navegador. </p>
                    <p>Ajustes y preferencias de correo electrónico. Si ya no deseas recibir nuestros correos electrónicos de marketing, puedes darte de baja de la suscripción en todo momento. 
                        También puedes configurar las opciones de tu correo electrónico para evitar la descarga automática de imágenes que puedan contener tecnologías de seguimiento. </p>
            </article>
        </div>
    </section>

    <footer class="d-flex text-white cabecera">
        <div class="container-fluid py-3">
            <div class="row justify-content-around align-items-center text-center">

                <div class="col-xl-4 col-sm-12">
                    <ul class="d-flex lista justify-content-around align-items-center">
                        <li><a class="text-decoration-none text-white" href="privacidad.php">Política de privacidad</a></li>
                        <li><a class="text-decoration-none text-white" href="cookies.php">Política de cookies</a></li>
                        <li><a class="text-decoration-none text-white" href="contacto.php">Contacto</a></li>
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