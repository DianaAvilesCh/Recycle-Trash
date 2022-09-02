<?php
include 'sidebar.html';
include 'conexion.php';
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
    <!--<link rel="stylesheel" href="/css/style.css">-->
    <title>Container</title>
</head>
<body>
    <div style="margin: 2%;">
    <h1>Containers</h1>
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
</body>
</html>