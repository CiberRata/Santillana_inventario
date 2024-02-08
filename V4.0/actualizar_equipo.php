<?php
include('configuracion/conexionsql.php');

// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Obtener los datos del formulario
        $nombre = $_POST["ac_nombre"];
        $serie = $_POST["ac_serie"];
        $usuario_responsable = $_POST["ac_usuario_responsable"];
        $usuario_anterior = $_POST["ac_usuario_anterior"];
        $estado_equipo = $_POST["ac_estado_equipo"];
        $tipo_equipo = $_POST["ac_tipo_equipo"];
        $sede = $_POST["ac_sede"];
        $gerencia = $_POST["ac_gerencia"];
        $subgerencia = $_POST["ac_subgerencia"];

        // Establecer la conexión
        $conn = sqlsrv_connect($serverName, $connectionOptions);

        if ($conn) {
            // Verificar si la serie o el nombre existen antes de actualizar
            $sqlVerificarSerie = "SELECT * FROM Equipo WHERE serie = ? OR nombre = ?";
            $stmtVerificarSerie = sqlsrv_prepare($conn, $sqlVerificarSerie, array(&$serie, &$nombre));
            if (sqlsrv_execute($stmtVerificarSerie) === false) {
                throw new Exception(print_r(sqlsrv_errors(), true));
            }

            // Verificar si se encontró algún resultado (si la serie o el nombre existen)
            if (sqlsrv_has_rows($stmtVerificarSerie) === false) {
                throw new Exception("La serie o el nombre no existen. Valide los datos ingresados.");
            }

            // Definir la sentencia SQL con la llamada al procedimiento almacenado
            $sql = "{CALL SP_ActualizarEquipo(?, ?, ?, ?, ?, ?, ?, ?, ?)}";

            // Preparar la llamada al procedimiento almacenado
            $stmt = sqlsrv_prepare($conn, $sql, array(
                array(&$nombre, SQLSRV_PARAM_IN),
                array(&$serie, SQLSRV_PARAM_IN),
                array(&$usuario_responsable, SQLSRV_PARAM_IN),
                array(&$usuario_anterior, SQLSRV_PARAM_IN),
                array(&$estado_equipo, SQLSRV_PARAM_IN),
                array(&$tipo_equipo, SQLSRV_PARAM_IN),
                array(&$sede, SQLSRV_PARAM_IN),
                array(&$gerencia, SQLSRV_PARAM_IN),
                array(&$subgerencia, SQLSRV_PARAM_IN)
            ));

            // Ejecutar el procedimiento almacenado
            if (sqlsrv_execute($stmt) === false) {
                throw new Exception(print_r(sqlsrv_errors(), true)); // Manejo de errores si la ejecución falla
            }

            // Liberar recursos
            sqlsrv_free_stmt($stmt);
            sqlsrv_close($conn);

            echo "Equipo actualizado correctamente.";
            header("Location: lista_actualizar_equipo");
            exit;
        } else {
            throw new Exception("No se pudo establecer la conexión.<br>" . print_r(sqlsrv_errors(), true)); // Manejo de errores si la conexión falla
        }
    } catch (Exception $e) {
        // Imprimir mensaje de error y redirigir después de 2 segundos
        echo '<script type="text/javascript">
            alert("Error: ' . $e->getMessage() . '");
            setTimeout(function() {
                window.location.href = "lista_actualizar_equipo";
            }, 1000);
        </script>';
    }
}
?>
