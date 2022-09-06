<?php
include 'sidebar.html';
include('./controller/conexion.php');
echo '</br>';
echo '</br>';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <title>Report</title>
</head>

<body>
<div style="margin: 2%;">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">TACHO</th>
                <th scope="col">DISTANCIA</th>
                <th scope="col">FECHA</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($con) {
                $consulta = "SELECT * FROM state";
                $resultado = pg_query($con, $consulta);
                if (pg_num_rows($resultado)) {
                    while ($obj = pg_fetch_object($resultado)) { ?>
                        <tr>
                            <td><?php echo $obj->id ?></td>
                            <td><?php echo $obj->state_id_garbage ?></td>
                            <td><?php echo $obj->destance ?></td>
                            <td><?php echo $obj->date ?></td>
                        </tr>
            <?php }
                }
            }
            pg_close();
            ?>
        </tbody>
    </table>
    </div>
</body>

</html>
<html>