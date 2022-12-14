<?php
session_start();
if ($_SESSION["newsession"] == "nothing" || $_SESSION["newsession"] == null) {
    header("Status: 301 Moved Permanently");
    header("Location: /");
    exit;
} else {
    include('sidebar.html');
    include('../controller/conexion.php');
    echo '</br>';
    echo '</br>';
    $dato = $_SESSION["newsession"];
    if (isset($_POST['submit'])) {
        $name = $_POST['first'];
        $lname = $_POST['lastName'];
        $email = $_POST['email_'];
        if ($name != '' && $lname != '' && $email != '') {
            $sql = "call update_person($1,$2,$3,$4,null);";
            pg_prepare($con, "my_query", $sql);
            $resul = pg_execute($con, "my_query", array("$dato", "$name", "$lname", "$email"));
            $cont_entry = pg_fetch_array($resul)[0];
            if ($cont_entry != null) {
                header("Location: ../view/profile.php");
            }
        }
        pg_close();
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
        <title>Personal Information</title>
    </head>

    <body>
        <div>
            <h1 style="text-align: center;margin: 1%;">Personal Information</h1>
            <div class="container" style="width: 50%;">
                <div class="mb-3">
                    <?php
                    if ($con) {
                        $consulta = "SELECT per.first_name,per.last_name,per.email from person per where per.email='$dato'";
                        $resultado = pg_query($con, $consulta);
                        if (pg_num_rows($resultado)) {
                            while ($obj = pg_fetch_object($resultado)) { ?>
                                <label for="firstName" class="form-label"><i class="bi bi-person-lines-fill"></i> First Name</label>
                                <input type="text" class="form-control" name="firstName" value="<?php echo $obj->first_name ?>" disabled readonl>
                                <label for="lastName" class="form-label"><i class="bi bi-person-lines-fill"></i> Last Name</label>
                                <input type="text" class="form-control" name="lastName" value="<?php echo $obj->last_name ?>" disabled readonl>
                                <label for="email" class="form-label"><i class="bi bi-at"></i>Email</label>
                                <input type="email" class="form-control" name="email_" value="<?php echo $obj->email ?>" disabled readonl>
                            <?php
                            }
                        } else {
                            ?>
                            <h1 style="text-align: center;">You are not authorised</h1>
                    <?php
                        }
                    }
                    ?>
                </div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEdit" style="float: right;">
                    <i class="bi bi-pencil-square"></i>
                    Edit</button>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Personal information edited</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="profile.php" method="POST">
                                    <div class="mb-3">
                                        <?php
                                        if ($con) {
                                            $consulta = "SELECT per.first_name,per.last_name,per.email from person per where per.email='$dato'";
                                            $resultado = pg_query($con, $consulta);
                                            if (pg_num_rows($resultado)) {
                                                while ($obj = pg_fetch_object($resultado)) { ?>
                                                    <label for="firstName" class="form-label"><i class="bi bi-person-lines-fill"></i> First Name</label>
                                                    <input type="text" class="form-control" name="first" value="<?php echo $obj->first_name ?>" require>
                                                    <label for="lastName" class="form-label"><i class="bi bi-person-lines-fill"></i> Last Name</label>
                                                    <input type="text" class="form-control" name="lastName" value="<?php echo $obj->last_name ?>" require>
                                                    <label for="email" class="form-label"><i class="bi bi-at"></i>Email</label>
                                                    <input type="email" class="form-control" name="email_" value="<?php echo $obj->email ?>" require>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <h1 style="text-align: center;">You are not authorised</h1>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-square"></i>
                                            Cancel</button>
                                        <button type="submit" name="submit" class="btn btn-success" style="float: right;margin: 1%;">
                                            <i class="bi bi-file-earmark"></i>
                                            Save</button>
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </body>

    </html>
<?php
}
?>