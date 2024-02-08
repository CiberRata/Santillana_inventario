<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventana Principal</title>
</head>
<body>

<?php
include('configuracion/conexionsql.php');


// Establecer la conexión
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn) {
    echo "Conexión establecida.<br>";

    // Definir el nombre del procedimiento almacenado
    $procedureName = "SP_VerListaInventario";

    // Preparar la llamada al procedimiento almacenado
    $sql = "{call $procedureName}";

    // Preparar la consulta
    $stmt = sqlsrv_prepare($conn, $sql);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true)); // Manejo de errores si la preparación falla
    }

    // Ejecutar el procedimiento almacenado
    if (sqlsrv_execute($stmt) === false) {
        die(print_r(sqlsrv_errors(), true)); // Manejo de errores si la ejecución falla
    }

    // Recuperar resultados si hay algún resultado esperado

    // Liberar recursos
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
} else {
    echo "No se pudo establecer la conexión.<br>";
    die(print_r(sqlsrv_errors(), true)); // Manejo de errores si la conexión falla
}

?>

<!--se realiza el html-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tabla de Datos</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Tabla de Datos</h1>
    <table id='tabladatos'>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Serie</th>
                <th>Usuario Responsable</th>
                <th>Usuario Anterior</th>
                <th>Estado Equipo</th>
                <th>Tipo Equipo</th>
                <th>Sede</th>
                <th>Gerencia</th>
                <th>Subgerencia</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('configuracion/conexionsql.php');
            $conn = sqlsrv_connect($serverName, $connectionOptions);

            if ($conn) {
                $sql = "{call SP_VerListaInventario}";

                $stmt = sqlsrv_prepare($conn, $sql);

                if ($stmt === false) {
                    die(print_r(sqlsrv_errors(), true));
                }

                if (sqlsrv_execute($stmt) === false) {
                    die(print_r(sqlsrv_errors(), true));
                }

                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['nombre'] . "</td>";
                    echo "<td>" . $row['serie'] . "</td>";
                    echo "<td>" . $row['usuario_responsable'] . "</td>";
                    echo "<td>" . $row['usuario_anterior'] . "</td>";
                    echo "<td>" . $row['estado_equipo'] . "</td>";
                    echo "<td>" . $row['tipo_equipo'] . "</td>";
                    echo "<td>" . $row['sede'] . "</td>";
                    echo "<td>" . $row['gerencia'] . "</td>";
                    echo "<td>" . $row['subgerencia'] . "</td>";
                    echo "</tr>";
                }

                sqlsrv_free_stmt($stmt);
                sqlsrv_close($conn);
            } else {
                echo "No se pudo establecer la conexión.";
                die(print_r(sqlsrv_errors(), true));
            }
            ?>
        </tbody>
    </table>
</body>
</html>



<!--script para html de insertar-->


    <h1>Insertar Equipo</h1>
    <form action="insertar_equipo.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="serie">Serie:</label>
        <input type="text" id="serie" name="serie" required><br><br>



        <label for="usuario_responsable">Usuario Responsable:</label>
        <select id="usuario_responsable" name="usuario_responsable">
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
        <select id="usuario_anterior" name="usuario_anterior">
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
        <select id="estado_equipo" name="estado_equipo">
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
        <select id="tipo_equipo" name="tipo_equipo">
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
        <select id="sede" name="sede">
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
        <select id="gerencia" name="gerencia">
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
        <select id="subgerencia" name="subgerencia">
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

        <input type="submit" value="Insertar Equipo">
    </form>


    <!---Para borrar un equipo seleccionando--->

    <h1>Borrar Equipo - Seleccionando</h1>
    <form action="borrar_equipo.php"  method="post">

        <label for="inputSerie">Número de Serie a Borrar:</label>
        <input type="text" id="serie_borrar" name="serie_borrar"><br><br>
        <input type="submit" value="Borrar Equipo">
        <!-- Agrega más campos según tus necesidades -->
    </form>


    <!------Para actualizar----->
    <h1>Actualizar Equipo</h1>
    <form action="actualizar_equipo.php" method="post">
    <label for="nombre">Nombre:</label>
        <input type="text" id="ac_nombre" name="ac_nombre" required><br><br>

        <label for="serie">Serie:</label>
        <input type="text" id="ac_serie" name="ac_serie" required><br><br>



        <label for="usuario_responsable">Usuario Responsable:</label>
        <select id="ac_usuario_responsable" name="ac_usuario_responsable">
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
        <select id="ac_usuario_anterior" name="ac_usuario_anterior">
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
        <select id="estado_equipo" name="estado_equipo">
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
        <select id="tipo_equipo" name="tipo_equipo">
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
        <select id="sede" name="sede">
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
        <select id="gerencia" name="gerencia">
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
        <select id="subgerencia1" name="subgerencia">
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

        <input type="submit" value="Insertar Equipo">
    </form>
</body>


    <!---Script que captura datos en INSERTAR--->

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
    
    
    <!---Script que captura datos en ACTUALIZAR--->
    
    



</html>