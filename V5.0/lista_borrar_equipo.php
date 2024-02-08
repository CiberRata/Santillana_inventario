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
    <title>Borrar un Equipo</title>
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

            <!---Se abre en titulo.php--></div> 

            <?php
            include('complementos/paginacion.php');  
            ?>
    
    <br>


    
</html>





<!--script para html de insertar-->

<div class="container mt-4">

    <!---Para borrar un equipo seleccionando--->

    <h1>Borrar Equipo - Seleccionando</h1>
    <form action="borrar_equipo.php"  method="post">
        <div class="form-group row align-items-start">   

        <label for="inputSerie">Número de Serie a Borrar:</label>
        <input type="text" id="serie_borrar" name="serie_borrar"><br><br>
        </div>
        <input type="submit" value="Borrar Equipo" class="btn btn-outline-success boton_enviar">
        
        <!-- Agrega más campos según tus necesidades -->
        
    </form>

    <!------Para actualizar----->
</div>     
</body>

<?php
    include('complementos/footer.php');  
?>






    <!---Script que captura datos en todo--->

    <script>
        window.onload = function() {
            // Obtener todas las filas de la tabla
            const filasTabla = document.querySelectorAll("#tabladatos tbody tr");
           

            // Agregar un evento 'click' a cada fila
            filasTabla.forEach(fila => {
                fila.addEventListener("click", function() {
                    // Obtener los datos de la fila seleccionada
                    const nombre = this.cells[0].innerText;
                    const serie = this.cells[1].innerText;

                    // Mostrar los datos en los campos de entrada de texto
                    
                    document.getElementById("serie_borrar").value = serie; //este sirve para el apartado de borrar equipo
                    document.getElementById("ac_nombre").value = nombre; //este sirve para el apartado de actualizar equipo
                    document.getElementById("ac_serie").value = serie; //este sirve para el apartado de actualizar equipo
                    document.getElementById("nombre").value = nombre;
                    document.getElementById("serie").value = serie;


                    

                });
            });
        };



    </script>
    
    
    <!---Script que captura datos en ACTUALIZAR--->
    
    <script>
                document.addEventListener("DOMContentLoaded", function() {
                const campoTexto = document.getElementById("campoTexto");
                const contenedorOpciones = document.getElementById("opciones");

                campoTexto.addEventListener("input", function() {
                    const valorTexto = campoTexto.value;

                    // Realizar una petición al servidor para obtener las opciones
                    fetch(`obtener_usuarios.php?texto=${valorTexto}`)
                        .then(response => response.json())
                        .then(data => {
                            // Limpiar opciones anteriores
                            contenedorOpciones.innerHTML = "";

                            // Mostrar las nuevas opciones
                            data.forEach(usuario => {
                                const option = document.createElement("div");
                                option.textContent = usuario;
                                option.classList.add("opcion-usuario");
                                option.addEventListener("click", function() {
                                    campoTexto.value = usuario;
                                    contenedorOpciones.innerHTML = "";
                                });
                                contenedorOpciones.appendChild(option);
                            });
                        })
                        .catch(error => console.error("Error al obtener opciones:", error));
                });

                // Cerrar las opciones si se hace clic fuera del campo de texto o las opciones
                document.addEventListener("click", function(event) {
                    if (!event.target.matches("#campoTexto") && !event.target.matches(".opcion-usuario")) {
                        contenedorOpciones.innerHTML = "";
                    }
                });
            });

    </script>





</html>