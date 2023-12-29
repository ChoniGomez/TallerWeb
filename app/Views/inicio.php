<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Mira tus videos de Youtube como quieras">
    <meta name="author" content="Jonathan Matias Gomez">
    <link rel="icon" href="<?php echo base_url()?>/img\fabicon.ico.png" type="image/x-icon">
    <link rel= "stylesheet" type="text/css" href="<?php echo base_url()?>/css/style.css">
    <script src="<?php echo base_url()?>/js/jquery-3.4.1.js"></script>
    <script src="<?php echo base_url()?>/js/eje_1_d.js"></script>
    <script src="<?php echo base_url()?>/js/eje_2_a.js"></script>
    <script src="<?php echo base_url()?>/js/eje_2_c.js"></script> 
    <title>VideoTrends</title>
</head>

<body>
    <div class="conteiner">
        <header class="titulo">
            <h1>
                <a href="index.html">
                    <img src="<?php echo base_url()?>/img\fabicon.ico.png" width="25" height="25">
                    VideoTrends
                </a>

            </h1> <h5>Mira tus videos de YouTube como quieras</h5>
        </header>

        <nav class="barraSuperior">
            <ul>
                <li><a href="<?php echo base_url()?>/home/registro">Crear Cuenta</a> | </li>
                <li><a href="#">Olvide mi contraseña</a> | </li>
                <li><a href="#">Acerca de Nosotros</a></li>
            </ul>
        </nav>
<div class="row">
        <div class="imgIzquierda">
            <a href="index.html">
                <img id="logo" src="<?php echo base_url()?>/img\icono.png" width="330" height="390">
            </a>
            
        </div>

        <div class="loginDerecha">
            <form action="<?php echo base_url()?>/home/loguearUsuario" method="post">
                <div class="form-group">
                <label for="contrasenia">Contraseña</label>
                    <input type="password" id="contrasenia" name="contrasenia" ><br>    
                
                <label for="email">Email </label>
                    <input type="text" id="email" name="email" ><br>
    
                </div>
                <div class="form-group">
                    
                    <button>Iniciar Sesión</button>
                    
                </div>
              
            </form>
        </div>
        </div>
        <footer class="piedepagina">
            <p><a href="https://www.youtube.com" target="_blank">- YouTube -</a></p>
            <p><a href="https://campusvirtual.ugd.edu.ar/moodle/login/index.php" target="_blank"> Campus Virtual </a></p>
            <p><a href="https://ugd.edu.ar" target="_blank">- UGD -</a></p>
        </footer>

    </div>
    
</body>
</html>