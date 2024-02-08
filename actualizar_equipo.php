<?php
include('configuracion/conexionsql.php');

// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Obtener los datos del formulario
        $tipo_acta = $_POST["tipo_acta"];
        $fecha_entrega_equipo = $_POST["fecha_entrega_equipo"];
        $fecha_firma_ac_entrega = $_POST["fecha_firma_ac_entrega"];
        $dias_ac_firma_entrega = 0; // Inicializamos el parámetro de salida
        $estado_acta = $_POST["estado_acta"];
        $comentarios = $_POST["comentarios"];
        $estado_equipo = $_POST["estado_equipo"];
        $delegacion = $_POST["delegacion"];
        $sede = $_POST["sede"];
        $piso = $_POST["piso"];
        $gerencia = $_POST["gerencia"];
        $subgerencia = $_POST["subgerencia"];
        $jefatura = $_POST["jefatura"];
        $puesto = $_POST["puesto"];
        $ubicacion_fisica = $_POST["ubicacion_fisica"];
        $usuario_anterior = $_POST["usuario_anterior"];
        $usuario_responsable = $_POST["usuario_responsable"];
        $nombre = $_POST["nombre"];
        $tipo_equipo = $_POST["tipo_equipo"];
        $marca = $_POST["marca"];
        $modelo = $_POST["modelo"];
        $disco = $_POST["disco"];
        $memoria_ram = $_POST["memoria_ram"];
        $serie = $_POST["serie"];
        $cod_inventario = $_POST["cod_inventario"];
        $fecha_compra = $_POST["fecha_compra"];
        $factura_compra = $_POST["factura_compra"];
        $proveedor = $_POST["proveedor"];

        // Establecer la conexión
        $conn = sqlsrv_connect($serverName, $connectionOptions);

        if ($conn) {
            // Definir el nombre del procedimiento almacenado
            $procedureName = "{CALL SP_ActualizarEquipo(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)}";
            $stmt = sqlsrv_prepare($conn, $procedureName);

            // Parámetros del procedimiento almacenado
            $params = array(
                array(&$tipo_acta, SQLSRV_PARAM_IN),
                array(&$fecha_entrega_equipo, SQLSRV_PARAM_IN),
                array(&$fecha_firma_ac_entrega, SQLSRV_PARAM_IN),
                array(&$dias_ac_firma_entrega, SQLSRV_PARAM_OUT),
                array(&$estado_acta, SQLSRV_PARAM_IN),
                array(&$comentarios, SQLSRV_PARAM_IN),
                array(&$estado_equipo, SQLSRV_PARAM_IN),
                array(&$delegacion, SQLSRV_PARAM_IN),
                array(&$sede, SQLSRV_PARAM_IN),
                array(&$piso, SQLSRV_PARAM_IN),
                array(&$gerencia, SQLSRV_PARAM_IN),
                array(&$subgerencia, SQLSRV_PARAM_IN),
                array(&$jefatura, SQLSRV_PARAM_IN),
                array(&$puesto, SQLSRV_PARAM_IN),
                array(&$ubicacion_fisica, SQLSRV_PARAM_IN),
                array(&$usuario_anterior, SQLSRV_PARAM_IN),
                array(&$usuario_responsable, SQLSRV_PARAM_IN),
                array(&$nombre, SQLSRV_PARAM_IN),
                array(&$tipo_equipo, SQLSRV_PARAM_IN),
                array(&$marca, SQLSRV_PARAM_IN),
                array(&$modelo, SQLSRV_PARAM_IN),
                array(&$disco, SQLSRV_PARAM_IN),
                array(&$memoria_ram, SQLSRV_PARAM_IN),
                array(&$serie, SQLSRV_PARAM_IN),
                array(&$cod_inventario, SQLSRV_PARAM_IN),
                array(&$fecha_compra, SQLSRV_PARAM_IN),
                array(&$factura_compra, SQLSRV_PARAM_IN),
                array(&$proveedor, SQLSRV_PARAM_IN)
            );

            // Preparar la llamada al procedimiento almacenado
            $stmt = sqlsrv_prepare($conn, $procedureName, $params);

            if ($stmt === false) {
                throw new Exception(print_r(sqlsrv_errors(), true)); // Manejo de errores si la preparación falla
            }

            // Ejecutar el procedimiento almacenado
            if (sqlsrv_execute($stmt) === false) {
                throw new Exception(print_r(sqlsrv_errors(), true)); // Manejo de errores si la ejecución falla
            }

            // Obtener el valor del parámetro de salida
            sqlsrv_fetch($stmt); // Se necesita llamar a esta función para obtener los valores de los parámetros de salida
            $dias_ac_firma_entrega = $params[3]; // Obtener el valor del parámetro de salida

            // Cerrar la conexión y redirigir a la página "index"
            sqlsrv_free_stmt($stmt);
            sqlsrv_close($conn);

            // Mostrar mensaje de éxito
            echo '<script type="text/javascript">
            alert("Éxito: Los datos se actualizaron correctamente.");
            setTimeout(function() {
                window.location.href = "lista_actualizar_equipo";
            }, 1000);
            </script>';
            exit;
        } else {
            throw new Exception("No se pudo establecer la conexión.<br>" . print_r(sqlsrv_errors(), true)); // Manejo de errores si la conexión falla
        }
        //Para revisar errores:
    } catch (Exception $e) {
        // Imprime el mensaje de error para detectar el problema
     echo "Se produjo un error: " . $e->getMessage();
    }

}
?>
