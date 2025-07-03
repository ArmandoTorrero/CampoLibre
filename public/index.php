<?php

    session_start();
    require_once __DIR__ . '/../vendor/autoload.php';
    
    use Dotenv\Dotenv;
    use Core\Router; 

    // cargamos los archivos de .env
    $dotenv = Dotenv::createImmutable(__DIR__ . '/..'); 
    $dotenv->load();

    // mostrar errores en despliegue
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    // instanciamos la clase router
    $router = new Router();
    
    // RUTAS PARA VISTAS
    $router->add('/', 'UserController@landingPage'); 
    $router->add('/login', 'UserController@loginPage'); 
    $router->add('/registro', 'UserController@registerPage');
    $router->add('/perfil', 'UserController@profilePage'); 

    $router->add('/campos', 'CampoController@CamposPage'); 
    $router->add('/reservarCampo', 'CampoController@reservarCampo'); 



    // RUTAS QUE MANDAN JSON ENCODE

    // USUARIO
    $router->add('/usuarios', 'UserController@getAllUsers');
    $router->add('/logueado', 'UserController@estaLogueado');
    $router->add('/validarLogin', 'UserController@validarLogin');
    $router->add('/validarRegistro', 'UserController@validarRegistro');

    // CAMPO
    $router->add('/getCampos', 'CampoController@getCampos');    
    $router->add('/getCampoByfiltro', 'CampoController@getCampoByfiltro'); 
    $router->add('/getCampoById', 'CampoController@getCampoById'); 

    //RESERVAS
    $router->add('/validarReserva', 'ReservaController@validarReserva'); 

    // FRANJA HORARIA
    $router->add('/getHorariosByFecha', 'FranjaHorariaController@getHorariosByFecha'); 

    // MODALIDAD
    $router->add('/getModalidades', 'ModalidadController@getModalidades');


    $requestUri = isset($_GET['url']) ? '/' . trim($_GET['url'], '/') : '/';
    $router->dispatch($requestUri); 


?>