<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="img/Santi.png" type="image/svg+xml">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type='text/css' href="style/style.css">
    <title>Actualizar datos del Equipo</title>
</head>
<body>
<div class="container mt-4">

<?php
include('configuracion/conexionsql.php');


?>

<!--se realiza el html-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tabla de Datos</title>
</head>
<body>
    <?php

    include('menu.php');

    include('titulo.php');

    include('complementos/tabla.php');

    ?>

            <?php
            include('complementos/paginacion.php');  
            ?>
    <!--se abre en titulo--></div>

</html>





<!--script para html de insertar-->

<?php
    include('complementos/body_actualizar.php');  
?>
       
</body>

<?php
    include('complementos/footer.php');  
?>






    <!---Script que captura datos en todo--->

    <?php
    include('complementos/capturador_datos.php');  
    ?>  




</html>