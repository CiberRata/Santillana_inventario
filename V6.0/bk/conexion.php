<?php


/* INSTANCIA PARA SQLSERVER 
$serverName = "localhost\SQLEXPRESS"; //serverName\instanceName
$connectionInfo = array( "Database"=>"DB_Servidores", "UID"=>"sa", "PWD"=>"Giovanni23**");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     echo "Conexion establecida.<br />";

}else{
     echo "Conexion no se pudo establecer.<br />";
     die( print_r( sqlsrv_errors(), true));
}

//Cerrar la conexión
//sqlsrv_close($conn);

/*

/* INSTANCIA PARA MYSQL

$servername = "localhost";
$database = "bd_Servidores";
$username = "root";
$password = "";
// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . $conn->connect_errno);
}
echo "Connected successfully";

*/

$contraseña = "";
$usuario = "root";
$nombre_base_de_datos = "bd_servidores";
try {
    $conn = new PDO('mysql:host=localhost;dbname=' . $nombre_base_de_datos, $usuario, $contraseña);
    $conn->query("set names utf8;");
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (Exception $e) {
    echo "Ocurrió algo con la base de datos: " . $e->getMessage();
}





?>