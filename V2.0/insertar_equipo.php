<?php
include('configuracion/conexionsql.php');

// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST["nombre"];
    $serie = $_POST["serie"];
    $usuario_responsable = $_POST["usuario_responsable"];
    $usuario_anterior = $_POST["usuario_anterior"];
    $estado_equipo = $_POST["estado_equipo"];
    $tipo_equipo = $_POST["tipo_equipo"];
    $sede = $_POST["sede"];
    $gerencia = $_POST["gerencia"];
    $subgerencia = $_POST["subgerencia"];

    // Establecer la conexión
    $conn = sqlsrv_connect($serverName, $connectionOptions);

    if ($conn) {
        // Definir el nombre del procedimiento almacenado
        $procedureName = "{CALL SP_InsertarEquipo(?, ?, ?, ?, ?, ?, ?, ?, ?)}";
        $stmt = sqlsrv_prepare($conn, $procedureName);

        // Parámetros del procedimiento almacenado
        $params = array(
            array(&$nombre, SQLSRV_PARAM_IN),
            array(&$serie, SQLSRV_PARAM_IN),
            array(&$usuario_responsable, SQLSRV_PARAM_IN),
            array(&$usuario_anterior, SQLSRV_PARAM_IN),
            array(&$estado_equipo, SQLSRV_PARAM_IN),
            array(&$tipo_equipo, SQLSRV_PARAM_IN),
            array(&$sede, SQLSRV_PARAM_IN),
            array(&$gerencia, SQLSRV_PARAM_IN),
            array(&$subgerencia, SQLSRV_PARAM_IN)
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

        echo "Datos insertados correctamente.";
        header("Location: index.php");
        exit; // Asegúrate de salir del script después de la redirección

        // Liberar recursos
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
    } else {
        echo "No se pudo establecer la conexión.<br>";
        die(print_r(sqlsrv_errors(), true)); // Manejo de errores si la conexión falla
    }
}
?>
