<?php
include('../controller/conexion.php');
include '../alerts.html';
echo '</br>';
echo '</br>';
echo '</br>';
if (isset($_POST['submit'])) {
    $email = $_POST['submitEmail'];
    $sql = "SELECT per.email from person per WHERE per.email='$email';";
    $resultado = pg_query($con, $sql);
    if (pg_num_rows($resultado)) {
        $obj = pg_fetch_object($resultado);
        $passSubmit = $obj->email;
        echo '<script language="javascript">
                    initAlert(success_,"Info: Password reset. Please check your email.");</script>';
    } else {
        echo '<script language="javascript">
                    initAlert(warning_,"Warning: This email does not exist. </br> Enter a different email or get a new user.");</script>';
    }
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
    <title>Forgot Password</title>
    <link rel="stylesheet" href="/css/altert_alt.css">
</head>

<body>
    <div>
        <nav class="navbar navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="../../view/home.php" style="float: right;">Recycle-Trash</a>
            </div>
        </nav>
    </div>
    <div>
        <form action="forgotpassword.php" method="POST">
            <h1>Password Recovery</h1>
            <div class="container">
                <div class="mb-3">
                    <label for="submitEmail" class="form-label"><i class="bi bi-envelope"></i> Enter your email address</label>
                    <input type="email" class="form-control" name="submitEmail" placeholder="Email" required>
                </div>
                <button type="submit" name="submit" class="btn btn-success" style="float: right;margin: 1%;">
                    <i class="bi bi-lock"></i>
                    Reset password</button>
                </button>
        </form>
    </div>
</body>

</html>