<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Bootstrap CSS-->
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous"> Anterior-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style.css">
    <!--  Datatables  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>  
    <!--  Datatables Responsive  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    <title>Listado</title>
</head>
<body>

<?php
    //$cantidad= 0;
    include('C:/xampp/htdocs/configuracion/conexionsql.php');

    include 'insertar_server.php';
    

    /*TEST SQL SERVER*/

    /*
    $nombreServidor = "localhost\SQLEXPRESS";
    $usuario = "sa";
    $contrasena = "Giovanni23**";
    $nombreBaseDatos = "DB_Servidores";

    try {

        $conn2 = new PDO("sqlsrv:server=$nombreServidor;database=$nombreBaseDatos", $usuario, $contrasena);

        //echo "Conexion exitosa en el servidor $nombreServidor";
        
    } catch (Exception $e) {
        echo "Ocurrió un error en la conexion. " .$e->getMessage();
    }


    $cantidad = 0;
    $query = "SELECT * FROM V_mostrar_servidores";
    $stmt = $conn2->query($query);
    $registros = $stmt->fetchAll(PDO::FETCH_OBJ);

    */


    /* Para mostrar los servidores */

    try {
        $query = "SELECT * FROM V_MOSTRAR_SERVIDORES";
	    $resultado = $conn->query($query);
    } catch(PDOException $ex) {
        echo "Ocurrió un error<br>";
        echo $ex->getMessage();
        exit;
    }

    /* Para crear el paginado */

    try {

        $productosPorPagina = 10;
        $pagina = 1;
        if (isset($_GET["pagina"])) {
            $pagina = $_GET["pagina"];
        }
        
        # El límite es el número de productos por página
        $limit = $productosPorPagina;
        # El offset es saltar X productos que viene dado por multiplicar la página - 1 * los productos por página
        $offset = ($pagina - 1) * $productosPorPagina;

        $sentencia = $conn->query("SELECT count(*) AS conteo FROM V_MOSTRAR_SERVIDORES");
        $conteo = $sentencia->fetchObject()->conteo;
        $paginas = ceil($conteo / $productosPorPagina);

        $sentencia = $conn->prepare("SELECT * FROM V_MOSTRAR_SERVIDORES LIMIT ? OFFSET ?");
        $sentencia->execute([$limit, $offset]);
        $obj = $sentencia->fetchAll(PDO::FETCH_OBJ);
        
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage(), "\n";
    }



?>


    


    

            <h1 class="text-center">Listado de Servidores</h1>
            <a href="\insertar_server.php">Insertar_prueba</a>

    <section class="Centrar-tabla">                  

                        <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-12">
                                        <table id="registros" class="table table-border table-hover" cellspacing="0">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>ID2</th>
                                                <th>IP</th>
                                                <th>Nombre</th>
                                                <th>Discos</th>
                                                <th>RAM</th>
                                                <th>Espacio Total</th>
                                                <th>Espacio Usado</th>
                                                <th>Espacio Libre</th>
                                                <th>Unidad</th>
                                                <th>Comentarios</th>

                                            </tr>
                                            </thead>


                                            <tbody>
                                                <?php  foreach ($obj as $ob) { ?> 
                                                    <tr>
                                                        
                                                        <td><?php echo $ob->id_servidor; ?></td>
                                                        <td><?php echo $ob->id_detalle_servidor; ?></td>
                                                        <td><?php echo $ob->IP_servidor; ?></td>
                                                        <td><?php echo $ob->nombre_dns_servidor; ?></td>
                                                        <td><?php echo $ob->cantidad_discos_detalle_servidor; ?></td>
                                                        <td><?php echo $ob->total_espacio_servidor; ?></td>
                                                        <td><?php echo $ob->total_usado_servidor; ?></td>
                                                        <td><?php echo $ob->total_libre; ?></td>
                                                        <td><?php echo $ob->nombre_unidad; ?></td>
                                                        <td><?php echo $ob->comentarios;?></td>
                                                    </tr> 
                                            </tbody>




                                                
                                            <!--
                                            <tbody>
                                                <?php /* WHILE($obj = $resultado->fetch_assoc()) { */?>
                                                    <tr>
                                                        
                                                        <td><?php /* echo $obj['id_servidor'] ?></td>
                                                        <td><?php echo $obj['id_detalle_servidor'] ?></td>
                                                        <td><?php echo $obj['IP_servidor'] ?></td>
                                                        <td><?php echo $obj['nombre_dns_servidor'] ?></td>
                                                        <td><?php echo $obj['cantidad_discos_detalle_servidor']?></td>
                                                        <td><?php echo $obj['memoria_ram_detalle_servidor'] ?></td>
                                                        <td><?php echo $obj['total_espacio_servidor'] ?></td>
                                                        <td><?php echo $obj['total_usado_servidor'] ?></td>
                                                        <td><?php echo $obj['total_libre'] ?></td>
                                                        <td><?php echo $obj['nombre_unidad'] ?></td>
                                                        <td><?php echo $obj['comentarios']; */?></td> 
                                                    </tr> 
                                            </tbody>

                                            -->

                                            <?php
                                                }
                                            ?>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>


                                        <!-- Plantilla sin estilo 
                                        <nav > 
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-6">

                                                    <p>Mostrando <?php echo $productosPorPagina ?> de <?php echo $conteo ?> productos disponibles</p>
                                                </div>
                                                <div class="col-xs-12 col-sm-6">
                                                    <p>Página <?php echo $pagina ?> de <?php echo $paginas ?> </p>
                                                </div>
                                            </div>

                                            <ul class="pagination">
                                            Si la página actual es mayor a uno, mostramos el botón para ir una página atrás -->
                                                <?php if ($pagina > 1) { ?>
                                                    <!--<li>
                                                        <a href="./index.php?pagina=<?php echo $pagina - 1 ?>">
                                                            <span aria-hidden="true">&laquo;</span>
                                                        </a>
                                                    </li> -->
                                                <?php } ?>

                                                <!-- Mostramos enlaces para ir a todas las páginas. Es un simple ciclo for-->
                                                <?php for ($x = 1; $x <= $paginas; $x++) { ?>
                                                    <!--<li class="<?php if ($x == $pagina) echo "active" ?>">
                                                        <a href="./index.php?pagina=<?php echo $x ?>">
                                                            <?php echo $x ?></a>
                                                    </li>-->
                                                <?php } ?>
                                                <!-- Si la página actual es menor al total de páginas, mostramos un botón para ir una página adelante -->
                                                <?php if ($pagina < $paginas) { ?>
                                                    <!-- <li>
                                                        <a href="./index.php?pagina=<?php echo $pagina + 1 ?>">
                                                            <span aria-hidden="true">&raquo;</span>
                                                        </a>
                                                    </li>-->
                                                <?php } ?>
                                            </ul>

                                        </nav>


                                        <nav aria-label="...">
                                        <div class="row">
                                                <div class="col-xs-12 col-sm-6">

                                                    <p>Mostrando <?php echo $productosPorPagina ?> de <?php echo $conteo ?> productos disponibles</p>
                                                </div>
                                                <div class="col-xs-12 col-sm-6">
                                                    <p>Página <?php echo $pagina ?> de <?php echo $paginas ?> </p>
                                                </div>
                                            </div>

                                        <ul class="pagination">
                                                <?php if ($pagina > 1) { ?>
                                                    <li class="page-item disabled">
                                                        <a href="./index.php?pagina=<?php echo $pagina - 1 ?>">
                                                            <span aria-hidden="true" class="page-link">&laquo;</span>
                                                        </a>
                                                    </li>
                                                <?php } ?>

                                                    
                                                <?php for ($x = 1; $x <= $paginas; $x++) { ?>
                                                    <li class="<?php if ($x == $pagina) echo "page-item active" ?>">
                                                        <a class="page-link" href="./index.php?pagina=<?php echo $x ?>">
                                                            <?php echo $x ?></a>
                                                    </li>
                                                <?php } ?>

                                                <?php if ($pagina < $paginas) { ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="./index.php?pagina=<?php echo $pagina + 1 ?>">
                                                            <span  aria-hidden="true">&raquo;</span>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>

                            
                                        </nav>

                                    </div>
                                </div>
                            </div>
                                    

                            <!--
                            <h1 class="text-center">Listado de Personas</h1>

                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table id="registros" class="table table-border table-hover" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>ID2</th>
                                                <th>IP</th>
                                                <th>Nombre</th>
                                                <th>Fecha</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php //foreach($registros as $fila) : ?>
                                                <?php //$cantidad = $cantidad + 1 ?>
                                                    <tr>
                                                        <td><?php //echo $cantidad; ?></td>
                                                        <td><?php //echo $fila->nombres; ?></td>
                                                        <td><?php //echo $fila->dni; ?></td>
                                                        <td><?php //echo $fila->direccion; ?></td>
                                                        <td><?php //echo $fila->fecha; ?></td>
                                                    </tr>
                                                <?php //endforeach; ?>    
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            --->               



    </section>







                <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
                <!-- Datatables-->
                <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>  
                <!-- Datatables responsive -->
                <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>


    
</body>
</html>