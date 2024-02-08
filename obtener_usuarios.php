<?php
include('configuracion/conexionsql.php');

$texto = $_GET['texto'];

$query = "SELECT usuario_responsable FROM usuario_responsable WHERE usuario_responsable LIKE '%$texto%'";
$result = $conn->query($query);

if ($result) {
    $resultados = array();
    while ($row = $result->fetch_assoc()) {
        $resultados[] = $row['usuario_responsable'];
    }
    
    header('Content-Type: application/json');
    echo json_encode($resultados);
} else {
    header('Content-Type: application/json');
    echo json_encode(array("error" => "Error en la consulta: " . $conn->error));
}

$conn->close();
?>


