<?php

include 'conexion.php';

if ($con) {

    echo "Conexion con base de datos exitosa! ";


    if (isset($_POST['d1'])) {
        $d1 = $_POST['d1'];
    }

    if (isset($_POST['d2'])) {
        $d2 = $_POST['d2'];
    }

    if (isset($_POST['d3'])) {
        $d3 = $_POST['d3'];
        date_default_timezone_set('america/bogota');
        $fecha_actual = date("Y-m-d H:i:s");


        if ($d1 >160 ) {
            $d1=160;
        } if ($d2 >160 ) {
            $d2=160;
        } if ($d3 >160 ) {
            $d3=160;
        }

        $consulta = "INSERT INTO state(state_id_garbage,destance,date) VALUES (1,'$d1','$fecha_actual'),
            (2,'$d2','$fecha_actual'), (3,'$d3','$fecha_actual');";
        $resultado = pg_query($con, $consulta);
        $result = print_r($resultado, true);
        echo "\n" . $consulta;
        if ($resultado) {
            echo " \n Registo en base de datos OK! ";
        } else {
            echo " Falla! Registro BD";
        }
    }
} else {
    echo "Falla! conexion con Base de datos ";
}

?>
