<?php

    $host="host=ec2-35-168-122-84.compute-1.amazonaws.com ";
    $port="port=5432 ";
    $db ="dbname=d4g4et7022hh71 ";
    $user = "user=dowwjwpkqwunlw ";
    $pass = "password=be654f696b5680cf088e583b7f20d7982b287c9b55c9db4a5411393452c1e60f";
    $con = pg_connect("$host $port $db $user $pass");
    if($con){
        //$consulta = "insert into garbage (description, garbage_id_container) values ('Papel',1),('Plastico y metal',1),('vidrio',1)";
       // $consulta = "SELECT * FROM state ORDER BY state_id_garbage DESC LIMIT 3";
       $consulta = "SELECT * FROM state";
    $resultado = pg_query($con, $consulta);
    if($resultado){
        echo "hecho!";
    }
    if(pg_num_rows($resultado)){
        echo "si";
        echo "<p>Lista</p>";
        echo"</br>";
        while($obj=pg_fetch_object($resultado)){
            echo $obj->state_id_garbage,"--";
            echo $obj->destance,"--";
            
        }
    } 
    }
?>