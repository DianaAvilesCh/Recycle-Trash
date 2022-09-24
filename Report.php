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
            <thead class="thead-light">
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Name Container</th>
                    <th scope="col">Name Garbage</th>
                    <th scope="col">Percentage</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($con) {
                    $consulta = "SELECT st.date,con.name_container, gar.description as name_garbage,
                    sum(st.destance_porce)/count(all st.date) as porcentaje from state st INNER join
                    container_garbage cg on cg.id = st.state_id_garbage INNER join
                    container con on con.id = cg.id_container INNER join
                    garbage gar on gar.id = cg.id_garbage
				    group by st.date,con.id, gar.id
				    ORDER by st.date,con.id, gar.id";
                    $resultado = pg_query($con, $consulta);
                    if (pg_num_rows($resultado)) {
                        while ($obj = pg_fetch_object($resultado)) { ?>
                            <tr>
                                <td><?php echo $obj->date ?></td>
                                <td><?php echo $obj->name_container ?></td>
                                <td><?php echo $obj->name_garbage ?></td>
                                <td><?php echo $obj->porcentaje ?>%</td>
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