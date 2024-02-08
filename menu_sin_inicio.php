<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú con Bootstrap</title>
    <!-- Enlazar los estilos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <div class="container-fluid">
  <a href="index"><img class="image-logo"  src="img/logo-santillana.svg" alt="logo santillana"></a>
    <!---<a class="navbar-brand" href="index">Equipos Santillana</a>-->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link<?php echo basename($_SERVER['PHP_SELF']) === 'listar_insertar_equipo.php' ? ' active' : ''; ?>" href="#"> Insertar Equipo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?php echo basename($_SERVER['PHP_SELF']) === 'lista_borrar_equipo.php' ? ' active' : ''; ?>" href="#">Borrar Equipo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?php echo basename($_SERVER['PHP_SELF']) === 'lista_actualizar_equipo.php' ? ' active' : ''; ?>" href="#">Actualizar Equipo</a>
          <li class="nav-item">
          <a class="nav-link<?php echo basename($_SERVER['PHP_SELF']) === 'logout.php' ? ' active' : ''; ?>" href="#">Salir</a>
        </li>  
        </li>
      </ul>
    </div>
  </div>
</nav>



<!-- Scripts de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
