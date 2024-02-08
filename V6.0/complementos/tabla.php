
<!--------------------------->  


<button id="mostrarBusqueda" class="btn btn-outline-dark">BUSCAR</button>

<div id="busqueda" style="display: none; ">
    <form method="GET">
        <input type="text" name="filtro" placeholder="Buscar por Serie o Nombre" class="texto_busqueda">
        <button type="submit" class="btn btn-outline-dark">Buscar</button>
    </form>
</div>

<table id='tabladatos' class="table table-striped table-hover tabla_espacio">
        <thead>
                    <tr>
                        <th>Tipo de Acta</th>
                        <th>Fecha de entrega</th>
                        <th>Fecha de acta firmada</th>
                        <th>Días de firma de acta</th>
                        <th>Estado del Acta</th>
                        <th>Comentarios</th>
                        <th>Hostname</th>
                        <th>Serie</th>
                        <th>Disco</th>
                        <th>Memoria ram</th>
                        <th>Cod inventario</th>
                        <th>Fecha de compra</th>
                        <th>Factura de compra</th>
                        <th>Proveedor</th>
                        <th>Piso</th>
                        <th>Tipo Equipo</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Jefatura</th>
                        <th>Puesto</th>
                        <th>Ubicacion fisica</th>
                        <th>Usuario Responsable</th>
                        <th>Usuario Anterior</th>
                        <th>Estado Equipo</th>
                        <th>Delegacion</th>
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
            $filtro = '';

            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['filtro']) && !empty(trim($_GET['filtro']))) {
                $filtro = $_GET['filtro'];
            }

            $pageSize = 5;
            $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($pageNumber - 1) * $pageSize;

            // Consulta SQL sin filtro
            $sql = "SELECT COUNT(*) OVER() AS TotalRows,
            TA.tipo_acta, E.fecha_entrega_equipo, E.fecha_firma_ac_entrega, E.dias_ac_firma_entrega, EAC.estado_acta, E.comentarios,E.comentarios, ES.estado_equipo, DE.delegacion, SD.sede, PSO.piso, G.gerencia, 
            SG.subgerencia, JF.jefatura, PU.puesto, UF.ubicacion_fisica,UA.usuario_anterior, U.usuario_responsable, E.nombre,TE.tipo_equipo, MA.marca, MO.modelo, DIS.disco, MRAM.memoria_ram, E.serie, E.cod_inventario,
            E.fecha_compra, E.factura_compra, pre.proveedor
            from Equipo E inner join Estados_del_equipo ES on e.estado_equipo = ES.id inner join Tipo_equipo TE  on e.estado_equipo=TE.id inner join Sede SD on E.sede = SD.id inner join Gerencia G on E.gerencia = G.id 
            inner join subgerencia SG on E.subgerencia = SG.id inner join usuario_responsable U on E.usuario_responsable = U.id inner join usuario_anterior UA on E.usuario_anterior = UA.id inner join tipo_acta TA on 
            E.tipo_acta = TA.id inner join estado_acta EAC on E.estado_acta = EAC.id inner join delegacion DE on E.delegacion = DE.id inner join piso PSO on E.piso = PSO.id inner join jefatura JF on E.jefatura = JF.id 
            inner join puesto PU on E.puesto = PU.id inner join ubicacion_fisica UF on E.ubicacion_fisica = UF.id inner join marca MA on E.marca = MA.id inner join modelo MO on E.modelo = MO.id inner join disco DIS on 
            E.disco = DIS.id inner join memoria_ram MRAM on E.memoria_ram = MRAM.id inner join proveedor pre on E.proveedor = pre.id
            ORDER BY usuario_responsable OFFSET $offset ROWS FETCH NEXT $pageSize ROWS ONLY";

            if (!empty($filtro)) {
                // Si se ha enviado el formulario con el filtro, se agrega la cláusula WHERE para filtrar por Serie o Nombre
                $filtroSeguro = '%' . $filtro . '%';

                $sql = "SELECT COUNT(*) OVER() AS TotalRows,
                TA.tipo_acta, E.fecha_entrega_equipo, E.fecha_firma_ac_entrega, E.dias_ac_firma_entrega, EAC.estado_acta, E.comentarios,E.comentarios, ES.estado_equipo, DE.delegacion, SD.sede, PSO.piso, G.gerencia, 
                SG.subgerencia, JF.jefatura, PU.puesto, UF.ubicacion_fisica,UA.usuario_anterior, U.usuario_responsable, E.nombre,TE.tipo_equipo, MA.marca, MO.modelo, DIS.disco, MRAM.memoria_ram, E.serie, E.cod_inventario,
                E.fecha_compra, E.factura_compra, pre.proveedor
                from Equipo E inner join Estados_del_equipo ES on e.estado_equipo = ES.id inner join Tipo_equipo TE  on e.estado_equipo=TE.id inner join Sede SD on E.sede = SD.id inner join Gerencia G on E.gerencia = G.id 
                inner join subgerencia SG on E.subgerencia = SG.id inner join usuario_responsable U on E.usuario_responsable = U.id inner join usuario_anterior UA on E.usuario_anterior = UA.id inner join tipo_acta TA on 
                E.tipo_acta = TA.id inner join estado_acta EAC on E.estado_acta = EAC.id inner join delegacion DE on E.delegacion = DE.id inner join piso PSO on E.piso = PSO.id inner join jefatura JF on E.jefatura = JF.id 
                inner join puesto PU on E.puesto = PU.id inner join ubicacion_fisica UF on E.ubicacion_fisica = UF.id inner join marca MA on E.marca = MA.id inner join modelo MO on E.modelo = MO.id inner join disco DIS on 
                E.disco = DIS.id inner join memoria_ram MRAM on E.memoria_ram = MRAM.id inner join proveedor pre on E.proveedor = pre.id
                WHERE E.serie LIKE '%$filtro%' OR E.nombre LIKE  '%$filtro%'
                ORDER BY usuario_responsable OFFSET $offset ROWS FETCH NEXT $pageSize ROWS ONLY";
                            }

                            // Ejecutar la consulta
                            $query = sqlsrv_query($conn, $sql);

                            // Obtener el número total de filas
                            if ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
                                $totalRows = $row['TotalRows'];
                                // Calcular el número total de páginas
                                $totalPages = ceil($totalRows / $pageSize);
                                $_SESSION['totalPages'] = $totalPages;
                            }
            
            
                            $stmt = sqlsrv_prepare($conn, $sql);
            
            
                            if ($stmt === false) {
                                die(print_r(sqlsrv_errors(), true));
            
                            }
                            
                            if (sqlsrv_execute($stmt) === false) {
                                die(print_r(sqlsrv_errors(), true));
                            }
                            
            
                            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td>" . $row['tipo_acta'] . "</td>";
                                 
                                // Formatear la fecha antes de mostrarla
                                $fecha_entrega = $row['fecha_entrega_equipo']->format('Y-m-d');

                                echo "<td>" . $fecha_entrega . "</td>";

                                // Formatear la fecha antes de mostrarla
                                $fecha_entrega_acta = $row['fecha_firma_ac_entrega']->format('Y-m-d');
                                echo "<td>" . $fecha_entrega_acta . "</td>";

                                echo "<td>" . $row['dias_ac_firma_entrega'] . "</td>";
                                echo "<td>" . $row['estado_acta'] . "</td>";
                                echo "<td>" . $row['comentarios'] . "</td>";
                                echo "<td>" . $row['nombre'] . "</td>";
                                echo "<td>" . $row['serie'] . "</td>";
                                echo "<td>" . $row['disco'] . "</td>";
                                echo "<td>" . $row['memoria_ram'] . "</td>";
                                echo "<td>" . $row['cod_inventario'] . "</td>";

                                // Formatear la fecha antes de mostrarla
                                $fecha_compra = $row['fecha_compra']->format('Y-m-d');
                                echo "<td>" . $fecha_compra . "</td>";

                                echo "<td>" . $row['factura_compra'] . "</td>";
                                echo "<td>" . $row['proveedor'] . "</td>";
                                echo "<td>" . $row['piso'] . "</td>";
                                echo "<td>" . $row['tipo_equipo'] . "</td>";
                                echo "<td>" . $row['marca'] . "</td>";
                                echo "<td>" . $row['modelo'] . "</td>";
                                echo "<td>" . $row['jefatura'] . "</td>";
                                echo "<td>" . $row['puesto'] . "</td>";
                                echo "<td>" . $row['ubicacion_fisica'] . "</td>";
                                echo "<td>" . $row['usuario_responsable'] . "</td>";
                                echo "<td>" . $row['usuario_anterior'] . "</td>";
                                echo "<td>" . $row['estado_equipo'] . "</td>";
                                echo "<td>" . $row['delegacion'] . "</td>";
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

<script>
    document.getElementById('mostrarBusqueda').addEventListener('click', function() {
        document.getElementById('busqueda').style.display = 'block';
    });
</script>

