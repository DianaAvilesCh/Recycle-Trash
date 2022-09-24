<?php
include 'sidebar.html';
include('./controller/conexion.php');
echo '</br>';
echo '</br>';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- CSS only -->
        <link rel="stylesheet" href="/css/style.css">

        <title>Garbage</title>
    </head>

    <body>
        <div class="container">
            <?php
            if ($con) {
                $consulta = "SELECT state.id, g.description, state.destance_porce FROM state INNER join
                container_garbage cg on cg.id = state.state_id_garbage INNER join
                garbage g on g.id = cg.id_garbage where cg.id_container = $id
                ORDER BY state.id desc LIMIT 3;";
                $resultado = pg_query($con, $consulta);
                if (pg_num_rows($resultado)) {
                    while ($obj = pg_fetch_object($resultado)) { ?>
                        <div class="card <?php echo $obj->description ?>">
                            <div class="box">
                                <div class="circle-wrap">
                                    <div role="progressbar" aria-valuenow="<?php echo $obj->destance_porce ?>" aria-valuemin="0" aria-valuemax="100" style="--value:<?php echo $obj->destance_porce ?>">
                                    </div>
                                </div>
                                <h2 class="text"><?php echo $obj->description ?></h2>
                            </div>
                        </div>
            <?php }
                } else {
                    header("Location: ../NotRegister.php");
                }
            }
            ?>
        </div>

    </body>

    </html>
    <html>
<?php
} else {
    echo '<h1 style="padding:0px;">No hay información</h1>';
}
?>