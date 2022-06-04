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
    <title>Cookies</title>
</head>

<body>
    <header class="d-flex flex-wrap justify-content-center py-3 cabecera">
        <a href="../index.php" class="me-md-auto ms-5">
            <img src="../img/Captura-removebg-preview.png" class="logo">
        </a>

        <ul class="nav nav-pills mt-4">
            <li class="nav-item"><a href="../index.php" class="nav-link text-white">Inicio</a></li>
            <li class="nav-item"><a href="../vendedores/index.php" class="nav-link text-white">Vendedores</a></li>
            <?php
                // Continuar la sesión
                session_start();

                if(isset($_SESSION['sesion_iniciada']) == true ){
                    $tipo = session_id();
                    if($tipo=="vendedor"){
                        echo "<li class='nav-item'><a href='../administracion_productos/index.php' class='nav-link text-white'>Ventas</a></li>";
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

    <section class="mb-5">
        <div class="container">
            <article>
                <h3 class="text-center tamano">POLÍTICA DE COOKIES DE ECO-LOCALIZACIÓN</h3>
            </article>
            <article>
                <h3>QUÉ Y POR QUÉ</h3>
                <h4>¿Qué son las cookies y otras tecnologías similares? </h4>
                <br>
                <p>Las cookies y las tecnologías de almacenamiento web que permiten un almacenamiento local y de sesión (“cookies”) facilitan tu interacción con nuestro sitio web. 
                    Normalmente son pequeños ficheros de texto que descarga tu navegador de internet en tu dispositivo cuando visitas nuestro sitio web. También colocamos cookies 
                    en tu dispositivo cuando interactúa con tecnologías de sitio web de proveedores terceros, como scripts, pixels y tags, que integramos en nuestro sitio web con 
                    fines publicitarios. El pixel de (Facebook) recaba datos que nos ayudan a rastrear las conversiones de anuncios de (Facebook), optimizar anuncios, crear públicos 
                    objetivo (targeted audiences) para futuros anuncios y revender a personas que ya han realizado algún tipo de acción en nuestro sitio. Funciona colocando y activando 
                    cookies para rastrear a usuarios cuando interactúen con nuestro sitio web y nuestros anuncios de (Facebook).</p>
                <p>También utilizamos otras tecnologías similares a las cookies. Utilizamos estas otras tecnologías para transmitir a otras aplicaciones información que hemos recabado 
                    acerca de ti al visitar nuestro sitio web.</p>
                <h4>¿Por qué utilizamos cookies?</h4>
                <br>
                <h5>Optimizar tu experiencia online</h5>
                <p>Las cookies realizan distintas funciones que nos ayudan a hacer que tu experiencia online sea más fluida e interactiva, especialmente si está utilizando el mismo 
                    dispositivo y el mismo navegador que cuando visitaste anteriormente nuestro sitio web. </p>
                <p>Algunas cookies se consideran esenciales para ejecutar y mantener el sitio web de ECO-localización y nos permiten proporcionarte:</p>
                <ul>
                    <li>acceso a servicios y funcionalidades en todo momento;</li>
                    <li>información uniforme y actualizada;</li>
                    <li>una experiencia online fluida.</li>
                </ul>
                <h5>Para proporcionarte contenido y ofertas adaptadas a tus intereses</h5>
                <p>ECO-localización utiliza cookies publicitarias y dirigidas. Estas cookies almacenan información de tu historial de búsquedas para registrar sus intereses y actividades 
                    de búsqueda en nuestro sitio web. Esto nos permite a nosotros o a nuestros colaboradores:</p>
                <ul>
                    <li>anunciar productos de ECO-localización en otros sitios web basándonos en tus visitas a nuestro sitio web; </li>
                    <li>combinar y optimizar nuestra información, de manera que la publicidad online de ECO-localización que vea tenga relevancia para ti y para tus intereses.</li>
                </ul>
                <h5>Para ayudarnos a mejorar nuestros sitios web</h5>
                <p>Las cookies nos permiten mejorar nuestros sitios web analizando cómo los utilizan los visitantes. Vemos qué contenido es popular y utilizamos esa información para 
                    prever qué otras cosas van a encontrar interesantes o útiles los visitantes. Esto nos ayuda a:</p>
                <ul>
                    <li>comprender cómo utilizan los visitantes nuestros sitios web, de manera que podamos mejorarlos y mejorar la experiencia de los visitantes;</li>
                    <li>probar distintas ideas y mostrar el contenido que sea más relevante para visitantes concretos.</li>
                </ul>
                <p>Las cookies también nos ayudan a comprender cómo tu nos utilizas e interactuás con nosotros, de manera que no nos lo tenga que decir cada vez que visita uno de 
                    nuestros sitios web. Pueden utilizarse, por ejemplo, para recordar sus preferencias y su ID de usuario cuando nos visite. Si conocemos sus ajustes y lo que le 
                    gusta, podemos:</p>
                <ul>
                    <li>proporcionarte una experiencia de ECO-localización más personalizada, ayudándole a navegar por las páginas más relevantes de manera más eficiente;</li>
                    <li>recordar determinadas preferencias personales, como la elección del idioma y configuraciones preferidas;</li>
                    <li>modificar contenido basándonos en tus preferencias y proporcionarte contenido personalizado.</li>
                </ul>
                <h4>Cookies necesarias</h4>
                <br>
                <p>Utilizamos estas cookies para:</p>
                <ul>
                    <li>identificarte y permitirte acceder a tu cuenta de usuario;</li>
                    <li>recordar tus acciones anteriores, como tus elecciones en relación con el consentimiento a cookies.</li>
                </ul>
                <h4>Cookies de analytics</h4>
                <br>
                <p>Utilizamos estas cookies para:</p>
                <ul>
                    <li>ver cómo interactúas con nuestro sitio;</li>
                    <li>saber más sobre tu recorrido personal entre páginas;</li>
                    <li>mejorar nuestro sitio web y adaptarlo conforme a tus preferencias.</li>
                </ul>
            </article>
            <article>
                <h3>EN DETALLE</h3>
                <h4>¿Qué necesita saber sobre las cookies?</h4>
                <br>
                <p>Las cookies nos ayudan a proporcionar una experiencia online mejor y más rápida.</p>
                <p>La próxima vez que visites el mismo sitio web utilizando el mismo dispositivo, el sitio web que activó originalmente la configuración de la cookie reconocerá que has 
                    visitado el sitio web anteriormente y, en algunos casos, adaptará el contenido para tener en cuenta tus visitas anteriores. De este modo, la experiencia del sitio web 
                    puede adaptarse a tus intereses y preferencias personales.</p>
                <h4>Cookies de primera parte y cookies de tercera parte</h4>
                <br>
                <p>Las cookies de primera parte son cookies que ECO-localización despliega en el sitio web que tu estás visitando en ese momento y con las que interactúa al utilizar nuestros 
                    sitios web.</p>
                <p>Nuestros sitios web también pueden incluir contenido de otros sitios web que pueden desplegar sus propias cookies. Estas cookies son establecidas por alguien distinto 
                    de ECO-localización. Estos proveedores terceros pueden establecer cookies mientras tu visitas el sitio web de ECO-localización y recibir información como el hecho de que has cargado 
                    un sitio web de ECO-localización. Necesitarás visitar los sitios web de dichos terceros para obtener más información sobre cómo utilizan dichas cookies. Puedes consultar más 
                    información acerca de los terceros pertinentes más adelante en la presente Política de Cookies.</p>
                <p>Si has decidido que no quieres aceptar cookies de tercera parte, no necesitas otorgar tu consentimiento o puedes retirar su consentimiento utilizando la función 
                    correspondiente proporcionada en el apartado “Ajustes de cookies”. Si te opones a todas las cookies de tercera parte, solo se le proporcionarán las funcionalidades de 
                    nuestro sitio web que podamos garantizar que funcionen sin dichas cookies.</p>
                <h4>¿Qué pasa si rechazo cookies?</h4>
                <br>
                <p>Si decides rechazar cookies que requieren tu consentimiento previo, no utilizaremos dichas cookies. Si decides retirar tu consentimiento previamente otorgado, dejaremos 
                    de utilizar las cookies correspondientes y las eliminaremos (si son cookies de primera parte). La retirada del consentimiento no afectará a la legalidad del tratamiento 
                    llevado a cabo de conformidad con tu consentimiento antes de tu retirada. Esto significa que, en el caso de las cookies de personalización y publicitarias, no podrás 
                    aprovechar todas las características y la funcionalidad de nuestro sitio web. Del mismo modo, tu podrás rechazar cookies de analytics. En dicho caso, tendremos una menor 
                    capacidad de saber lo que te gusta o lo que no te gusta de nuestro sitio web para poder mejorarlo.</p>
                <p>No podemos eliminar las cookies de tercera parte. Si deseas eliminar todas las cookies de tercera parte, deberás hacerlo en la configuración de su navegador. Asimismo, 
                    si rechazas o retiras tu consentimiento para las cookies publicitarias, no necesariamente recibirás menos publicidad, sino que la publicidad que verás no estará adaptada 
                    para ajustarse a tus necesidades. </p>
                <h4>Gestionar los ajustes de cookies a través de tu navegador</h4>
                <br>
                <p>Puedes gestionar (habilitar/inhabilitar y eliminar) los ajustes de cookies en nuestro sitio web a través de las funcionalidades anteriores, pero también modificando la 
                    configuración de su navegador. La mayor parte de los navegadores te permiten gestionar tus cookies, ya sea aceptando o rechazando todas las cookies o aceptando solo 
                    algunos tipos de cookies. El procedimiento para gestionar y eliminar cookies puede encontrarse normalmente en la función de ayuda integrada de tu navegador. </p>
                <h4>¿Quién es jurídicamente responsable del uso de cookies de ECO-localización?</h4>
                <br>
                <p>Las cookies descritas en la presente Política de Cookies se utilizan en relación con un sitio web propiedad de y controlado por NV ECO-localización Services SA, con domicilio 
                    social en Mairena del Aljarafe, Sevilla. Cuando se tratan datos personales mediante el uso de cookies de primera parte, CCS 
                    determina los medios y los fines de dicho tratamiento y es el responsable del tratamiento, conforme a lo definido en el Reglamento General de Protección de Datos 
                    (Reglamento 2016/679).</p>
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