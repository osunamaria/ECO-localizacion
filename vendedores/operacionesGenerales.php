<?php include_once "../php/databaseManagement.inc.php";

    //Vendedores

    function obtenerVendedores($cp){
        try {
            $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
            $sql = $con->prepare("SELECT * from clientes WHERE clientes.id IN (SELECT id_vendedor from precios) AND confirmado = '1' AND cp = :cp;");
            $sql->bindParam(":cp", $cp); //Para evitar inyecciones SQL
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

    function insertarCompra($id_vendedor,$id_cliente,$id_producto,$cantidad){
        $retorno = false;
        try {
            $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
            $sql = $con->prepare("INSERT into ventas values(null, :id_vendedor , :id_cliente , :id_producto , :cantidad , '0')");
            $sql->bindParam(":id_vendedor", $id_vendedor);
            $sql->bindParam(":id_cliente", $id_cliente);
            $sql->bindParam(":id_producto", $id_producto);
            $sql->bindParam(":cantidad", $cantidad);
            $sql->execute();
            $id = $con->lastInsertId();
            $con = null;
            if ($id == 0) {
                echo "Datos incorrectos";
            }
            $retorno=true;
        } catch (PDOException $e) {
            header("location: ../php/error.php");
        }
        return $retorno;

    }

    function obtenerProductos($id_vendedor){
        try {
            $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
            $sql = $con->prepare("SELECT precios.id,productos.producto,precios.cantidad,precios.precio from precios,productos WHERE precios.id_producto=productos.id AND precios.id_vendedor = :id_vendedor;");
            $sql->bindParam(":id_vendedor", $id_vendedor);
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

    function cantidadProducto($id_vendedor,$nombreProducto){
        try {
            $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
            $sql = $con->prepare("SELECT cantidad from precios WHERE precios.id_producto=(SELECT id from productos where producto=:nombreProducto) AND precios.id_vendedor = :id_vendedor;");
            $sql->bindParam(":id_vendedor", $id_vendedor);
            $sql->bindParam(":nombreProducto", $nombreProducto);
            $sql->execute();
            $row = $sql->fetch(PDO::FETCH_ASSOC); //Recibimos la linea correspondiente en ROW
            $con = null; //Cerramos la conexión
            return $row;
        } catch (PDOException $e) {
            header("location: ../php/error.php");
        }
    }

    function obtenerPrecio($id_vendedor,$nombreProducto){
        try {
            $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
            $sql = $con->prepare("SELECT precio from precios WHERE precios.id_producto=(SELECT id from productos where producto=:nombreProducto) AND precios.id_vendedor = :id_vendedor;");
            $sql->bindParam(":id_vendedor", $id_vendedor);
            $sql->bindParam(":nombreProducto", $nombreProducto);
            $sql->execute();
            $row = $sql->fetch(PDO::FETCH_ASSOC); //Recibimos la linea correspondiente en ROW
            $con = null; //Cerramos la conexión
            return $row;
        } catch (PDOException $e) {
            header("location: ../php/error.php");
        }
    }

    function obtenerIdProducto($producto){
        try {
            $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
            $sql = $con->prepare("SELECT id from productos WHERE producto = :producto;");
            $sql->bindParam(":producto", $producto);
            $sql->execute();
            $row = $sql->fetch(PDO::FETCH_ASSOC); //Recibimos la linea correspondiente en ROW
            $con = null; //Cerramos la conexión
            return $row;
        } catch (PDOException $e) {
            header("location: ../php/error.php");
        }
    }
?>