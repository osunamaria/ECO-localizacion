<?php 
$servidor = "localhost";
$baseDatos = "cleanvibes";
$usuario = "root";
$pass = "";

error_log(0);

function obtenerPublicacion($id)
{
    try {
        $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['usuario'], $GLOBALS['pass']);
        $sql = $con->prepare("SELECT * from evento_noticia where id=:id");
        $sql->bindParam(":id", $id); //Para evitar inyecciones SQL
        $sql->execute();
        $row = $sql->fetch(PDO::FETCH_ASSOC); //Recibimos la linea correspondiente en ROW
        $con = null; //Cerramos la conexión
        return $row;
    } catch (PDOException $e) {
        header("location: ../php/error.php");
    }
}

function insertarPublicacion($titulo, $publicacion, $tipo, $contenido, $fecha)
{
    try {
        $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['usuario'], $GLOBALS['pass']);
        $sql = $con->prepare("INSERT into evento_noticia values(null,:titulo,:publicacion,:tipo,:contenido,:fecha)");
        $sql->bindParam(":titulo", $titulo);
        $sql->bindParam(":publicacion", $publicacion);
        $sql->bindParam(":tipo", $tipo);
        $sql->bindParam(":contenido", $contenido);
        $sql->bindParam(":fecha", $fecha);
        $sql->execute();
        $id = $con->lastInsertId();
    } catch (PDOException $e) {
        header("location: ../php/error.php");
    }
    $con = null;
    return $id;
}
//No necesario de momento
function obtenerTodas($tema){
    try {
        $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['usuario'], $GLOBALS['pass']);
        if($tema==""){
            $sql = $con->prepare("SELECT id,titulo,publicacion,tipo,contenido,fecha from evento_noticia;");
            $sql->execute();
            $miArray = [];
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                $miArray[] = $row;
            }
        }else{
            $sql = $con->prepare("SELECT id,titulo,publicacion,tipo,contenido,fecha from evento_noticia where publicacion like '$tema';");
            $sql->execute();
            $miArray = [];
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                $miArray[] = $row;
            }
        }
        
    } catch (PDOException $e) {
        echo $e;
    }
    $con = null;
    return $miArray;
}

function eliminarPublicacion($id)
{
    $retorno = false;
    try {
        $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['usuario'], $GLOBALS['pass']);
        $sql = $con->prepare("DELETE from evento_noticia where id=:id");
        $sql->bindParam(":id", $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $retorno = true;
        }
    } catch (PDOException $e) {
        header("location: ../php/error.php");
    }
    $con = null;
    return $retorno;
}
function editarPublicacion($id, $titulo, $publicacion, $tipo, $contenido, $fecha)
{
    $retorno = false;
    try {
        $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['usuario'], $GLOBALS['pass']);
        $sql = $con->prepare("UPDATE evento_noticia set titulo=:titulo , publicacion=:publicacion, tipo=:tipo, contenido=:contenido, fecha=:fecha where id=:id;");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":titulo", $titulo);
        $sql->bindParam(":publicacion", $publicacion);
        $sql->bindParam(":tipo", $tipo);
        $sql->bindParam(":contenido", $contenido);
        $sql->bindParam(":fecha", $fecha);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $retorno = true;
        }
    } catch (PDOException $e) {
        header("location: ../php/error.php");
    }
    $con = null;
    return $retorno;
}
?>
