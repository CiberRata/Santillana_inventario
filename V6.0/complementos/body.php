<div class="container mt-4">
    <h1>Insertar Equipo</h1>
    <form  id="miFormulario" action="insertar_equipo" method="post">
        <div class="form-group row align-items-start">       
        <label for="nombre">Tipo de acta:</label>   
        <select  class="form-control" id="tipo_acta" name="tipo_acta">
        <option value="">--Seleccione--</option>
            <?php
           
            // Establecer la conexión
            $conn = sqlsrv_connect($serverName, $connectionOptions);

            if ($conn) {
                // Consulta para obtener los datos de la tabla de equipos
                $query = "Select * from tipo_acta"; // Reemplaza con tu consulta SQL

                // Ejecutar la consulta
                $result = sqlsrv_query($conn, $query);

                if ($result !== false) {
                    // Recorrer los resultados y mostrar opciones en el combobox
                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        echo '<option value="' . $row['id'] . '">' . $row['tipo_acta'] . '</option>';
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
            
        <label for="fecha">Fecha entrega:</label>
        <input type="date" id="fecha_entrega_equipo" name="fecha_entrega_equipo">

        <label for="fecha">Fecha de firma de la acta de entrega:</label>
        <input type="date" id="fecha_firma_ac_entrega" name="fecha_firma_ac_entrega">

        <label for="estado_acta">Estado del cta:</label>
        <select class="form-control" id="estado_acta" name="estado_acta">
        <option value="">--Seleccione--</option>
            <?php
           
            // Establecer la conexión
            $conn = sqlsrv_connect($serverName, $connectionOptions);

            if ($conn) {
                // Consulta para obtener los datos de la tabla de equipos
                $query = "Select * from estado_acta"; // Reemplaza con tu consulta SQL

                // Ejecutar la consulta
                $result = sqlsrv_query($conn, $query);

                if ($result !== false) {
                    // Recorrer los resultados y mostrar opciones en el combobox
                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        echo '<option value="' . $row['id'] . '">' . $row['estado_acta'] . '</option>';
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

        <label for="comentarios">Comentarios:</label>
        <input type="text" id="comentarios" name="comentarios" required><br><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="serie">Serie:</label>
        
        <input type="text" id="serie" name="serie" required><br><br>


        <label for="disco">Disco:</label>
        <select class="form-control" id="disco" name="disco">
        <option value="">--Seleccione--</option>
            <?php
           
            // Establecer la conexión
            $conn = sqlsrv_connect($serverName, $connectionOptions);

            if ($conn) {
                // Consulta para obtener los datos de la tabla de equipos
                $query = "Select * from disco"; // Reemplaza con tu consulta SQL

                // Ejecutar la consulta
                $result = sqlsrv_query($conn, $query);

                if ($result !== false) {
                    // Recorrer los resultados y mostrar opciones en el combobox
                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        echo '<option value="' . $row['id'] . '">' . $row['disco'] . '</option>';
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


        <label for="memoria_ram">memoria_ram:</label>
        <select class="form-control" id="memoria_ram" name="memoria_ram">
        <option value="">--Seleccione--</option>
            <?php
           
            // Establecer la conexión
            $conn = sqlsrv_connect($serverName, $connectionOptions);

            if ($conn) {
                // Consulta para obtener los datos de la tabla de equipos
                $query = "Select * from memoria_ram"; // Reemplaza con tu consulta SQL

                // Ejecutar la consulta
                $result = sqlsrv_query($conn, $query);

                if ($result !== false) {
                    // Recorrer los resultados y mostrar opciones en el combobox
                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        echo '<option value="' . $row['id'] . '">' . $row['memoria_ram'] . '</option>';
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

        <label for="cod_inventario">cod inventario:</label>
        <input type="text" id="cod_inventario" name="cod_inventario" required><br><br>

        <label for="fecha">Fecha de compra:</label>
        <input type="date" id="fecha_compra" name="fecha_compra">    

        <label for="nombre">Factura de compra:</label>
        <input type="text" id="factura_compra" name="factura_compra" required><br><br>


        <label for="proveedor">Proveedor:</label>
        <select  class="form-control" id="proveedor" name="proveedor">
        <option value="">--Seleccione--</option>
            <?php
           
            // Establecer la conexión
            $conn = sqlsrv_connect($serverName, $connectionOptions);

            if ($conn) {
                // Consulta para obtener los datos de la tabla de equipos
                $query = "Select * from proveedor"; // Reemplaza con tu consulta SQL

                // Ejecutar la consulta
                $result = sqlsrv_query($conn, $query);

                if ($result !== false) {
                    // Recorrer los resultados y mostrar opciones en el combobox
                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        echo '<option value="' . $row['id'] . '">' . $row['proveedor'] . '</option>';
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


        <label for="piso">piso:</label>
        <select  class="form-control" id="piso" name="piso">
        <option value="">--Seleccione--</option>
            <?php
           
            // Establecer la conexión
            $conn = sqlsrv_connect($serverName, $connectionOptions);

            if ($conn) {
                // Consulta para obtener los datos de la tabla de equipos
                $query = "Select * from piso"; // Reemplaza con tu consulta SQL

                // Ejecutar la consulta
                $result = sqlsrv_query($conn, $query);

                if ($result !== false) {
                    // Recorrer los resultados y mostrar opciones en el combobox
                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        echo '<option value="' . $row['id'] . '">' . $row['piso'] . '</option>';
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


        <label for="marca">Marca del equipo:</label>
        <select class="form-control" id="marca" name="marca">
        <option value="">--Seleccione--</option>
            <?php
           
            // Establecer la conexión
            $conn = sqlsrv_connect($serverName, $connectionOptions);

            if ($conn) {
                // Consulta para obtener los datos de la tabla de equipos
                $query = "Select * from marca"; // Reemplaza con tu consulta SQL

                // Ejecutar la consulta
                $result = sqlsrv_query($conn, $query);

                if ($result !== false) {
                    // Recorrer los resultados y mostrar opciones en el combobox
                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        echo '<option value="' . $row['id'] . '">' . $row['marca'] . '</option>';
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

        <label for="modelo">Modelo del equipo:</label>
        <select class="form-control" id="modelo" name="modelo">
        <option value="">--Seleccione--</option>
            <?php
           
            // Establecer la conexión
            $conn = sqlsrv_connect($serverName, $connectionOptions);

            if ($conn) {
                // Consulta para obtener los datos de la tabla de equipos
                $query = "Select * from modelo"; // Reemplaza con tu consulta SQL

                // Ejecutar la consulta
                $result = sqlsrv_query($conn, $query);

                if ($result !== false) {
                    // Recorrer los resultados y mostrar opciones en el combobox
                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        echo '<option value="' . $row['id'] . '">' . $row['modelo'] . '</option>';
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

        <label for="jefatura">jefatura:</label>
        <select class="form-control" id="jefatura" name="jefatura">
        <option value="">--Seleccione--</option>
            <?php
           
            // Establecer la conexión
            $conn = sqlsrv_connect($serverName, $connectionOptions);

            if ($conn) {
                // Consulta para obtener los datos de la tabla de equipos
                $query = "Select * from jefatura"; // Reemplaza con tu consulta SQL

                // Ejecutar la consulta
                $result = sqlsrv_query($conn, $query);

                if ($result !== false) {
                    // Recorrer los resultados y mostrar opciones en el combobox
                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        echo '<option value="' . $row['id'] . '">' . $row['jefatura'] . '</option>';
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

        <label for="puesto">Puesto:</label>
        <select class="form-control" id="puesto" name="puesto">
        <option value="">--Seleccione--</option>
            <?php
           
            // Establecer la conexión
            $conn = sqlsrv_connect($serverName, $connectionOptions);

            if ($conn) {
                // Consulta para obtener los datos de la tabla de equipos
                $query = "Select * from puesto"; // Reemplaza con tu consulta SQL

                // Ejecutar la consulta
                $result = sqlsrv_query($conn, $query);

                if ($result !== false) {
                    // Recorrer los resultados y mostrar opciones en el combobox
                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        echo '<option value="' . $row['id'] . '">' . $row['puesto'] . '</option>';
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


        <label for="ubicacion">Ubicacion_fisica:</label>
        <select class="form-control" id="ubicacion_fisica" name="ubicacion_fisica">
        <option value="">--Seleccione--</option>
            <?php
           
            // Establecer la conexión
            $conn = sqlsrv_connect($serverName, $connectionOptions);

            if ($conn) {
                // Consulta para obtener los datos de la tabla de equipos
                $query = "Select * from ubicacion_fisica"; // Reemplaza con tu consulta SQL

                // Ejecutar la consulta
                $result = sqlsrv_query($conn, $query);

                if ($result !== false) {
                    // Recorrer los resultados y mostrar opciones en el combobox
                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        echo '<option value="' . $row['id'] . '">' . $row['ubicacion_fisica'] . '</option>';
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

        <label for="delegacion">Delegacion:</label>
        <select class="form-control" id="delegacion" name="delegacion">
        <option value="">--Seleccione--</option>
            <?php
           
            // Establecer la conexión
            $conn = sqlsrv_connect($serverName, $connectionOptions);

            if ($conn) {
                // Consulta para obtener los datos de la tabla de equipos
                $query = "Select * from delegacion"; // Reemplaza con tu consulta SQL

                // Ejecutar la consulta
                $result = sqlsrv_query($conn, $query);

                if ($result !== false) {
                    // Recorrer los resultados y mostrar opciones en el combobox
                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        echo '<option value="' . $row['id'] . '">' . $row['delegacion'] . '</option>';
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
        <input type="submit" value="Insertar Equipo" class="btn btn-outline-success boton_enviar">
      
    </form>

</div>   