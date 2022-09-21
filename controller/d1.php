<?php
include('./conexion.php');
include('./prediction.php');

$dato = "";
$sql = "SELECT state FROM capture";
$resultado = pg_query($con, $sql);
if (pg_num_rows($resultado)) {
    while ($obj = pg_fetch_object($resultado)) {
        $dato = $obj->state;
        echo $obj->state;
    }
}

if($dato != "nada"){ 
    $sql = "UPDATE capture SET state='nada';";
    $resultado = pg_query($con, $sql);
}


?>