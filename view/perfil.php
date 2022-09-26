<?php
include('sidebar.html');
include('../controller/conexion.php');
echo '</br>';
echo '</br>';
session_start();
$dato= $_SESSION["newsession"];
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
                    $consulta = "SELECT per.first_name,per.last_name,per.email from person per where per.id='$dato'";
                    $resultado = pg_query($con, $consulta);
                    if (pg_num_rows($resultado)) {
                        while ($obj = pg_fetch_object($resultado)) { ?>
                            <label for="firstName" class="form-label"><i class="bi bi-person-lines-fill"></i> First Name</label>
                            <input type="text" class="form-control" id="firstName" value="<?php echo $obj->first_name ?>" disabled readonl>
                            <label for="lastName" class="form-label"><i class="bi bi-person-lines-fill"></i> Last Name</label>
                            <input type="text" class="form-control" id="lastName" value="<?php echo $obj->last_name ?>" disabled readonl>
                            <label for="email" class="form-label"><i class="bi bi-at"></i>Email</label>
                            <input type="email" class="form-control" id="email" value="<?php echo $obj->email ?>" disabled readonl>
                        <?php
                        }
                    } else {
                        ?>
                        <option value="">No record found</option>
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
                            <div class="mb-3">
                                <?php
                                if ($con) {
                                    $consulta = "SELECT per.first_name,per.last_name,per.email from person per where per.id=34";
                                    $resultado = pg_query($con, $consulta);
                                    if (pg_num_rows($resultado)) {
                                        while ($obj = pg_fetch_object($resultado)) { ?>
                                            <label for="firstName" class="form-label"><i class="bi bi-person-lines-fill"></i> First Name</label>
                                            <input type="text" class="form-control" id="firstName" value="<?php echo $obj->first_name ?>">
                                            <label for="lastName" class="form-label"><i class="bi bi-person-lines-fill"></i> Last Name</label>
                                            <input type="text" class="form-control" id="lastName" value="<?php echo $obj->last_name ?>">
                                            <label for="email" class="form-label"><i class="bi bi-at"></i>Email</label>
                                            <input type="email" class="form-control" id="email" value="<?php echo $obj->email ?>">
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <option value="">No record found</option>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" style="float: right; margin: 1%;">
                                <i class="bi bi-x-square"></i>
                                Cancel</button>
                            </button>
                            <button type="button" class="btn btn-success" style="float: right;margin: 1%;">
                                <i class="bi bi-file-earmark"></i>
                                Save</button>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>