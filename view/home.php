<?php
session_start();
if ($_SESSION["newsession"] == "nothing" || $_SESSION["newsession"] == null) {
    header("Status: 301 Moved Permanently");
    header("Location: /");
    exit;
} else {
    include('sidebar.html');
    echo '</br>';
    echo '</br>';
    echo '</br>';
    include('../controller/conexion.php');
    $sql1 = "SELECT con.id from container con;";
    $resultado1 = pg_query($con, $sql1);
    if (pg_num_rows($resultado1)) {
        while ($obj1 = pg_fetch_object($resultado1)) {
            $sql = "SELECT x.name_container, x.address,x.description, x.destance_porce from (SELECT state.id, g.description, state.destance_porce, 
            con.address,con.name_container 
            FROM state INNER join container_garbage cg on cg.id = state.state_id_garbage INNER join
            garbage g on g.id = cg.id_garbage INNER join container con  on con.id = cg.id_container
            where cg.id_container = $obj1->id
            ORDER BY state.id desc,g.description LIMIT 3)  as x ORDER BY x.id asc";
            $resultado = pg_query($con, $sql);
            if (pg_num_rows($resultado)) {
                while ($obj = pg_fetch_object($resultado)) {
                    if ($obj->destance_porce == 100) {

                        echo "<div style='text-align: center; padding-top:10px' ><div class='alert alert-success alert-dismissible fade show' 
                        role='alert' style='width: 50%;margin:0px auto;>
                        <h4 class='alert-heading'>Alert!</h4>
                        <strong>$obj->name_container</strong> Full
                        $obj->description garbage can <strong> Address</strong> $obj->address 
                   </div></div>";
                    }
                }
            }
        }
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

        <title>Index</title>
    </head>

    <body>
        <div style="margin: 2%; justify-content: center;Position: relative;display: flex;">
            <img src="../resources/zz11b-02-1024x748.png" class="img-fluid" style="width: 50%; ">
        </div>
    </body>

    </html>
<?php
}
?>