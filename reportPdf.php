<?php
include 'sidebar.html';
include('./controller/conexion.php');
echo '</br>';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <!--<link rel="stylesheel" href="/css/style.css">-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Report</title>
    <link rel="stylesheet" href="/css/style_report.css">
</head>

<body>
    <div style="margin: 2%;">
        <h1 style="text-align: center;">Report</h1>
        <a type="submit" class="Expor btn btn-success" name="submit" href="export.php" target='_blank' rel="noopener noreferrer">
            <i class="bi bi-filetype-pdf"></i>
            Export PDF
        </a>
        <table class="table" style="margin: 1%;">
            <thead class="thead-light">
                <tr>
                    <th scope="col" style="text-align:center;">Date</th>
                    <th scope="col" style="text-align:center;">Container name</th>
                    <th scope="col" style="text-align:center;">Type of waste</th>
                    <th scope="col" style="text-align:center;">Percentage</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($con) {
                    $consulta = "SELECT st.date,con.name_container, gar.description as name_garbage,
                    (sum(st.destance_porce)/count(all st.date)||'%') AS porcentaje from state st INNER join
                    container_garbage cg on cg.id = st.state_id_garbage INNER join
                    container con on con.id = cg.id_container INNER join
                    garbage gar on gar.id = cg.id_garbage
                    group by st.date,con.id, gar.id
                    ORDER by st.date,con.id, gar.id";
                    $resultado = pg_query($con, $consulta);
                    if (pg_num_rows($resultado)) {
                        while ($obj = pg_fetch_object($resultado)) { ?>
                            <tr>
                                <td style="text-align:center;"><?php echo $obj->date ?></td>
                                <td style="text-align:center;"><?php echo $obj->name_container ?></td>
                                <td style="text-align:center;"><?php echo $obj->name_garbage ?></td>
                                <td style="text-align:center;"><?php echo $obj->porcentaje ?></td>
                            </tr>
                <?php }
                    }
                }
                pg_close();
                ?>
            </tbody>
        </table>
    </div>
    <script>
        function exportar() {
            console.log('hola');
        }
    </script>
</body>

</html>