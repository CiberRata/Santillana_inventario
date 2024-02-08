
<?php
include('configuracion/conexionsql.php');


// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
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
                throw new Exception(print_r(sqlsrv_errors(), true)); // Manejo de errores si la preparación falla
            }

            // Ejecutar el procedimiento almacenado
            if (sqlsrv_execute($stmt) === false) {
                throw new Exception(print_r(sqlsrv_errors(), true)); // Manejo de errores si la ejecución falla
            }

            // Cerrar la conexión y redirigir a la página "index"
            sqlsrv_free_stmt($stmt);
            sqlsrv_close($conn);

            header("Location: listar_insertar_equipo");
            exit;
        } else {
            throw new Exception("No se pudo establecer la conexión.<br>" . print_r(sqlsrv_errors(), true)); // Manejo de errores si la conexión falla
        }
    } catch (Exception $e) {
        // Imprime el mensaje de error para detectar el problema
        echo '<script type="text/javascript">
            alert("Se produjo un error, por favor valide lo ingresado.");
            setTimeout(function() {
                window.location.href = "listar_insertar_equipo"; // Redirección después de 2 segundos
            }, 1000); // Espera 1 segundos (1000 milisegundos)
        </script>';
    }
}
       

