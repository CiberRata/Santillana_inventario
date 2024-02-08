<?php
include('configuracion/conexionsql.php');
// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el número de serie a borrar del formulario
    $serie = $_POST["serie"];

    // Establecer la conexión
    $conn = sqlsrv_connect($serverName, $connectionOptions);

    if ($conn) {
        // Definir el nombre del procedimiento almacenado
        $procedureName = "{CALL SP_BorrarEquipo(?)}";

        // Parámetros del procedimiento almacenado
        $params = array(
            array(&$serie, SQLSRV_PARAM_IN)
        );

        // Preparar la llamada al procedimiento almacenado
        $stmt = sqlsrv_prepare($conn, $procedureName, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true)); // Manejo de errores si la preparación falla
        }

        // Ejecutar el procedimiento almacenado
        if (sqlsrv_execute($stmt) === false) {
            die(print_r(sqlsrv_errors(), true)); // Manejo de errores si la ejecución falla
        }

        echo "Equipo borrado correctamente.";

        // Liberar recursos
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
    } else {
        echo "No se pudo establecer la conexión.<br>";
        die(print_r(sqlsrv_errors(), true)); // Manejo de errores si la conexión falla
    }
}
?>
