<?php
include('./controller/conexion.php');
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $sql = "SELECT person.email, person.password FROM person WHERE email = '$email';";
    $resultado = pg_query($con, $sql);
    if (pg_num_rows($resultado)) {
        $obj = pg_fetch_object($resultado);
        $dato = $obj->password;
        // $hash = password_hash($dato, PASSWORD_DEFAULT);
        if (password_verify($pass, $dato)) {
            header("Status: 301 Moved Permanently");
            header("Location: ../index.php");
            exit;
        } else { ?>
            <script language="javascript">
                alert("Incorrect Email address or password");
            </script>
        <?php
        }
    } else { ?>
        <script language="javascript">
            alert("Incorrect Email address or password");
        </script>
<?php
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
    <title>Login</title>
</head>

<body>
    </br>
    <div class=" w3l-login-form">
        <div class="img-logo">
            <img src="/resources/logo.png">
        </div>
        <h1>Login</h1>
        <form action="login.php" method="POST">
            <div class=" w3l-form-group">
                <label>Email:</label>
                <div class="group">
                    <ion-icon name="person-circle-outline"></ion-icon>
                    <input type="text" class="form-control" placeholder="ejemplo@mail.com" name="email" required="required" />
                </div>
            </div>
            <div class=" w3l-form-group">
                <label>Password:</label>
                <div class="group">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" class="form-control" placeholder="Password" name="pass" required="required" />
                </div>
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