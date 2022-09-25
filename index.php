<?php
include('./controller/conexion.php');
include 'alerts.html';
session_start();

// si esta definida sera igual a intentos en caso contrario sera 0
$_SESSION["fails"] = isset($_SESSION["fails"]) ? $_SESSION["fails"] : 0;
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $sql = "SELECT * FROM select_login('$email');";
    $resultado = pg_query($con, $sql);
    echo $resultado;
    if (pg_num_rows($resultado)) {
        $obj = pg_fetch_object($resultado);
        $dato = $obj->pass;
        $estado = $obj->stt;
        if ($estado == 1) {
            if (password_verify($pass, $dato)) {
                //$_SESSION["newsession"]=""
                header("Status: 301 Moved Permanently");
                header("Location: ../view/index.php");
                exit;
            } else {
                $_SESSION['fails'] = $_SESSION['fails'] + 1;
                if ($_SESSION['fails'] == 3) {
                    echo '<script language="javascript">
                    initAlert(warning,"Warning: Your account has been blocked");</script>';
                    $_SESSION['fails'] = 0;
                }
                else{
                    $sql = "UPDATE person SET state = 0 WHERE email='$email';";
                    $resultado = pg_query($con, $sql);
                    echo '<script language="javascript">
                    initAlert(warning,"Warning: Incorret email or password.");
                    console.log(',$_SESSION['fails'],');</script>';
                }
            }
        } else {
            echo '<script language="javascript">
                    initAlert(warning,"Warning: User blocked");</script>';
        }

        // $hash = password_hash($dato, PASSWORD_DEFAULT);

    } else {
        echo '<script language="javascript">
                    initAlert(warning,"Warning: Incorret email or password.");</script>';
    }
    pg_close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!--icons-->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- google fonts-->
    <link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="/css/login.css">
    <link rel="stylesheet" href="/css/alert.css">

    <title>Login</title>
</head>
<body>
    </br>

    <div class=" w3l-login-form">
        <div class="img-logo">
            <img src="/resources/logo.png">
        </div>
        <h1>Login</h1>
        <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
            <div class=" w3l-form-group">
                <label>Email:</label>
                <div class="group">
                    <ion-icon name="person-circle-outline"></ion-icon>
                    <input type="email" class="form-control" placeholder="ejemplo@mail.com" name="email" required="required" aria-describedby="emailHelp" />
                </div>
            </div>
            <div class=" w3l-form-group">
                <label>Password:</label>
                <div class="group">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" class="form-control" placeholder="Password" name="pass" required="required" aria-describedby="emailHelp" aria-describedby="passwordHelpBlock" />
                </div>
                <p id="passwordHelpBlock" class="w3l-register-p">Your password must be between 8 and 20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.</p>
            </div>
            <div class="forgot">
                <a href="#">Forgot Password?</a>
                <p><input type="checkbox">Remember Me</p>
            </div>
            <button type="submit" name="submit" value="login">Login</button>
        </form>
        <p class=" w3l-register-p">Don't have an account?<a href="./register.php" class="register"> Register</a></p>
    </div>
    <footer>
        <p class="copyright-agileinfo"> &copy; 2018 Material Login Form. All Rights Reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
    </footer>
</body>

</html>