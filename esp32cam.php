<?php

include 'conexion.php';

if ($con) {


    echo "Conexion con base de datos exitosa! ";


    if (isset($_POST['json'])) {
        $d1 = $_POST['json'];
    echo $d1;



        $consulta = "";
        $resultado = pg_query($con, $consulta);
        $result = print_r($resultado, true);
        echo "\n" . $consulta;
        if ($resultado) {
            echo " \n Registo en base de datos OK! ";
        } else {
            echo " Falla! Registro BD";
        }
    }
}
else {
    echo "Falla! conexion con Base de datos ";
} 

?>
