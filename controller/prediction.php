<?php
include 'conexion.php';
if ($con) {
  //if get
  if (isset($_GET['predit'])) {
    $predit = $_GET['predit'];
    $sql = "UPDATE capture SET state='$predit';";
    $resultado = pg_query($con, $sql);
    if ($resultado) {
      echo "CORRECTO";
    }
  }
}
?>