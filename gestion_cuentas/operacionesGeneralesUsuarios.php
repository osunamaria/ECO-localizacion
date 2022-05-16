<?php

    $servidor = "localhost";
    $baseDatos = "cleanvibes";
    $user = "root";
    $pass = "";

    function obtenerUsuario($id){
        try {
            $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
            /*
            La clase PDOStatement es la que trata las sentencias SQL. 
            Una instancia de PDOStatement se crea cuando se llama a PDO->prepare(), 
            y con ese objeto creado se llama a métodos como bindParam() para pasar valores o execute() para ejecutar sentencias. 
            PDO facilita el uso de sentencias preparadas en PHP, que mejoran el rendimiento y la seguridad de la aplicación. 
            Cuando se obtienen, insertan o actualizan datos, el esquema es: PREPARE -> [BIND] -> EXECUTE. 
            Se pueden indicar los parámetros en la sentencia con un interrogante "?" o mediante un nombre específico.
            */
            $sql = $con->prepare("SELECT * from socios where id=:id");
            $sql->bindParam(":id", $id); //Para evitar inyecciones SQL
            $sql->execute();
            $row = $sql->fetch(PDO::FETCH_ASSOC); //Recibimos la linea correspondiente en ROW
            $con = null; //Cerramos la conexión
            return $row;
        } catch (PDOException $e) {
            header("location: ../php/error.php");
        }
    }

    function obtenerTodos($filtro){
        try {
            $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
            if($filtro=='nuevos'){
                $sql = $con->prepare("SELECT * from socios WHERE confirmado = '0';");
            }else{
                $sql = $con->prepare("SELECT * from socios WHERE confirmado = '1';");
            }
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

    function insertarUsuario($usuario,$contrasena,$nombre,$apellidos,$dni,$tipo,$correo,$telefono, $fecnac, $num_miembros){
        
        try {
            if($num_miembros==1){
                $cuota=60;
            }else if($num_miembros>1 && $num_miembros<6){
                $cuota=70;
            }else if($num_miembros>5 && $num_miembros<11){
                $cuota=85;
            }else if($num_miembros>10){
                $cuota=90;
            }
            $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
            $sql = $con->prepare("INSERT into socios values(null, :usuario , :contrasena , :nombre , :apellidos , :dni , :tipo , :correo , :telefono ,:fecnac , :num_miembros , :cuota, '1')");
            $sql->bindParam(":usuario", $usuario);
            $sql->bindParam(":contrasena", $contrasena);
            $sql->bindParam(":nombre", $nombre);
            $sql->bindParam(":apellidos", $apellidos);
            $sql->bindParam(":dni", $dni);
            $sql->bindParam(":tipo", $tipo);
            $sql->bindParam(":correo", $correo);
            $sql->bindParam(":telefono", $telefono);
            $sql->bindParam(":fecnac", $fecnac);
            $sql->bindParam(":num_miembros", $num_miembros);
            $sql->bindParam(":cuota", $cuota);
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
    
    function editarUsuario($id, $nombre, $apellidos, $dni, $tipo, $correo, $telefono, $num_miembros)
    {
        $retorno = false;
        try {
            if($num_miembros==1){
                $cuota=60;
            }else if($num_miembros>1 && $num_miembros<6){
                $cuota=70;
            }else if($num_miembros>5 && $num_miembros<11){
                $cuota=85;
            }else if($num_miembros>10){
                $cuota=90;
            }
            $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
            $sql = $con->prepare("UPDATE socios set nombre=:nombre, apellidos=:apellidos , dni=:dni, tipo=:tipo, correo=:correo, telefono=:telefono, num_miembros=:num_miembros, cuota=:cuota where id=:id;");
            $sql->bindParam(":id", $id);
            $sql->bindParam(":nombre", $nombre);
            $sql->bindParam(":apellidos", $apellidos);
            $sql->bindParam(":dni", $dni);
            $sql->bindParam(":tipo", $tipo);
            $sql->bindParam(":correo", $correo);
            $sql->bindParam(":telefono", $telefono);
            $sql->bindParam(":num_miembros", $num_miembros);
            $sql->bindParam(":cuota", $cuota);
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

    function eliminarUsuario($id){
        $retorno = false;
        try{
            $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
            $sql = $con->prepare("DELETE from socios where id=:id");
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

    function confirmarUsuario($id)
    {
        $retorno = false;
        try {
            $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['user'], $GLOBALS['pass']);
            $sql = $con->prepare("UPDATE socios  set confirmado='1' where id=:id;");
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
?>