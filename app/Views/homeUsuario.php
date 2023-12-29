<!DOCTYPE html>
<html lang="es">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="description" content="Mira tus videos de Youtube como quieras">
    <title>Home - Usuario</title>
</head>
<body>
    <header class="titulo">
        <h1>
            <a href="#">
                VideoTrends 
            </a>
        </h1> <h5>Mira tus videos de YouTube como quieras.</h5>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url()?>/home/buscarPelicula">Buscar Pelicula</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url()?>/home/mostrarPeliculasRecomendadas">Recomendadas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url()?>/home/mostrarMiBiblioteca">Mi Biblioteca</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url()?>/home/modificarUsuario">Mi Perfil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url()?>/home/exit">Salir</a>
            </li>
        </ul>
    </header>
    <table class="table">
  <thead>
  </thead>
  <tbody>
  </tbody>
</table>
</body>
</html>