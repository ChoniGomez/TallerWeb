<?php

namespace App\Controllers;
use App\Models\UsuarioModel;

class Home extends BaseController
{
    public function index()
    {
        $model = new UsuarioModel();
        //var_dump($model);
        //////////////////////////////////////////////////////////////// consulta sql
        $data = [];
		$db = \Config\Database::connect();
		$builder = $db->table('usuarios');
        $builder->select('*');
        $usuarios = $builder->get();
        $data['usuarios'] = $usuarios->getResult();
		//echo  json_encode($data);// imprime como json
        //var_dump($data);


        ////////// elimina a un usuario con el id = 2
        //$model->delete(3);
        return view('inicio');
    }
    //// mostrar la vista registro.php
    public function registro()
    {
        return view('registro');
    }

    public function loguearUsuario(){
        // bandera para saber si se logueo
        $logueo = 0;
        // obtengo el usuario y contrasenia de la vista de inicio
        $request = \Config\Services::request();
        $email = $request->getPost('email');
        $contrasenia = $request->getPost('contrasenia');
        // obtengo todos los usuarios y contrasenias de la bd
        $data = [];
		$db = \Config\Database::connect();
		$builder = $db->table('usuarios');
        $builder->select('*');
        $usuarios = $builder->get();
        $data = $usuarios->getResultArray();
        for($i = 0; $i < count($data); $i++){//recorro todos los usuarios
            if(strcmp($contrasenia, $data[$i]['contrasenia'])==0 && strcmp($email, $data[$i]['email'])==0){// comparo el usuario y la contrasenia con el campo
                if($this->verificarTokenEmail($email)){// verifico si esta validado el token
                    // guardar los datos del usuario en una session
                    $user = [
                        "id" => $data[$i]['id'],
                        "email" => $data[$i]['email'],
                        "contrasenia" => $data[$i]['contrasenia']
                    ];
                    $session = session();
                    $session->set($user);
                    $logueo = 1;//activo la bandera de logueado
                    return view('homeUsuario');//inicio la vista de usuario
                }                
            }
        }
        if($logueo == 0){// si el usuario no se logueo
            return redirect()->to(base_url('/Home'));//redirecciona a la pagina principal
        }
    }
    // envia el mail con el token a el usuario
    public function enviarEmail($token, $correo){
        $email = \Config\Services::email();
        $email->setFrom('taller_aplicaciones_web@ugd.com', 'Taller de Aplicaciones Web UGD');
        $email->setTo($correo);        
        $email->setSubject('Verificacion de correo electronico');
        $email->setMessage('<a href="'.base_url().'/home/validarToken/'.$token.'">Validar Token</a>');//valida el token con un html enviado por correo
        $email->send();
    }

    public function validarToken($token){
        // bandera para saber si se valido el Token
        $banderaToken = FALSE;
        // obtengo a todos los usuarios de la bd
        $data = [];
		$db = \Config\Database::connect();
		$builder = $db->table('usuarios');
        $builder->select('*');
        $usuarios = $builder->get();
        $data = $usuarios->getResultArray();
        for($i = 0; $i < count($data); $i++){//recorro todos los usuarios
            if(strcmp($token, $data[$i]['token']) == 0 ){// comparo el token con cada usuario
                // modificar el campo de valicacion a SI
                $data[$i]['validacion'] = 'SI';
                $idUsuario = $data[$i]['id'];
                $builder->where('id',$idUsuario);
                $builder->update($data[$i]);
                $banderaToken = TRUE;
            }
        }     
        // verifico si se valido el correo para informar al usuario
        if($banderaToken){
            $dato ['msj'] = 'La cuenta ha sido validada correctamente!.';
            return view('alertaUsuario', $dato);//vista de Alerta de usuario creado correctamente
        }else{
            $dato ['msj'] = 'Ocurrio un error al validar la cuenta.';
            return view('alertaUsuario', $dato);//vista de Alerta de usuario creado correctamente
        }
    }
    public function crearUsuario(){
        // obtengo todos los datos del usuario de la vista de inicio
        $request = \Config\Services::request();
        $email = $request->getPost('email');
        $contrasenia = $request->getPost('contrasenia');
        $nombre = $request->getPost('nombre');
        $apellido = $request->getPost('apellido');
        $genero = $request->getPost('genero');
        $telefono = $request->getPost('telefono');
        $fecha_nacimiento = $request->getPost('fecha_nacimiento');
        $pais = $request->getPost('pais');
        $provincia = $request->getPost('provincia');
        $ciudad = $request->getPost('ciudad');
        $calle = $request->getPost('calle');
        $altura = $request->getPost('altura');
        $latitud = $request->getPost('latitud');
        $longitud = $request->getPost('longitud');
        ///// generar un token aleatorio
        $token = $this->generarTokenEmail();
        // verifico si existe un usuario con el mismo email
        if($this->validarEmail('chonio@gmail.com')){
            echo "usuario con el mismo email";
        }else{
            echo "usuario sin ese email";
        }
    }
    //compara contra todos los correos electronicos si hay uno generado
    public function validarEmail($email){
        $banderaEmail = FALSE;
        $data = [];
		$db = \Config\Database::connect();
		$builder = $db->table('usuarios');
        $builder->select('*');
        $usuarios = $builder->get();
        $data = $usuarios->getResultArray();
        for($i = 0; $i < count($data); $i++){//recorro todos los usuarios
            if(strcmp($email, $data[$i]['email'])==0){// comparo el usuario y la contrasenia con el campo
                $banderaEmail = TRUE;//existe un usuario con el mismo correo  
            }
        }
        return $banderaEmail;
    }

    public function verificarTokenEmail($email){
        $data = [];
        $banderaTokenEmail = FALSE;
		$db = \Config\Database::connect();
		$builder = $db->table('usuarios');
        $builder->select('*');
        $usuarios = $builder->get();
        $data = $usuarios->getResultArray();
        for($i = 0; $i < count($data); $i++){//recorro todos los usuarios
            if(strcmp($email, $data[$i]['email'])==0 && strcmp('SI', $data[$i]['validacion'])==0){// comparo el correo y el campo validacion con un SI
                $banderaTokenEmail = TRUE;//devuelve verdadero si esta validado el token  
            }
        }
        return $banderaTokenEmail;
    }

    public function generarTokenEmail(){
        $caracteres_permitidos = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $caracteres_permitidos_longitud = strlen($caracteres_permitidos);
        $token = '';
        for ($i = 0; $i < 64; $i++) {
            $token .= $caracteres_permitidos[rand(0, $caracteres_permitidos_longitud - 1)];
        }
        return $token;
    }

    public function insertarUsuario2(){
        $email = 'correo@gmail';
        $contrasenia = '1234';
        $nombre = 'pepe';
        $apellido = 'grillo';
        $genero = 'masculino';
        $telefono = '3764102020';
        $fecha_nacimiento = '';
        $pais = 'Argentina';
        $provincia = 'Misiones';
        $ciudad = 'Posadas';
        $calle = 'Falsa 123';
        $altura = '300';
        $latitud = '50';
        $longitud = '7000';
        $token = $this->generarTokenEmail(); 
        $validacion = 'NO';
        // Conectar a la base de datos
        $db = \Config\Database::connect();
		$builder = $db->table('usuarios');
        $builder->select('*');
        // crear un objeto para guardar los datos del usuario
        $usuario = [
            'email' => $email,
            'contrasenia'  => $contrasenia,
            'nombre'  => $nombre,
            'apellido'  => $apellido,
            'genero'  => $genero,
            'telefono'  => $telefono,
            'fecha_nacimiento'  => $fecha_nacimiento,
            'pais'  => $pais,
            'provincia'  => $provincia,
            'ciudad'  => $ciudad,
            'calle'  => $calle,
            'altura'  => $altura,
            'latitud'  => $latitud,
            'longitud'  => $longitud,
            'token'  => $token,
            'validacion'  => $validacion
        ];
        $builder->insert($usuario);
    }

    public function insertarUsuario(){
        /// tomar todos los datos de la vista registro.php
        $request = \Config\Services::request();
        $email = $request->getPost('email');
        $contrasenia = $request->getPost('contrasenia');
        $nombre = $request->getPost('nombre');
        $apellido = $request->getPost('apellido');
        $genero = $request->getPost('genero');
        $telefono = $request->getPost('telefono');
        // formateo de fecha 
        $fecha_original = $request->getPost('fecha_nacimiento');
        $nuevaFecha = date("Y/m/d", strtotime($fecha_original));
        $fecha_nacimiento = $request->getPost('fecha_nacimiento');
        $pais = $request->getPost('pais');
        $provincia = $request->getPost('provincia');
        $ciudad = $request->getPost('ciudad');
        $calle = $request->getPost('calle');
        $altura = $request->getPost('altura');
        $latitud = $request->getPost('latitud');
        $longitud = $request->getPost('longitud');
        $token = $this->generarTokenEmail(); 
        $validacion = 'NO';
        // Conectar a la base de datos
        $db = \Config\Database::connect();
		$builder = $db->table('usuarios');
        $builder->select('*');
        // crear un objeto para guardar los datos del usuario
        $usuario = [
            'email' => $email,
            'contrasenia'  => $contrasenia,
            'nombre'  => $nombre,
            'apellido'  => $apellido,
            'genero'  => $genero,
            'telefono'  => $telefono,
            'fecha_nacimiento'  => $fecha_nacimiento,
            'pais'  => $pais,
            'provincia'  => $provincia,
            'ciudad'  => $ciudad,
            'calle'  => $calle,
            'altura'  => $altura,
            'latitud'  => $latitud,
            'longitud'  => $longitud,
            'token'  => $token,
            'validacion'  => $validacion
        ];
        /// Agrega el nuevo usuario a la base de datos
        if($builder->insert($usuario)){
            // enviar el token al correo
            $this->enviarEmail($token,$email); 
            $dato ['msj'] = 'Usuario creado correctamente. Por favor verificar su bandeja de entrada para validar su cuenta.';
            return view('alertaUsuario', $dato);//vista de Alerta de usuario creado correctamente
        }else{
            $dato ['msj'] = 'Error al crear la cuenta. Por favor volver a intentarlo nuevamente.';
            return view('alertaUsuario', $dato);//vista de Alerta de usuario con error al crear
        }
    }

    // Funcion para obtener peliculas
    public function getPelicula() {
        $slug = 'trendig';
        $url = 'https://api.trakt.tv/movies/trending?extended=full';
        $headers = [
            'Content-Type: application/json',
            'trakt-api-key: a7172f36227779fbd81899238646f4f78a5f66a00db668682efbb4e29c4d5df9',
            'trakt-api-version: 2',
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $item = json_decode($response, true);


        var_dump($item);
    }

    public function getMovie($type){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.trakt.tv/search/movie?query='.$type);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "trakt-api-version: 2",
            "trakt-api-key: a7172f36227779fbd81899238646f4f78a5f66a00db668682efbb4e29c4d5df9"
        ));

        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, true);
        return $data;
    }

    public function searchMovieId($imdb){
        $ch = curl_init();
        // el imdb es el id de la pelicula
        curl_setopt($ch, CURLOPT_URL, "https://api.trakt.tv/search/imdb/".$imdb);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "trakt-api-version: 2",
            "trakt-api-key: a7172f36227779fbd81899238646f4f78a5f66a00db668682efbb4e29c4d5df9"
        ));

        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, true);
        return $data;
        
    }

    public function getCommentsHighest($imdb){
        $trakt = '7';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://api.trakt.tv/movies/".$imdb."/comments/newest");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "trakt-api-version: 2",
            "trakt-api-key: a7172f36227779fbd81899238646f4f78a5f66a00db668682efbb4e29c4d5df9"
        ));

        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, true);
        return $data;
    }

    public function peliculasRecomendadas(){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://api.trakt.tv/movies/trending");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "trakt-api-version: 2",
            "trakt-api-key: a7172f36227779fbd81899238646f4f78a5f66a00db668682efbb4e29c4d5df9"
        ));

        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, true);//formatear los datos a json
        return $data;
    }

    public function exit(){
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/Home'));//redirecciona a la pagina principal
    }

    public function buscarPelicula(){
        return view('homeSearchMovies');
    }
    // funcion que se ejecuta cuando el usuario presiona el boton de buscar
    public function buscarPeliculaUsuario(){
        $request = \Config\Services::request();
        $busqueda = $request->getPost('busqueda');//almaceno la busqueda
        $categoria = $request->getPost('categoria');//almaceno la categoria
        $datos ['peliculas'] = $this->getMovie($busqueda);
        return view('homeSearchMoviesNotNull',[//para retornar las peliculas y categoria
            'categoria' => $categoria,
            'peliculas' => $datos ['peliculas'],
        ]);
    }
    
    public function agregarPeliculaUsuario(){
        $request = \Config\Services::request();
        $id_seleccionado = $this->request->getPost('id_seleccionado');// imdb
        $dato = $this->searchMovieId($id_seleccionado);//selecciono la pelicula a traves de su imdb
        $categoria = $request->getPost('categoria');//almaceno la categoria
        $idUsuario = session('id');//obtengo el id del usuario
        // crear un objeto para guardar los datos de las peliculas
        $pelicula = [
            'id_usuario' => $idUsuario,
            'id_pelicula' => $id_seleccionado,
            'anio'  => $dato[0]['movie']['year'],
            'categoria'  => $categoria,
            'titulo'  => $dato[0]['movie']['title']
        ];
        // Conectar a la base de datos
        $db = \Config\Database::connect();
		$builder = $db->table('peliculas_usuarios');
        $builder->select('*');
        /// Agrega la nueva pelicula a la base de datos
        if($builder->insert($pelicula)){
            // enviar el token al correo
            $dato ['msj'] = 'La pelicula '.$dato[0]['movie']['title'].' se agrego de manera exitosa.';
            return view('alertaUsuarioPeliculas', $dato);//vista de Alerta de usuario creado correctamente
        }else{
            $dato ['msj'] = 'Error al agregar la pelicula. Por favor volver a intentarlo nuevamente.';
            return view('alertaUsuarioPeliculas', $dato);//vista de Alerta de usuario con error al crear
        }
        
    }

    public function mostrarPeliculasRecomendadas(){
        $datos ['peliculas'] = $this->peliculasRecomendadas();//almaceno todas las peliculas recomendadas
        //var_dump($datos);
        return view('homeMoviesRecommended', $datos);//inicio la vista de peliculas recomendadas
    }

    public function mostrarComentarios(){
        $id_seleccionado = $this->request->getPost('id_seleccionado');
        $datos ['comentarios'] = $this->getCommentsHighest($id_seleccionado);
        return view('homeMoviesCommentsHighest', $datos);//inicio la vista comentarios
    }

    public function mostrarMiBiblioteca(){
        $idUsuario = session('id');//obtengo el id del usuario
        // obtengo todas las peliculas de la bd
        $data = [];
		$db = \Config\Database::connect();
		$builder = $db->table('peliculas_usuarios');
        $builder->select('*');
        $peliculas_usuarios = $builder->get();
        $peliculas = array();//array para almacenar las peliculas del usuario
        $data = $peliculas_usuarios->getResultArray();
        // obtener las peliculas que sean del usuario = idUsuario
        for($i = 0; $i < count($data); $i++){//recorro todas las peliculas
            if($idUsuario == $data[$i]['id_usuario']){// comparo el idUsuario con el id_usuario de las peliculas
                $pelicula = [
                    "id" => $data[$i]['id'],
                    "id_usuario" => $data[$i]['id_usuario'],
                    "id_pelicula" => $data[$i]['id_pelicula'],
                    "anio" => $data[$i]['anio'],
                    "categoria" => $data[$i]['categoria'],
                    "titulo" => $data[$i]['titulo']
                ];
                array_push($peliculas,$pelicula);
            }
        }
        return view('homeMiBiblioteca', ['datos' => $peliculas]);
    }

    public function modificarUsuario(){
        $idUsuario = session('id');//obtengo el id del usuario
        // obtengo todos los usuarios y contrasenias de la bd
        $data = [];
		$db = \Config\Database::connect();
		$builder = $db->table('usuarios');
        $builder->select('*');
        $usuarios = $builder->get();
        $data = $usuarios->getResultArray();
        for($i = 0; $i < count($data); $i++){//recorro todos los usuarios
            if($idUsuario == $data[$i]['id']){// comparo el usuario y la contrasenia con el campo
                // guardar los datos del usuario en una session
                $usuario = [
                    'email' => $data[$i]['email'],
                    'contrasenia'  => $data[$i]['contrasenia'],
                    'nombre'  => $data[$i]['nombre'],
                    'apellido'  => $data[$i]['apellido'],
                    'genero'  => $data[$i]['genero'],
                    'telefono'  => $data[$i]['telefono'],
                    'fecha_nacimiento'  => $data[$i]['fecha_nacimiento'],
                    'pais'  => $data[$i]['pais'],
                    'provincia'  => $data[$i]['provincia'],
                    'ciudad'  => $data[$i]['ciudad'],
                    'calle'  => $data[$i]['calle'],
                    'altura'  => $data[$i]['altura'],
                    'latitud'  => $data[$i]['latitud'],
                    'longitud'  => $data[$i]['longitud'],
                ];       
            }
        }
        return view('modificarRegistro',['usuario' => $usuario]);
    }

    public function modificarRegistrosUsuario(){
        /// tomar todos los datos de la vista registro.php
        $request = \Config\Services::request();
        $email = $request->getPost('email');
        $contrasenia = $request->getPost('contrasenia');
        $nombre = $request->getPost('nombre');
        $apellido = $request->getPost('apellido');
        $genero = $request->getPost('genero');
        $telefono = $request->getPost('telefono');
        // formateo de fecha 
        $fecha_original = $request->getPost('fecha_nacimiento');
        $nuevaFecha = date("Y/m/d", strtotime($fecha_original));
        $fecha_nacimiento = $request->getPost('fecha_nacimiento');
        $pais = $request->getPost('pais');
        $provincia = $request->getPost('provincia');
        $ciudad = $request->getPost('ciudad');
        $calle = $request->getPost('calle');
        $altura = $request->getPost('altura');
        $latitud = $request->getPost('latitud');
        $longitud = $request->getPost('longitud');
        $token = $this->generarTokenEmail(); 
        $validacion = 'NO';
        // Conectar a la base de datos
        $db = \Config\Database::connect();
		$builder = $db->table('usuarios');
        //$builder->select('*');
        // crear un objeto para guardar los datos del usuario
        $usuario = [
            //'id' => session('id'),//obtengo el id del usuario
            'email' => $email,
            'contrasenia'  => $contrasenia,
            'nombre'  => $nombre,
            'apellido'  => $apellido,
            'genero'  => $genero,
            'telefono'  => $telefono,
            'fecha_nacimiento'  => $fecha_nacimiento,
            'pais'  => $pais,
            'provincia'  => $provincia,
            'ciudad'  => $ciudad,
            'calle'  => $calle,
            'altura'  => $altura,
            'latitud'  => $latitud,
            'longitud'  => $longitud,
            'token'  => $token,
            'validacion'  => $validacion
        ];
        /// Modificar los datos del usuario a la base de datos
        $builder->where('id', session('id'));
        if($builder->update($usuario)){
            // enviar el token al correo
            $this->enviarEmail($token,$email); 
            $dato ['msj'] = 'Los datos del Usuario se modificaron correctamente. Por favor verificar su bandeja de entrada para validar su cuenta.';
            return view('alertaUsuarioPeliculas', $dato);//vista de Alerta de usuario creado correctamente
        }else{
            $dato ['msj'] = 'Error al modificar los datos de la cuenta. Por favor volver a intentarlo nuevamente.';
            return view('alertaUsuarioPeliculas', $dato);//vista de Alerta de usuario con error al crear
        }
    }

    //funcion para mostrar el inicio
    public function homeUsuario(){
        return view('homeUsuario');//inicio la vista de usuario
    }
}
