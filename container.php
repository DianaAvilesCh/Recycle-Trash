<?php
include 'sidebar.html';
include('./controller/conexion.php');
echo '</br>';
echo '</br>';
if (isset($_POST['Saver'])) {
    $name = $_POST['name'];
    $dname = $_POST['addressC'];
    $garba = $_POST['garbage'];
    echo 'llege aqui';
    $sql = "call new_container(null,'$dname','$name');";
    
    $resultado = pg_query($con, $sql);
    if ($resultado) {
        foreach ($garba as $garbagelist) {
            $sql2 = "call new_container_garbage('$resultado','$garbagelist');";
            $resultado2 = pg_query($con, $sql2);
            if ($resultado2) {
                header("Location: ../container.php");
            } else {
                echo '<script language="javascript">
                    alert("Error en crear");</script>';
            }
        }
        exit;
    } else {
        echo 'incorrecto';
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
    <!--<link rel="stylesheel" href="/css/style.css">-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <title>Container</title>
</head>

<body>
    <div style="margin: 2%;">
        <h1 style="text-align: center;">Containers</h1>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
            New
        </button>

        <!-- Modal -->

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Container</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="container.php" method="POST">
                        <div class="modal-body">
                            <div class="card-body">
                                <div class="row">
                                    <div class="cold-md-3">
                                        <div class="form-group">
                                            <label for="InputName">Name Container</label>
                                            <input id="name" name="name" type="text" class="form-control" placeholder="Container Name"  required="required" />
                                        </div>
                                        <div class="form-group">
                                            <label for="InputAddress">Address</label>
                                            <input type="text" class="form-control" name="addressC" placeholder="Address">
                                        </div>
                                    </div>
                                    <div class="cold-md-6">
                                        <label for="InputGarbage">Select type of waste</label>
                                        <select name="garbage[]" class="form-control mb-3 multiple-select" style="width: 100%" multiple require>
                                            <?php
                                            if ($con) {
                                                $consulta = "SELECT garbage.id,garbage.description from garbage";
                                                $resultado = pg_query($con, $consulta);
                                                if (pg_num_rows($resultado)) {
                                                    while ($obj = pg_fetch_object($resultado)) { ?>
                                                        <option value="<?php echo $obj->id ?>"><?php echo $obj->description ?></option>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="">No record found</option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="Save" name="Saver" value="Register" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4" style="padding-top: 5px;">

            <?php
            if ($con) {
                $consulta = "SELECT * FROM container";
                $resultado = pg_query($con, $consulta);
                if (pg_num_rows($resultado)) {
                    while ($obj = pg_fetch_object($resultado)) { ?>
                        <div class="col">
                            <div class="card" style="padding: 8px;">
                                <img src="/resources/jateastiat_iso-1140x641.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $obj->name_container ?></h5>
                                    <p class="card-text"><?php echo $obj->address ?></p>
                                    <a href="/garbage.php/?id=<?php echo $obj->id ?>" class="btn btn-primary">View</a>
                                </div>
                            </div>
                        </div>
            <?php }
                }
            }
            ?>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('.multiple-select').select2();
    </script>
</body>

</html>