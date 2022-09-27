<?php
session_start();
if ($_SESSION["newsession"] == "nothing" || $_SESSION["newsession"] == null) {
    header("Status: 301 Moved Permanently");
    header("Location: /");
    exit;
} else {
    include 'sidebar.html';
    include('../controller/conexion.php');
    include '../alerts.html';
    echo '</br>';
    echo '</br>';
    $dato = $_SESSION["newsession"];
    if (isset($_POST['submit'])) {
        $passActual = $_POST['currentPassword'];
        $pass1 = $_POST['newPassword'];
        $pass2 = $_POST['repeatPassword'];

        $sql = "SELECT * FROM select_login('$dato');";
        $resultado = pg_query($con, $sql);
        if (pg_num_rows($resultado)) {
            $obj = pg_fetch_object($resultado);
            $passSubmit = $obj->pass;
            if (password_verify($passActual, $passSubmit)) {
                if ($passActual != $pass1 && $passActual != $pass2) {
                    if ($pass1 == $pass2) {
                        $phash = password_hash($pass1, PASSWORD_DEFAULT);
                        $sql = "call update_Password(null,$1,$2);";
                        pg_prepare($con, "my_quer", $sql);
                        $resul = pg_execute($con, "my_quer", array("$dato", "$phash"));
                        $cont_entry = pg_fetch_array($resul)[0];
                        if ($cont_entry != null) {
                            echo '<script language="javascript">
                initAlert(success_,"Info: Password reset");</script>';
                        }
                    } else {
                        echo '<script language="javascript">
                initAlert(warning_,"The password does not match. Try again.");</script>';
                    }
                } else {
                    echo '<script language="javascript">
                initAlert(warning_,"Warning: The current password and </br>the new password  cannot be the same.");</script>';
                }
            } else {
                echo '<script language="javascript">
                initAlert(warning_,"Warning: Current password is not correct.");</script>';
            }
        }
        pg_close();
    }
    if (isset($_POST['cancel'])) {
        $_SESSION["newsession"] = $dato;
        header("Status: 301 Moved Permanently");
        header("Location: ../view/home.php");
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <title>Password change</title>
        <link rel="stylesheet" href="/css/altert_alt.css">
    </head>

    <body>
        <div>
            <form action="password.php" method="POST">
                <h1 class="title">Password change</h1>
                <div class="container">
                    <div class="mb-3">
                        <label for="currentPassword" class="form-label"><i class="bi bi-key"></i> Current password</label>
                        <input type="text" class="form-control" name="currentPassword" placeholder="Current password">
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label"><i class="bi bi-key"></i> New password</label>
                        <input type="text" class="form-control" name="newPassword" placeholder="New password">
                    </div>
                    <div class="mb-3">
                        <label for="repeatPassword" class="form-label"><i class="bi bi-key"></i> Repeat password</label>
                        <input type="text" class="form-control" name="repeatPassword" placeholder="Repeat Password">
                    </div>
                    <button type="submit" name="cancel" class="btn btn-danger" style="float: right; margin: 1%;">
                        <i class="bi bi-x-square"></i>
                        Cancel</button>
                    </button>
                    <button type="submit" name="submit" class="btn btn-success" style="float: right;margin: 1%;">
                        <i class="bi bi-file-earmark"></i>
                        Save</button>
                    </button>
            </form>
        </div>
    </body>

    </html>
<?php
}
?>