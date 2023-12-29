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
    <div class="tituloCentral"><h2>Registro Usuario</h2></div>
    <nav class="barraSuperior">
        <ul>
            <li><a href="<?php echo base_url()?>/home/homeUsuario">Inicio</a></li>
        </ul>
    </nav>
    <div class="row registro-row">
        <section class="item">
            <form action="<?php echo base_url()?>/home/modificarRegistrosUsuario" method="post">

                <h3>Datos de Inicio de Sesión</h3>
                <div class="form-item">
                    <label for="email">E-mail*</label>
                    <input class="tooltip" value="<?= $usuario['email']; ?>" type="email" name="email" id="email" title="Ingrese email" required="required">
                </div>
                <div class="form-item">
                    <label for="contrasenia">Contraseña*</label>
                    <input class="tooltip" value="<?= $usuario['contrasenia']; ?>" type="password" name="contrasenia" id="contrasenia" title="Ingrese Contraseña" required="required">
                </div>
                <div class="form-item">
                    <label for="re-contrasenia">Repetir Contraseña*</label>
                    <input class="tooltip" value="<?= $usuario['contrasenia']; ?>" type="password" name="re-contrasenia" id="re-password" title="Ingrese la misma contraseña" required="required">
                </div>

                <h3>Datos Personales</h3>

                <div class="form-item">
                    <label for="nombre">Nombre</label>
                    <input class="tooltip" value="<?= $usuario['nombre']; ?>" type="text" name="nombre" id="nombre" title="Ingrese su nombre" maxlength="60" minlength="5">
                </div>
                <div class="form-item">
                    <label for="apellido">Apellido</label>
                    <input class="tooltip" value="<?= $usuario['apellido']; ?>" type="text" name="apellido" id="apellido" title="Ingrese su apellido" maxlength="60" minlength="5">
                </div>
                <div class="form-item">
                    
                    <div id="genero">
                        <label for="Genero">Genero</label>
                        <label><input type="radio" name="genero" value="masculino" <?= ($usuario['genero'] == 'masculino') ? 'checked' : ''; ?>> Masculino</label>
                        <label><input type="radio" name="genero" value="femenino" <?= ($usuario['genero'] == 'femenino') ? 'checked' : ''; ?>> Femenino</label>
                    </div>
                </div>
                <div class="form-item">
                    <label for="tel">Telefono</label>
                    <input class="tooltip" value="<?= $usuario['telefono']; ?>" type="tel" name="telefono" id="telefono" title="Ingrese un telefono">
                </div>
                <!-- Tp2-Ejercicio 3.a -->
                <div class="form-item">
                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                    <input id="calendario" value="<?= $usuario['fecha_nacimiento']; ?>" type="date" name="fecha_nacimiento" id="fecha_nacimiento" title="Ingrese su fecha de nacimiento">
                </div>
                
                <h3>Datos de Localizacion</h3>
                
                <div class="form-item">
                    <label for="pais">País</label>
                    <select name="pais" id="pais">
                        <option value="Argentina" <?= ($usuario['pais'] == 'Argentina') ? 'selected' : ''; ?>>Argentina</option>
                        <option value="Paraguay" <?= ($usuario['pais'] == 'Paraguay') ? 'selected' : ''; ?>>Paraguay</option>
                        <option value="Brasil" <?= ($usuario['pais'] == 'Brasil') ? 'selected' : ''; ?>>Brasil</option>
                        <option value="Chile" <?= ($usuario['pais'] == 'Chile') ? 'selected' : ''; ?>>Chile</option>
                    </select>
                </div>

                <div class="form-item">
                    <label for="provincia">Provincia/Estado</label>
                    <select name="provincia" id="provincia">
                        <option value="Misiones" <?= ($usuario['provincia'] == 'Misiones') ? 'selected' : ''; ?>>Misiones</option>
                        <option value="Corrientes" <?= ($usuario['provincia'] == 'Corrientes') ? 'selected' : ''; ?>>Corrientes</option>
                        <option value="Buenos Aires" <?= ($usuario['provincia'] == 'Buenos Aires') ? 'selected' : ''; ?>>Buenos Aires</option>
                    </select>
                </div>

                <div class="form-item">
                    <label for="ciudad">Ciudad</label>
                    <select name="ciudad" id="ciudad">
                        <option value="Apostoles" <?= ($usuario['ciudad'] == 'Apostoles') ? 'selected' : ''; ?>>Apostoles</option>
                        <option value="Posadas" <?= ($usuario['ciudad'] == 'Posadas') ? 'selected' : ''; ?>>Posadas</option>
                        <option value="Capital Federal" <?= ($usuario['ciudad'] == 'Capital Federal') ? 'selected' : ''; ?>>Capital Federal</option>
                    </select>
                </div>

                <div class="form-item">
                    <label for="calle">Calle</label>
                    <input class="tooltip" value="<?= $usuario['calle']; ?>" type="text" name="calle" id="calle" title="Ingrese su calle">
                </div>

                <div class="form-item">
                    <label for="altura">Altura (Nº)</label>
                    <input class="tooltip" value="<?= $usuario['altura']; ?>" type="number" name="altura" id="altura" title="Ingrese el número de la calle">
                </div>

                <div class="form-item">
                    <label for="coordenadas">Coordenadas</label>
                    <div id="coordenadas">
                        <input onchange="centrarMapa()" value="<?= $usuario['latitud']; ?>" class="tooltip" type="number" name="latitud" id="latitud" title="Ingrese la latitud">
                        <label for="lat">Lat</label>
                        <input onchange="centrarMapa()" value="<?= $usuario['longitud']; ?>" class="tooltip" data-toggle="tooltip" type="number" name="longitud" id="longitud" title="Ingrese la longitud">
                        <label for="long">Long</label>    
                    </div>
                </div>
                    <div class="form-item">
                        <div id="map">
                        </div>
                    </div>
                    <div class="item">
                        <hr>
                        <a href="<?php echo base_url()?>/home/modificarRegistrosUsuario" target="_parent"><button class="button">
                            Actualizar Datos
                        </button></a>
                    </div>
                </div>
            </form>
        </section>
        <div class="imagenDerecha">
            <img src="<?php echo base_url()?>/img\icono.png" alt="">
        </div>
    </div>
    
    <footer class="piedepagina">
        <p><a href="https://www.youtube.com" target="_blank">- YouTube -</a></p>
        <p><a href="https://campusvirtual.ugd.edu.ar/moodle/login/index.php" target="_blank"> Campus Virtual </a></p>
        <p><a href="https://ugd.edu.ar" target="_blank">- UGD -</a></p>
    </footer>
    <!--<script src="js/eje_3_a.js"></script>-->
    <script src="<?php echo base_url()?>/js/eje_3_b.js"></script>
</body>

</html>