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

    } catch (PDOException $e) {
        echo $e;
    }
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


?>
