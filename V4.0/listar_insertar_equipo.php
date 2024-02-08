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
    <title>Insertar un nuevo Equipo</title>
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

    <!--Este se abre en titulo.php--></div>
</html>





<!--script para html de insertar-->

<div class="container mt-4">
    <h1>Insertar Equipo</h1>
    <form  id="miFormulario" action="insertar_equipo" method="post">
        <div class="form-group row align-items-start">       

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="serie">Serie:</label>
        
        <input type="text" id="serie" name="serie" required><br><br>

 
        <label for="usuario_responsable">Usuario Responsable:</label>
        <select  class="form-control" id="usuario_responsable" name="usuario_responsable">
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
        <select class="form-control" id="usuario_anterior" name="usuario_anterior">
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
        <select class="form-control" id="estado_equipo" name="estado_equipo">
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
        <select class="form-control" id="tipo_equipo" name="tipo_equipo">
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
        <select class="form-control" id="sede" name="sede">
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
        <select class="form-control" id="gerencia" name="gerencia">
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
        <select class="form-control" id="subgerencia" name="subgerencia">
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
        <input type="submit" value="Insertar Equipo" class="btn btn-outline-success">
      
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
                    

                    document.getElementById("nombre").value = nombre;
                    document.getElementById("serie").value = serie;


                    

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

                    for (let i = 0; i < usuario_responsable.options.length; i++) {
                        if (usuario_responsable.options[i].text === ures_texto) {
                            usuario_responsable.value = usuario_responsable.options[i].value;
                            break;
                        }
                    }
                    

                    for (let i = 0; i < usuario_anterior.options.length; i++) {
                        if (usuario_anterior.options[i].text === uant_texto) {
                            usuario_anterior.value = usuario_anterior.options[i].value;
                            break;
                        }
                    }

                    for (let i = 0; i < estado_equipo.options.length; i++) {
                        if (estado_equipo.options[i].text === estad_texto) {
                            estado_equipo.value = estado_equipo.options[i].value;
                            break;
                        }
                    }

                    for (let i = 0; i < tipo_equipo.options.length; i++) {
                        if (tipo_equipo.options[i].text === tipo_texto) {
                            tipo_equipo.value = tipo_equipo.options[i].value;
                            break;
                        }
                    }

                    for (let i = 0; i < sede.options.length; i++) {
                        if (sede.options[i].text === sede_texto) {
                            sede.value = sede.options[i].value;
                            break;
                        }
                    }

                    for (let i = 0; i < gerencia.options.length; i++) {
                        if (gerencia.options[i].text === gerencia_texto) {
                            gerencia.value = gerencia.options[i].value;
                            break;
                        }
                    }

                    for (let i = 0; i < subgerencia.options.length; i++) {
                        if (subgerencia.options[i].text === subgerencia_texto) {
                            subgerencia.value = subgerencia.options[i].value;
                            break;
                        }
                    }

                    
                });
            });
        });

    </script>
    
    





</html>

