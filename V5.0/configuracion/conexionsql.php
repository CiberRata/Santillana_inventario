<?php
$serverName = "SPEWSOPSER3\SQLEXPRESS"; // Puedes utilizar la dirección IP o el nombre del servidor
$connectionOptions = array(
    "Database" => "Lab_mini_inventario",
    "Uid" => "sa",  // Deja este campo vacío para la autenticación de Windows
    "PWD" => "Santi123",   // Deja este campo vacío para la autenticación de Windows
    "CharacterSet" => "UTF-8"
);

// Establecer la conexión
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Verificar la conexión
if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}

//echo "Conexión exitosa";

// Realizar consultas SQL u otras operaciones aquí

// Cerrar la conexión al finalizar
sqlsrv_close($conn);
?>
