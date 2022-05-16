<?php 
$servidor = "localhost";
$baseDatos = "cleanvibes";
$usuario = "root";
$pass = "";

error_log(0);

function obtenerDato($id)
{
    try {
        $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['usuario'], $GLOBALS['pass']);
        $sql = $con->prepare("SELECT * from contabilidad where id=:id");
        $sql->bindParam(":id", $id); //Para evitar inyecciones SQL
        $sql->execute();
        $row = $sql->fetch(PDO::FETCH_ASSOC); //Recibimos la linea correspondiente en ROW
        $con = null; //Cerramos la conexión
        return $row;
    } catch (PDOException $e) {
        echo $e;
    }
}

function obtenerTodas(){
    try {
        $con = new PDO("mysql:host=" . $GLOBALS['servidor'] . ";dbname=" . $GLOBALS['baseDatos'], $GLOBALS['usuario'], $GLOBALS['pass']);
        $sql = $con->prepare("SELECT gasto_evento, gasto_instalacion,gasto_otro,ingreso_cuotas,ingreso_reservas from contabilidad;");
        $sql->execute();
        $miArray = [];
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $miArray[] = $row;
        }
    } catch (PDOException $e) {
        echo $e;
    }
    $con = null;
    return $miArray;
}

?>
