<?php

include 'conexion.php';

if ($con) {

    echo "Conexion con base de datos exitosa! ";
    //$result = print_r($con, true);
    //echo $result;
    //$hola  = $_POST['d1'];
    //echo $hola;

    if (isset($_POST['d1'])) {
        $d1 = $_POST['d1'];
        //echo "Distancia de tachos";
        //echo " Distancia 1: ".$d1;
    }

    if (isset($_POST['d2'])) {
        $d2 = $_POST['d2'];
        //echo " Distancia 2: ".$d2;
    }

    if (isset($_POST['d3'])) {
        $d3 = $_POST['d3'];
        //echo " Distancia 3: ".$d3;
        date_default_timezone_set('america/bogota');
        $fecha_actual = date("Y-m-d H:i:s");


        if ($d1 >150 ) {
            $d1=50;
        } if ($d2 >150 ) {
            $d2=50;
        } if ($d3 >150 ) {
            $d3=50;
        }

        $consulta = "INSERT INTO state(state_id_garbage,destance,date) VALUES (1,'$d1','$fecha_actual')," +
            "(2,'$d2','$fecha_actual'), (3,'$d3','$fecha_actual');";
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <title>Garbage</title>
</head>

<body>
    <hr class="border border-danger border-2 opacity-50">
    <div class="container-sm">
        <div class="card text-bg-primary mb-3" style="max-width: 18rem;">
            <div class="card-header">Header</div>
            <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
            
        </div>

        <div class="card text-bg-info mb-3" style="max-width: 18rem;">
            <div class="card-header">Header</div>
            <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
        <div class="card text-bg-primary mb-3" style="max-width: 18rem;">
            <div class="card-header">Header</div>
            <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
    </div>

</body>

</html>
<html>