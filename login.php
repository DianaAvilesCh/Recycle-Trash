<?php
//include('../class/accesos.php');
if (isset($_POST['submit'])) {
    $correo = $_POST['correo'];
    $pass = $_POST['pass'];
    $params = array(
        'correo' => $correo,
        'pass' => $pass
    );

    $login = json_decode($accesos->login($params));

    if ($login->estado == true) {
        echo 'Se inicio sesion correctamente.';
        print_r($login);
    } else {
        echo '<p>Ocurrio un error.</p>';
        echo $login->mensaje;
    }
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
    <div class=" w3l-login-form">
        <h1>Sign up User</h1>
        <form action="register.php" method="POST">
            <div class=" w3l-form-group">
                <label>First Name:</label>
                <div class="group">
                    <i class="fas fa-user"></i>
                    <input type="text" class="form-control" placeholder="First Name" name="name" required="required" />
                </div>
            </div>
            <div class=" w3l-form-group">
                <label>Last Name:</label>
                <div class="group">
                    <i class="fas fa-user"></i>
                    <input type="text" class="form-control" placeholder="First Name" name="lname" required="required" />
                </div>
            </div>
            <div class=" w3l-form-group">
                <label>Username:</label>
                <div class="group">
                    <i class="fas fa-user"></i>
                    <input type="text" class="form-control" placeholder="Username" name="correo" required="required" value="ejemplo@mail.com" />
                </div>
            </div>
            <div class=" w3l-form-group">
                <label>Password:</label>
                <div class="group">
                    <i class="fas fa-unlock"></i>
                    <input type="password" class="form-control" placeholder="Password" name="pass" required="required" />
                </div>
            </div>
            <div class="forgot">
                <a href="#">Forgot Password?</a>
                <p><input type="checkbox">Remember Me</p>
            </div>
            <button type="submit" name="submit" value="login">Login</button>
        </form>
        <p class=" w3l-register-p">Don't have an account?<a href="#" class="register"> Register</a></p>
    </div>
    <footer>
        <p class="copyright-agileinfo"> &copy; 2018 Material Login Form. All Rights Reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
    </footer>
</body>

</html>