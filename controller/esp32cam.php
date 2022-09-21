<?php

include 'conexion.php';
  //if post of arduino
    if (file_get_contents('php://input')) {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $data = $data['fotografias'];

    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);
    $data = base64_decode($data);
    $DateAndTime = (string) date('mdY-his', time());
    $nomimg = "../capture/images$DateAndTime.png";
    file_put_contents($nomimg, $data);  
    
    $consulta = "INSERT INTO image(url) VALUES ('$nomimg');";
    $resultado = pg_query($con, $consulta);
   //$nomimg = "../capture/images09142022-071619.png";
   header("Location: https://recycle-trash.herokuapp.com/controller/prediction.php?image=$nomimg");
   exit();
   }
?>