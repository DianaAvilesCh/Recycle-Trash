<?php
include('../controller/conexion.php');
if ($con) {
    if (isset($_GET['mail'])) {
        $mail = $_GET['mail'];
    }
    if (isset($_GET['act'])) {
        $act = $_GET['act'];

        $mailhash = md5($mail);
        //tengo que extraer datos de la bd para comparar codigo y hash email 

        $consulta = "SELECT email FROM person WHERE email_hash = $mail;";
        $resultado = pg_query($con, $consulta);
        if (pg_num_rows($resultado)) {
            while ($obj = pg_fetch_object($resultado)) {
                $dato = $obj->email;
            }
            if (md5($dato) == $mail) {
                $consulta = "UPDATE person SET state = 1 WHERE email = $dato; ";
                $resultado = pg_query($con, $consulta);
                if ($resultado) {
                    echo "SI FUE";
                    echo '<script>alert("Your account has been activated!");</script>';
                    header("Status: 301 Moved Permanently");
                    header("Location: https://recycle-trash.herokuapp.com/");
                    exit;
                } else {
                    echo 'An error has occurred, please try again!';
                }
            } else {
                echo 'An error has occurred, please try again!';
            }
        }
    }
}
