<?php
session_start();
if ($_SESSION["newsession"] == "nothing") {
    header("Status: 301 Moved Permanently");
    header("Location: ../../index.php");
    exit;
} else {
    include 'sidebar.html';
    include('../controller/conexion.php');
    echo '</br>';
    echo '</br>';
    $dato = $_SESSION["newsession"];
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
        <title>Document</title>
        <title>Password change</title>
    </head>

    <body>
        <div>
            <h1 style="text-align: center;margin: 1%;">Password change</h1>
            <div class="container" style="width: 50%;">
                <div class="mb-3">
                    <label for="currentPassword" class="form-label"><i class="bi bi-key"></i> Current password</label>
                    <input type="text" class="form-control" id="currentPassword" placeholder="Current password">
                </div>
                <div class="mb-3">
                    <label for="newPassword" class="form-label"><i class="bi bi-key"></i> New password</label>
                    <input type="text" class="form-control" id="newPassword" placeholder="New password">
                </div>
                <div class="mb-3">
                    <label for="repeatPassword" class="form-label"><i class="bi bi-key"></i> Repeat password</label>
                    <input type="text" class="form-control" id="repeatPassword" placeholder="Repeat Password">
                </div>
                <button type="button" class="btn btn-danger" style="float: right; margin: 1%;">
                    <i class="bi bi-x-square"></i>
                    Cancel</button>
                </button>
                <button type="button" class="btn btn-success" style="float: right;margin: 1%;">
                    <i class="bi bi-file-earmark"></i>
                    Save</button>
                </button>
            </div>
    </body>

    </html>
<?php
}
?>