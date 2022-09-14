<?php

include 'conexion.php';

if ($con) {

  echo "Conexion con base de datos exitosa! ";
 if (file_get_contents('php://input')) {
  echo "\nIngerso correcto al post";
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    echo "\naqui llegue";
    //echo $data['fotografias'];
    //echo file_get_contents('php://input');
    $data = $data['fotografias'];

    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);
    $data = base64_decode($data);
    $DateAndTime = (string) date('mdY-his', time());
    $nomimg = "../capture/images$DateAndTime.png";
    file_put_contents($nomimg, $data);

    echo $nomimg;

    $sql = "INSERT INTO capture(url) VALUES('$nomimg');";
    $resultado = pg_query($con, $sql);
    if ($resultado) {
        echo "\nGuardado correctamente";
    } else {
        echo "\nincorrecto no se guardo";
    }

  }//fin del if post

  

} else {//else de si falla conexion
  echo "Falla! conexion con Base de datos ";
}

?>