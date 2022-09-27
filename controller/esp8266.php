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
    }

    if (isset($_POST['d4'])) {
        $d4 = $_POST['d4'];
        date_default_timezone_set('america/bogota');
        $fecha_actual = date("Y-m-d H:i:s");

        if ($d1 >45 ) {
            $d1=45;
        } if ($d2 >45 ) {
            $d2=45;
        } if ($d3 >45 ) {
            $d3=45;
            if($d3 >100){
                $d3 = 0;
            }
        }

        $dp1 =(int)(((45-$d1)/45)*100);
        $dp2 =(int)(((45-$d2)/45)*100);
        $dp3 =(int)(((45-$d3)/45)*100);
        
        $c=[];
        //Select id from container_garbage where id_container = 1
        $consulta = "SELECT id FROM container_garbage where id_container = $d4 order by id ASC";
        $resultado = pg_query($con, $consulta);
        if (pg_num_rows($resultado)) {

            while ($obj = pg_fetch_object($resultado)) {
                array_push($c, $obj->id);
            }
        }
            $consulta = "INSERT INTO state(state_id_garbage,destance_cm,date,destance_porce) 
                VALUES ('$c[0]','$d1','$fecha_actual','$dp1'),('$c[1]','$d2','$fecha_actual','$dp2'),
                ('$c[2]','$d3','$fecha_actual','$dp3');";
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
