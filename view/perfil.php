<?php
include ('sidebar.html');
include('../controller/conexion.php');
echo '</br>';
echo '</br>';
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
                <label for="firstName" class="form-label"><i class="bi bi-person-lines-fill"></i> First Name</label>
                <input type="text" class="form-control" id="firstName" placeholder="First Name">
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label"><i class="bi bi-person-lines-fill"></i> Last Name</label>
                <input type="text" class="form-control" id="lastName" placeholder="Last Name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label"><i class="bi bi-at"></i> Email</label>
                <input type="text" class="form-control" id="email" placeholder="Email">
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
                                <label for="firstName" class="form-label"><i class="bi bi-person-lines-fill"></i> First Name</label>
                                <input type="text" class="form-control" id="firstName" placeholder="First Name">
                            </div>
                            <div class="mb-3">
                                <label for="lastName" class="form-label"><i class="bi bi-person-lines-fill"></i> Last Name</label>
                                <input type="text" class="form-control" id="lastName" placeholder="Last Name">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>