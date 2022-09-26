<?php
include('./controller/conexion.php');
if ($con) {
    if (isset($_GET['mail'])) {
        $mail = $_GET['mail'];
    }
    if (isset($_GET['act'])) {
        $act = $_GET['act'];

        $mailhash = md5($mail);

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
?>
                    <script>
                        alert("Your account has been activated!");
                        window.location.replace("https://recycle-trash.herokuapp.com/");
                    </script>
<?php
                } else {
                    echo 'An error has occurred, please try again!';
                }
            } else {
                echo 'An error has occurred, please try again!';
            }
        }
    }
}
?>