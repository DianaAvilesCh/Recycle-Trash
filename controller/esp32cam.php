<?php

include 'conexion.php';

if ($con) {


    echo "Conexion con base de datos exitosa! ";

    $json = file_get_contents('php://input');
    $data = json_decode($json);
    echo $data[0];

/*     if (isset($_POST['json'])) {
        $d1 = $_POST['json'];
     var_dump(json_decode($d1,true));
     echo $obj -> {'fotografias'};
        $dato = $obj -> {'fotografias'};

        $consulta = "INSERT INTO capture(name) VALUES ($dato)";
        $resultado = pg_query($con, $consulta);
        $result = print_r($resultado, true);
        echo "\n" . $consulta;
        if ($resultado) {
            echo " \n Registo en base de datos OK! ";
        } else {
            echo " Falla! Registro BD";
        }
    } */
}
else {
    echo "Falla! conexion con Base de datos ";
} 

?>
