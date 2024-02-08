<?php
include('configuracion/conexionsql.php');

// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Obtener el número de serie a borrar del formulario
        $serie = $_POST["serie_borrar"];

        // Establecer la conexión
        $conn = sqlsrv_connect($serverName, $connectionOptions);

        if ($conn) {
            // Verificar si la serie existe antes de borrar
            $sqlVerificarSerie = "SELECT * FROM Equipo WHERE serie = ?" ; // Reemplaza TuTabla por el nombre de tu tabla
            $stmtVerificarSerie = sqlsrv_prepare($conn, $sqlVerificarSerie, array(&$serie));
            if (sqlsrv_execute($stmtVerificarSerie) === false) {
                throw new Exception(print_r(sqlsrv_errors(), true));
            }

            // Verificar si se encontró algún resultado (si la serie existe)
            if (sqlsrv_has_rows($stmtVerificarSerie) === false) {
                throw new Exception("La serie no existe. Valide la serie ingresada.");
            }

            // Definir el nombre del procedimiento almacenado
            $procedureName = "{CALL SP_BorrarEquipo(?)}";

            // Parámetros del procedimiento almacenado
            $params = array(
                array(&$serie, SQLSRV_PARAM_IN)
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

            // Liberar recursos
            sqlsrv_free_stmt($stmt);
            sqlsrv_close($conn);

            // Mostrar mensaje de éxito
            echo '<script type="text/javascript">
            alert("Éxito: Los datos se borraron correctamente.");
            setTimeout(function() {
                window.location.href = "lista_borrar_equipo";
            }, 1000);
            </script>';
            exit;
            
        } else {
            throw new Exception("No se pudo establecer la conexión.<br>" . print_r(sqlsrv_errors(), true)); // Manejo de errores si la conexión falla
        }
    } catch (Exception $e) {
        // Imprimir mensaje de error y redirigir después de 2 segundos
        echo '<script type="text/javascript">
            alert("Error: ' . $e->getMessage() . '");
            setTimeout(function() {
                window.location.href = "lista_borrar_equipo";
            }, 1000);
        </script>';
    }
}
?>
