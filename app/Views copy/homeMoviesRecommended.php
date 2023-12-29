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
                <a class="nav-link" href="#">Mi Biblioteca</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Mi Perfil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url()?>/home/exit">Salir</a>
            </li>
        </ul>
    </header>
    <table class="table">
  <thead>
    <tr>
        <th scope="col">imdb</th>
        <th scope="col">Titulo</th>
        <th scope="col">Año</th>
        <th scope="col">Comentarios</th>
    </tr>
  </thead>
  <tbody>
  <?php for( $i = 0; $i<count($peliculas); $i++){ ?>
        <tr>
            <td><?= $peliculas[$i]['movie']['ids']['imdb']?></td>
            <td><?= $peliculas[$i]['movie']['title']?></td>
            <td><?= $peliculas[$i]['movie']['year']?></td>
            <td>
            <form method="post" action="<?php echo base_url()?>/home/mostrarComentarios">
                        <input type="hidden" name="id_seleccionado" value="<?= $peliculas[$i]['movie']['ids']['imdb']; ?>">
                        <button type="submit">Ver Comentarios</button>
                    </form>
            </td>
        </tr>
    <?php }; ?>
  </tbody>
</table>
</body>
</html>