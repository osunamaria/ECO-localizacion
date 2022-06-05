<?php

    $servidor = "localhost";
    $baseDatos = "eco-localizacion";
    $user = "root";
    $pass = "";

    //Ventas

    function obtenerVentas($id){
        try {
            $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
            $sql = $con->prepare("SELECT ventas.id,clientes.nombre,clientes.telefono,productos.producto,ventas.cantidad,precios.precio from ventas,clientes,productos,precios WHERE clientes.id=ventas.id_cliente AND precios.id_producto=productos.id AND productos.id=ventas.id_producto AND ventas.id_vendedor = :id;");
            $sql->bindParam(":id", $id);
            $sql->execute();
            $miArray = [];
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) { //Haciendo uso de PDO iremos creando el array dinámicamente
                $miArray[] = $row; //https://www.it-swarm-es.com/es/php/rellenar-php-array-desde-while-loop/972445501/
            }
            $con = null; //Cerramos la conexión
        } catch (PDOException $e) {
            // header("location: ../php/error.php");
            echo $e;
        }
        return $miArray;
    }

    function confirmarVenta($id)
    {
        $retorno = false;
        try {
            $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
            $sql = $con->prepare("UPDATE ventas set confirmada='1' where id=:id;");
            $sql->bindParam(":id", $id);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $retorno = true;
            }
            $con = null; //Cerramos la conexión
        } catch (PDOException $e) {
            header("location: ../php/error.php");
        }
        return $retorno;
    }

    //Productos

    function obtenerProductos($id){
        try {
            $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
            $sql = $con->prepare("SELECT * from precios,productos WHERE precios.id_producto=productos.id AND precios.id_vendedor = :id;");
            $sql->bindParam(":id", $id);
            $sql->execute();
            $miArray = [];
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) { //Haciendo uso de PDO iremos creando el array dinámicamente
                $miArray[] = $row; //https://www.it-swarm-es.com/es/php/rellenar-php-array-desde-while-loop/972445501/
            }
            $con = null; //Cerramos la conexión
        } catch (PDOException $e) {
            header("location: ../php/error.php");
        }
        return $miArray;
    }

    function insertarProducto($usuario,$contrasena,$nombre,$apellidos,$dni,$correo,$telefono,$tipo){
        
        try {
            $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
            $sql = $con->prepare("INSERT into productos values(null, :usuario , :contrasena , :nombre , :apellidos , :dni , :correo , :telefono, :tipo ,'0')");
            $sql->bindParam(":usuario", $usuario);
            $sql->bindParam(":contrasena", $contrasena);
            $sql->bindParam(":nombre", $nombre);
            $sql->bindParam(":apellidos", $apellidos);
            $sql->bindParam(":dni", $dni);
            $sql->bindParam(":correo", $correo);
            $sql->bindParam(":telefono", $telefono);
            $sql->bindParam(":tipo", $tipo);
            $sql->execute();
            $id = $con->lastInsertId();
            $con = null;
            if ($id == 0) {
                echo "Datos incorrectos";
            }
        } catch (PDOException $e) {
            header("location: ../php/error.php");
        }

    }
    
    function eliminarProducto($id){
        $retorno = false;
        try{
            $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
            $sql = $con->prepare("DELETE from productos where id=:id");
            $sql->bindParam(":id", $id);
            $sql->execute();
            if ($sql->rowCount() > 0){
                $retorno = true;
            }
            $con = null; //Cerramos la conexión
        }catch(PDOException $e){
            header("location: ../php/error.php");
        }
        return $retorno;
    }

    function editarProducto($id, $nombre, $apellidos, $dni, $tipo, $correo, $telefono, $num_miembros)
    {
        $retorno = false;
        try {
            $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
            $sql = $con->prepare("UPDATE productos set nombre=:nombre, apellidos=:apellidos , dni=:dni, tipo=:tipo, correo=:correo, telefono=:telefono, num_miembros=:num_miembros, cuota=:cuota where id=:id;");
            $sql->bindParam(":id", $id);
            $sql->bindParam(":nombre", $nombre);
            $sql->bindParam(":apellidos", $apellidos);
            $sql->bindParam(":dni", $dni);
            $sql->bindParam(":tipo", $tipo);
            $sql->bindParam(":correo", $correo);
            $sql->bindParam(":telefono", $telefono);
            $sql->bindParam(":num_miembros", $num_miembros);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $retorno = true;
            }
        } catch (PDOException $e) {
            header("location: ../php/error.php");
        }
        $con = null; //Cerramos la conexión
        return $retorno;
    }
?>