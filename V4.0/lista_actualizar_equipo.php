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

<div class="container mt-4">
    


    <!---Para borrar un equipo seleccionando--->




    <!------Para actualizar----->
    <h1>Actualizar Equipo</h1>
    
    <form action="actualizar_equipo.php" method="post">
    <div class="form-group row align-items-start">   
    <label for="nombre">Nombre:</label>
        <input type="text" id="ac_nombre" name="ac_nombre" required><br><br>

        <label for="serie">Serie:</label>
        <input type="text" id="ac_serie" name="ac_serie" required><br><br>



        <label for="usuario_responsable">Usuario Responsable:</label>
        <select class="form-control" id="ac_usuario_responsable" name="ac_usuario_responsable">
        <option value="">--Seleccione--</option>
            <?php
           
            // Establecer la conexión
            $conn = sqlsrv_connect($serverName, $connectionOptions);

            if ($conn) {
                // Consulta para obtener los datos de la tabla de equipos
                $query = "Select * from usuario_responsable"; // Reemplaza con tu consulta SQL

                // Ejecutar la consulta
                $result = sqlsrv_query($conn, $query);

                if ($result !== false) {
                    // Recorrer los resultados y mostrar opciones en el combobox
                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        echo '<option value="' . $row['id'] . '">' . $row['usuario_responsable'] . '</option>';
                    }
                } else {
                    echo "Error al ejecutar la consulta.<br>";
                    die(print_r(sqlsrv_errors(), true)); // Manejo de errores si la consulta falla
                }

                // Liberar recursos
                sqlsrv_free_stmt($result);
                sqlsrv_close($conn);
            } else {
                echo "No se pudo establecer la conexión.<br>";
                die(print_r(sqlsrv_errors(), true)); // Manejo de errores si la conexión falla
            }
            ?>
        </select>
        <br><br>


        <label for="usuario_anterior">Usuario Anterior:</label>
        <select class="form-control" id="ac_usuario_anterior" name="ac_usuario_anterior">
        <option value="">--Seleccione--</option>
            <?php
            // Establecer la conexión
            $conn = sqlsrv_connect($serverName, $connectionOptions);
           
            if ($conn) {
                // Consulta para obtener los datos de la tabla de equipos
                $query = "Select * from usuario_anterior"; // Reemplaza con tu consulta SQL

                // Ejecutar la consulta
                $result = sqlsrv_query($conn, $query);

                if ($result !== false) {
                    // Recorrer los resultados y mostrar opciones en el combobox
                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        echo '<option value="' . $row['id'] . '">' . $row['usuario_anterior'] . '</option>';
                    }
                } else {
                    echo "Error al ejecutar la consulta.<br>";
                    die(print_r(sqlsrv_errors(), true)); // Manejo de errores si la consulta falla
                }

                // Liberar recursos
                sqlsrv_free_stmt($result);
                sqlsrv_close($conn);
            } else {
                echo "No se pudo establecer la conexión.<br>";
                die(print_r(sqlsrv_errors(), true)); // Manejo de errores si la conexión falla
            }
            ?>
        </select>
        <br><br>


        <label for="estado_equipo">Estado Equipo:</label>
        <select class="form-control" id="ac_estado_equipo" name="ac_estado_equipo">
        <option value="">--Seleccione--</option>
            <?php
           
            // Establecer la conexión
            $conn = sqlsrv_connect($serverName, $connectionOptions);

            if ($conn) {
                // Consulta para obtener los datos de la tabla de equipos
                $query = "Select * from Estados_del_equipo"; // Reemplaza con tu consulta SQL

                // Ejecutar la consulta
                $result = sqlsrv_query($conn, $query);

                if ($result !== false) {
                    // Recorrer los resultados y mostrar opciones en el combobox
                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        echo '<option value="' . $row['id'] . '">' . $row['estado_equipo'] . '</option>';
                    }
                } else {
                    echo "Error al ejecutar la consulta.<br>";
                    die(print_r(sqlsrv_errors(), true)); // Manejo de errores si la consulta falla
                }

                // Liberar recursos
                sqlsrv_free_stmt($result);
                sqlsrv_close($conn);
            } else {
                echo "No se pudo establecer la conexión.<br>";
                die(print_r(sqlsrv_errors(), true)); // Manejo de errores si la conexión falla
            }
            ?>
        </select>
        <br><br>




        <label for="tipo_equipo">Tipo de Equipo:</label>
        <select class="form-control" id="ac_tipo_equipo" name="ac_tipo_equipo">
        <option value="">--Seleccione--</option>
            <?php
           
            // Establecer la conexión
            $conn = sqlsrv_connect($serverName, $connectionOptions);

            if ($conn) {
                // Consulta para obtener los datos de la tabla de equipos
                $query = "Select * from tipo_equipo"; // Reemplaza con tu consulta SQL

                // Ejecutar la consulta
                $result = sqlsrv_query($conn, $query);

                if ($result !== false) {
                    // Recorrer los resultados y mostrar opciones en el combobox
                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        echo '<option value="' . $row['id'] . '">' . $row['tipo_equipo'] . '</option>';
                    }
                } else {
                    echo "Error al ejecutar la consulta.<br>";
                    die(print_r(sqlsrv_errors(), true)); // Manejo de errores si la consulta falla
                }

                // Liberar recursos
                sqlsrv_free_stmt($result);
                sqlsrv_close($conn);
            } else {
                echo "No se pudo establecer la conexión.<br>";
                die(print_r(sqlsrv_errors(), true)); // Manejo de errores si la conexión falla
            }
            ?>
        </select>
        <br><br>

        <label for="sede">Sede:</label>
        <select class="form-control" id="ac_sede" name="ac_sede">
        <option value="">--Seleccione--</option>
            <?php
           
            // Establecer la conexión
            $conn = sqlsrv_connect($serverName, $connectionOptions);

            if ($conn) {
                // Consulta para obtener los datos de la tabla de equipos
                $query = "Select * from sede"; // Reemplaza con tu consulta SQL

                // Ejecutar la consulta
                $result = sqlsrv_query($conn, $query);

                if ($result !== false) {
                    // Recorrer los resultados y mostrar opciones en el combobox
                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        echo '<option value="' . $row['id'] . '">' . $row['sede'] . '</option>';
                    }
                } else {
                    echo "Error al ejecutar la consulta.<br>";
                    die(print_r(sqlsrv_errors(), true)); // Manejo de errores si la consulta falla
                }

                // Liberar recursos
                sqlsrv_free_stmt($result);
                sqlsrv_close($conn);
            } else {
                echo "No se pudo establecer la conexión.<br>";
                die(print_r(sqlsrv_errors(), true)); // Manejo de errores si la conexión falla
            }
            ?>
        </select>
        <br><br>

        <label for="gerencia">Gerencia:</label>
        <select class="form-control" id="ac_gerencia" name="ac_gerencia">
        <option value="">--Seleccione--</option>
            <?php
           
            // Establecer la conexión
            $conn = sqlsrv_connect($serverName, $connectionOptions);

            if ($conn) {
                // Consulta para obtener los datos de la tabla de equipos
                $query = "Select * from gerencia"; // Reemplaza con tu consulta SQL

                // Ejecutar la consulta
                $result = sqlsrv_query($conn, $query);

                if ($result !== false) {
                    // Recorrer los resultados y mostrar opciones en el combobox
                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        echo '<option value="' . $row['id'] . '">' . $row['gerencia'] . '</option>';
                    }
                } else {
                    echo "Error al ejecutar la consulta.<br>";
                    die(print_r(sqlsrv_errors(), true)); // Manejo de errores si la consulta falla
                }

                // Liberar recursos
                sqlsrv_free_stmt($result);
                sqlsrv_close($conn);
            } else {
                echo "No se pudo establecer la conexión.<br>";
                die(print_r(sqlsrv_errors(), true)); // Manejo de errores si la conexión falla
            }
            ?>
        </select>
          
        <br><br>
        <!---Inicio de pruebas-->
        <label for="gerencia">SubGerencia:</label>   
        <select class="form-control" id="ac_subgerencia" name="ac_subgerencia">
            <option value="">--Seleccione--</option>
            <?php
           
            // Establecer la conexión
            $conn = sqlsrv_connect($serverName, $connectionOptions);

            if ($conn) {
                // Consulta para obtener los datos de la tabla de equipos
                $query = "Select * from subgerencia"; // Reemplaza con tu consulta SQL

                // Ejecutar la consulta
                $result = sqlsrv_query($conn, $query);

                if ($result !== false) {
                    // Recorrer los resultados y mostrar opciones en el combobox
                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        echo '<option value="' . $row['id'] . '">' . $row['subgerencia'] . '</option>';
                    }
                } else {
                    echo "Error al ejecutar la consulta.<br>";
                    die(print_r(sqlsrv_errors(), true)); // Manejo de errores si la consulta falla
                }

                // Liberar recursos
                sqlsrv_free_stmt($result);
                sqlsrv_close($conn);
            } else {
                echo "No se pudo establecer la conexión.<br>";
                die(print_r(sqlsrv_errors(), true)); // Manejo de errores si la conexión falla
            }
            ?>
        </select>


        <!---Fin de pruebas-->

        <br><br>
        </div>
        <input type="submit" class="btn btn-outline-success" value="Actualizar Equipo">
        </div>  
    </form>
</div>     
</body>






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
                    
                    document.getElementById("ac_nombre").value = nombre; //este sirve para el apartado de actualizar equipo
                    document.getElementById("ac_serie").value = serie; //este sirve para el apartado de actualizar equipo

                    

                });
            });
        };


            document.addEventListener("DOMContentLoaded", function() {
            const filasTabla = document.querySelectorAll("#tabladatos tbody tr");
            const usuario_responsable = document.getElementById("usuario_responsable");
            const usuario_anterior = document.getElementById("usuario_anterior");
            const estado_equipo = document.getElementById("estado_equipo");
            const tipo_equipo = document.getElementById("tipo_equipo");
            const sede = document.getElementById("sede");
            const gerencia = document.getElementById("gerencia");
            const subgerencia = document.getElementById("subgerencia");

            filasTabla.forEach(fila => {
                fila.addEventListener("click", function() {
                    const ures_texto = this.cells[2].innerText;
                    const uant_texto = this.cells[3].innerText;
                    const estad_texto = this.cells[4].innerText;
                    const tipo_texto = this.cells[5].innerText;
                    const sede_texto = this.cells[6].innerText;
                    const gerencia_texto = this.cells[7].innerText;
                    const subgerencia_texto = this.cells[8].innerText;


                    
                    for (let i = 0; i < ac_usuario_responsable.options.length; i++) {
                        if (ac_usuario_responsable.options[i].text === ures_texto) {
                            ac_usuario_responsable.value = ac_usuario_responsable.options[i].value;
                            break;
                        }
                    }



                    for (let i = 0; i < ac_usuario_anterior.options.length; i++) {
                        if (ac_usuario_anterior.options[i].text === uant_texto) {
                            ac_usuario_anterior.value = ac_usuario_anterior.options[i].value;
                            break;
                        }
                    }

                    for (let i = 0; i < ac_estado_equipo.options.length; i++) {
                        if (ac_estado_equipo.options[i].text === estad_texto) {
                            ac_estado_equipo.value = ac_estado_equipo.options[i].value;
                            break;
                        }
                    }

                    for (let i = 0; i < ac_tipo_equipo.options.length; i++) {
                        if (ac_tipo_equipo.options[i].text === tipo_texto) {
                            ac_tipo_equipo.value = ac_tipo_equipo.options[i].value;
                            break;
                        }
                    }

                    for (let i = 0; i < ac_sede.options.length; i++) {
                        if (ac_sede.options[i].text === sede_texto) {
                            ac_sede.value = ac_sede.options[i].value;
                            break;
                        }
                    }

                    for (let i = 0; i < ac_gerencia.options.length; i++) {
                        if (ac_gerencia.options[i].text === gerencia_texto) {
                            ac_gerencia.value = ac_gerencia.options[i].value;
                            break;
                        }
                    }

                    for (let i = 0; i < ac_subgerencia.options.length; i++) {
                        if (ac_subgerencia.options[i].text === subgerencia_texto) {
                            ac_subgerencia.value = ac_subgerencia.options[i].value;
                            break;
                        }
                    }
                    
                });
            });
        });

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