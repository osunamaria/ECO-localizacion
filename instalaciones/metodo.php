<?php 
$servidor = "localhost";
$baseDatos = "cleanvibes";
$usuario = "root";
$pass = "";

error_log(0);

function obtenerInsatalacion($id)
{
    try {
        $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['usuario'], $GLOBALS['pass']);

        $sql = $con->prepare("SELECT * from instalaciones where id=:id");
        $sql->bindParam(":id", $id); //Para evitar inyecciones SQL
        $sql->execute();
        $row = $sql->fetch(PDO::FETCH_ASSOC); //Recibimos la linea correspondiente en ROW
        $con = null; //Cerramos la conexión

    } catch (PDOException $e) {
        echo $e;
    }
}

function insertarInsatalacion($tipo, $nombre, $localizacion)
{
    try {
        $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['usuario'], $GLOBALS['pass']);
        $sql = $con->prepare("INSERT into instalaciones values(null,:tipo,:nombre,:localizacion)");
        $sql->bindParam(":tipo", $tipo);
        $sql->bindParam(":nombre", $nombre);
        $sql->bindParam(":localizacion", $localizacion);
        $sql->execute();
        $id = $con->lastInsertId();
    } catch (PDOException $e) {
        echo $e;
    }
    $con = null;
    return $id;
}