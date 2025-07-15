<?php 
    namespace App\Controller;

    use App\Model\User;
    use Core\Utilities\RespuestaJSON;
    use Core\Utilities\Security;
    use Core\utilities\Sessions;
    use Core\utilities\Validador;
    use Symfony\Component\Security\Csrf\CsrfTokenManager;
    use Symfony\Component\Security\Csrf\CsrfToken;
    use Respect\Validation\Validator as v;
    use \Respect\Validation\Exceptions\ValidationException; 

    class UserController{
        private $userModel; 

        public function __construct() {
            $this->userModel = new User();
        }

        /**
         * Cerrar sesión
         * @return void
         */
        public function logout()
        {
            session_unset(); // Elimina todas las variables de sesión
            session_destroy(); // Destruye la sesión completamente
            exit; 
        }

        public function cerrarSesion()
        {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') return; 

            RespuestaJSON::exito('Sesión cerrada', null, '/login'); 
            $this->logout();
        }
        public function landingPage()
        {    
            require __DIR__ . '/../view/user/landing.php'; 
        }

        public function PyR() {
            require __DIR__ . '/../view/user/PyR.php'; 
        }

        public function admin() {
            require_once __DIR__ . '/../view/admin/dashboard.php';
        }

        public function loginPage()
        {
            
            $csrfTokenManager = new CsrfTokenManager(); 
            $token = $csrfTokenManager->getToken('user_login')->getValue(); 
            $_SESSION["login_csrf_token"] = $token; 

            require __DIR__ . '/../view/user/login.php'; 
        }

        public function registerPage()
        {
            $csrfTokenManager = new CsrfTokenManager(); 
            $token = $csrfTokenManager->getToken('user_register')->getValue(); 
            $_SESSION["register_csrf_token"] = $token; 

            require __DIR__ . '/../view/user/registro.php'; 
        }

        public function profilePage() {

            $csrfTokenManager = new CsrfTokenManager(); 
            $token = $csrfTokenManager->getToken('user_edit')->getValue(); 
            $_SESSION["editUser_csrf_token"] = $token; 

            require __DIR__ . '/../view/user/perfil.php'; 
        }

        public function validarLogin() {

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                RespuestaJSON::error("Metodo no permitido"); 
                return; 
            }

            $csrfTokenManager = new CsrfTokenManager();
            if (!$csrfTokenManager->isTokenValid(
                new CsrfToken('user_login', $_POST['csrf_token'] ?? '')
            )) {
                RespuestaJSON::error("Token CSRF inválido");
                return;
            }

            $camposValidos = Validador::validarCamposLoginUsuario(
                Security::sanitizeString($_POST["email"]),
                Security::sanitizeString($_POST["passwd"])
            ); 
            
            if (!$camposValidos) {
                RespuestaJSON::error('Los campos no son validos'); 
                return; 
            }

            try {
                v::arrayType()
                    ->key('email', v::email()->notEmpty()->setName('correo'))
                    ->key('passwd', v::stringType()->length(5, null)->setName('Contraseña'))
                    ->assert($_POST);  

                $user = Validador::existeUsuarioLogin(
                    $this->userModel->getAll(),
                    Security::sanitizeString($_POST["email"]),
                    Security::sanitizeString($_POST["passwd"])
                ); 

                $mensaje = $user ? 'Credenciales correctas' : 'Credenciales incorrectas'; 

                // Si no encuentra la cuenta se lo indicamos al usuario y termina el programa
                if (!$user) {
                    RespuestaJSON::error($mensaje);
                    return; 
                }

                // si encuentra el usuario comprobamos si es admin o usuario corriente 
                $redirect = $_SESSION["rol"] !== 2 ? '/perfil' : '/admin'; 
                RespuestaJSON::exito($mensaje, null, $redirect); 

            } catch (ValidationException $e) {
                // Devuelve todos los mensajes de error en un array simple
                $errores = $e->getMessage();
                RespuestaJSON::error("Errores de validación", $errores);
            }
        }

        public function validarRegistro() {

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                RespuestaJSON::error("Metodo no permitido"); 
                return; 
            }

            $csrfTokenManager = new CsrfTokenManager();
            if (!$csrfTokenManager->isTokenValid(
                new CsrfToken('user_register', $_POST['csrf_token'] ?? '')
            )) {
                RespuestaJSON::error("Token CSRF inválido");
                return;
            }

            $camposValidos = Validador::validarCamposRegistroUsuario(
                Security::sanitizeString($_POST["nombre"]), 
                Security::sanitizeString($_POST["email"]), 
                Security::sanitizeString($_POST["passwd"]), 
                Security::sanitizeString($_POST["tlf"])
            ); 

            if (!$camposValidos) {
                RespuestaJSON::error('Los campos no son validos'); 
                return; 
            }

            try {
                v::arrayType()
                    ->key('nombre', v::stringType()->length(3,15)->setName('username'))
                    ->key('email', v::email()->notEmpty()->setName('correo'))
                    ->key('passwd', v::stringType()->length(5, null)->setName('Contraseña'))
                    ->key('tlf', v::stringType()->length(9,9)->setName('tlf'))
                    ->assert($_POST);  

                $user = Validador::existelUsuarioRegistro(
                    $this->userModel->getAll(), 
                    Security::sanitizeString($_POST["email"])
                ); 

                if ($user) {
                    RespuestaJSON::error('Este usuario ya existe');  
                    return; 
                }

                Sessions::crearSesionLogueado();
                Sessions::crearSesionUsername($_POST["nombre"]);  
                Sessions::crearSesionIdUsuario($this->userModel->create(
                [
                    'nombre' => $_POST["nombre"],
                    'email' => $_POST["email"],
                    'passwd' => password_hash($_POST["passwd"], PASSWORD_DEFAULT),
                    'tlf' => $_POST["tlf"],
                    'codigo_militar' => '',
                    'rol_id' => 1
                ]
            ));
                RespuestaJSON::exito('Usuario creado', null, '/perfil');

                

            } catch (ValidationException $e) {
                // Devuelve todos los mensajes de error en un array simple
                $errores = $e->getMessage();
                RespuestaJSON::error("Errores de validación", $errores);
            }
            
        }

        public function editUser() {

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                RespuestaJSON::error("Metodo no permitido"); 
                return; 
            }

            $camposValidos = Validador::validarNombre($_POST["input_0"]) 
            && Validador::validarEmail($_POST["input_1"]) 
            && Validador::validarTelefono($_POST["input_2"]); 

            if (!$camposValidos) {
                RespuestaJSON::error('Los campos no son validos'); 
                return; 
            }

             // comprobar que al cambiar el email el email ya esta asignado a otro usuario
            $usuarioExistente = $this->userModel->getByEmail($_POST['input_1']);

            if ($usuarioExistente && $usuarioExistente['id'] != $_SESSION["id_usuario"]) {
                RespuestaJSON::error('El correo electrónico ya está registrado por otro usuario'); 
                return;
            }

            try {

                $this->userModel->update(
                    [
                        'nombre' => $_POST["input_0"],
                        'email' => $_POST["input_1"],
                        'tlf' => $_POST["input_2"]
                    ], 
                $_SESSION["id_usuario"]);

                RespuestaJSON::exito('Usuario actualizado'); 

            } catch (ValidationException $e) {
                // Devuelve todos los mensajes de error en un array simple
                $errores = $e->getMessage();
                RespuestaJSON::error("Errores de validación", $errores);
            }
        }

        public function getUserInfo() {
            echo json_encode(['user'=> $this->userModel->getById($_SESSION["id_usuario"])]); 
        }

        /**
         * 
         * Comprobar si un usuario esta logueado
         * @return void
         */
        public function estaLogueado()
        {
            if (Security::estaLogueado()) {
                $rol = ['rol' => $this->userModel->getUserRol($_SESSION["id_usuario"])['rol_id']];
                echo json_encode($rol);
            } else {
                echo json_encode(['rol' => false]);
            }
        }

        /**
         * Enviar la información de todos los usuarios al JS
         * @return void
         */
        public function getAllUsers()
        {
            echo json_encode(['usuarios' => $this->userModel->getAll()]);
        }
    }

?>