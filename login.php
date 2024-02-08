<?php
// Incluir el archivo de configuración de la base de datos
include('configuracion/conexionsql.php');
$conn = sqlsrv_connect($serverName, $connectionOptions);
// Verificar si se enviaron datos mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el nombre de usuario y la contraseña del formulario
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Realizar la consulta SQL para buscar el usuario en la base de datos
    $sql = "SELECT * FROM usuarios WHERE username = ? AND password = ?";
    $params = array($username, $password);
    $stmt = sqlsrv_query($conn, $sql, $params);

    // Verificar si la consulta fue exitosa
    if ($stmt === false) {
        // Mostrar los errores
        print_r(sqlsrv_errors());
    }

    // Verificar si se encontró un usuario con las credenciales proporcionadas
    if (sqlsrv_has_rows($stmt)) {
        // Usuario autenticado correctamente, iniciar sesión
        session_start();

        // Guardar información del usuario en la sesión
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;

        // Redirigir a la página de inicio
        header("Location: index.php");
        exit;
    } else {
        // Credenciales incorrectas, mostrar mensaje de error
        echo "Usuario o contraseña incorrectos.";
    }

    // Liberar recursos
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}
?>
