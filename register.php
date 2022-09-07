<?php
include('./controller/conexion.php');
if (isset($_POST['submit'])) {
    $fname = $_POST['name'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $phash = password_hash($pass, PASSWORD_DEFAULT);
    $sql = "INSERT INTO person (email, password, first_name, last_name) 
    values ('$email','$phash','$fname','$lname');";
    $resultado = pg_query($con, $sql);
    if ($resultado) {
        header("Status: 301 Moved Permanently");
        header("Location: ../login.php");
        exit;
    } else {
        echo 'incorrecto' . $pass, $hash;
    }
    pg_close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- CSS only -->
    <!--icons-->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
    <!-- google fonts-->
    <link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="/css/login.css">
    <title>Register</title>
</head>

<body>
</br>
    <div class=" w3l-login-form">
        <h1>Sign up User</h1>
        <form action="register.php" method="POST">
            <div class=" w3l-form-group">
                <label>First Name:</label>
                <div class="group">
                <ion-icon name="person-outline"></ion-icon>
                <input type="text" class="form-control" placeholder="First Name" name="name" required="required" />
                </div>
            </div>
            <div class=" w3l-form-group">
                <label>Last Name:</label>
                <div class="group">
                <ion-icon name="person-outline"></ion-icon>
                    <input type="text" class="form-control" placeholder="Last Name" name="lname" required="required" />
                </div>
            </div>
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
            <p><input type="checkbox"></p>
                <a href="#">By registering you accept the terms and conditions and the privacy policy of Recycle</a>
            </div>
            <button type="submit" name="submit" value="Register">Register</button>
        </form>
    </div>
    <footer>
        <p class="copyright-agileinfo"> &copy; 2018 Material Login Form. All Rights Reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
    </footer>
</body>

</html>