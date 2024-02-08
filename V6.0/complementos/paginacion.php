<?php

$totalPages = isset($_SESSION['totalPages']) ? $_SESSION['totalPages'] : 0; //Recupera la variable para que esté definida, esto viene desde tabla.php
if ($totalPages > 0) {
    
$pageSize = 5; // Cantidad de registros por página
$pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Número de página actual

// Calcula el offset
$offset = ($pageNumber - 1) * $pageSize;
    // Ahora $totalPages contiene el número total de páginas
    try {
        echo "<texto>Total de páginas: " . $totalPages . "</texto>"; 
    } catch (Exception $e) {
        echo 'Se produjo un error: ',  $e->getMessage(), "\n";
    }
    
    ?>
    
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center pagination-container">
            <li class="page-item">
                <a href="?page=1" class="page-link">Primera</a>
            </li>
            <?php if ($pageNumber > 1) : ?>
                <li class="page-item">
                    <a href="?page=<?php echo $pageNumber - 1; ?>" class="page-link" >Anterior</a>
                </li>
            <?php endif; ?>
            
            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <li class="page-item <?php echo ($i === $pageNumber) ? 'active' : ''; ?>">
                    <a href="?page=<?php echo $i; ?>" class="page-link" ><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
            
            <?php if ($pageNumber < $totalPages) : ?>
                <li class="page-item">
                    
                    <a href="?page=<?php echo $pageNumber + 1; ?>" class="page-link">Siguiente</a>
                </li>
            <?php endif; ?>
            
            <li class="page-item">
                <a href="?page=<?php echo $totalPages; ?>" class="page-link">Última</a>
            </li>
        </ul>
    </nav>
    <?php
} else {
    // Si no hay datos, mostrar el mensaje "SIN DATOS"
    echo "SIN DATOS";
}
?>