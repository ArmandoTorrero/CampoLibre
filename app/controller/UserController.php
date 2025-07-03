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

        public function landingPage()
        {    
            require __DIR__ . '/../view/user/landing.php'; 
        }


        /**
         * Enviar la información de todos los usuarios al JS
         * @return void
         */
        public function getAllUsers()
        {
            echo json_encode(['usuarios' => $this->userModel->getAll()]);
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

                if ($user) {
                    Sessions::crearSesionLogueado(); 
                    RespuestaJSON::exito('Credenciales correctas', null, "/perfil"); 
                    
                } else {
                    RespuestaJSON::error('Credenciales incorrectas'); 
                }

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
            try {
                v::arrayType()
                    ->key('nombre', v::stringType()->length(3,15)->setName('username'))
                    ->key('email', v::email()->notEmpty()->setName('correo'))
                    ->key('passwd', v::stringType()->length(5, null)->setName('Contraseña'))
                    ->key('tlf', v::stringType()->length(9,9)->setName('tlf'))
                    ->assert($_POST);  

                $user = Validador::existelUsuarioRegistro(
                    $this->userModel->getAll(), 
                    $_POST["email"]
                ); 

                if (!$user) {
                    Sessions::crearSesionLogueado();
                    Sessions::crearSesionUsername($_POST["nombre"]);  
                    RespuestaJSON::exito('Usuario creado'); 
                } else {
                    RespuestaJSON::error('Este usuario ya existe'); 
                }

            } catch (ValidationException $e) {
                // Devuelve todos los mensajes de error en un array simple
                $errores = $e->getMessage();
                RespuestaJSON::error("Errores de validación", $errores);
            }
            
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
    }

?>