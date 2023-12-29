<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Mira tus videos de Youtube como quieras">
    <meta name="author" content="Jonathan Matias Gomez">
    <link rel= "stylesheet" type="text/css" href="<?php echo base_url()?>/css/style.css">
    <link rel= "stylesheet" type="text/css" href="<?php echo base_url()?>/css/registro.css">
    <link rel="icon" href="img\fabicon.ico.png" type="image/x-icon">
    
    <!--<script src="js/jquery.js"></script>-->
    <!--<script src="js/jquery-ui.min.js"></script>-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
   
    
    <title>Registro - VideoTrends</title>
</head>

<body>
    <header class="titulo">
        <h1>
            <a href="index.html">
                <img src="<?php echo base_url()?>/img\icono.png" width="25" height="25">
                VideoTrends
            </a>
        </h1> <h5>Mira tus videos de YouTube como quieras.</h5>
    </header>
    <div class="tituloCentral"><h2><?php echo $msj;?></h2></div>
    <nav class="barraSuperior">
        <ul>
            <li><a href="<?php echo base_url()?>/home/buscarPelicula">Aceptar</a></li>
        </ul>
    </nav>
    
    <footer class="piedepagina">
        <p><a href="https://www.youtube.com" target="_blank">- YouTube -</a></p>
        <p><a href="https://campusvirtual.ugd.edu.ar/moodle/login/index.php" target="_blank"> Campus Virtual </a></p>
        <p><a href="https://ugd.edu.ar" target="_blank">- UGD -</a></p>
    </footer>
    <!--<script src="js/eje_3_a.js"></script>-->
    <script src="<?php echo base_url()?>/js/eje_3_b.js"></script>
</body>

</html>