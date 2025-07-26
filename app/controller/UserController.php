<?php 


    namespace App\Controller;
    
    use App\Model\User;
    use Core\Services\GoogleAuth;
    use Core\Utilities\RespuestaJSON;
    use Core\Utilities\Security;
    use Core\utilities\Sessions;
    use Core\utilities\Validador;
    use Exception;
    use Symfony\Component\Security\Csrf\CsrfTokenManager;
    use Symfony\Component\Security\Csrf\CsrfToken;
    use Respect\Validation\Validator as v;
    use \Respect\Validation\Exceptions\ValidationException; 
    use Core\Services\EmailService; 
    

    class UserController{
        private $userModel; 
        private $googleAuth; 
        private $mailService; 

        public function __construct() {
            $this->userModel = new User();
            $this->googleAuth = new GoogleAuth();
            $this->mailService = new EmailService();
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

            if ($_SESSION["rol"] !== 2) header('Location: /CampoLibre/public/');

            $csrfTokenManager = new CsrfTokenManager(); 
            $token = $csrfTokenManager->getToken('edit_campo')->getValue(); 
            $_SESSION["editCampo_csrf_token"] = $token;

            require_once __DIR__ . '/../view/admin/dashboard.php';
        }

        /**
         * MÉTODO PARA INICIAR EL PROCESO DE GOOGLE LOGIN
         * @return void
         */
        public function googleLogin() {
            
            $this->googleAuth->redirectToGoogle();
        }

        /**
         * MÉTODO CALLBACK QUE RECIBE LA RESPUESTA DE GOOGLE
         * @return void
         */
        public function googleCallback() {
         
            if (!isset($_GET["code"])) {
                RespuestaJSON::error("Error en la autenticación");
                return;  
            }

             try {
                
                $userData = $this->googleAuth->handleCallback($_GET['code']);
                $this->procesarGoogleUser($userData);
                
            } catch (Exception $e) {
                RespuestaJSON::error('Error: ' . $e->getMessage());
            }

        }

        /**
         * MÉTODO PARA PROCESAR EL USUARIO DE GOOGLE
         * @param mixed $googleUser
         * @return void
         */
        public function procesarGoogleUser($googleUser) {

            $email = $googleUser['email'];
            $nombre = $googleUser['name'] ?? $googleUser['given_name'] ?? 'Usuario';
            
            // Verificar si el usuario ya existe
            $usuarioExistente = $this->userModel->getByEmail($email);
            
            if ($usuarioExistente) {
                // Usuario existe - crear sesión como en validarLogin()
                Sessions::crearSesionLogueado();
                Sessions::crearSesionUsername($usuarioExistente['nombre']);
                Sessions::crearSesionEmail($usuarioExistente['email']);
                Sessions::crearSesionIdUsuario($usuarioExistente['id']);
                Sessions::crearSesionRol($usuarioExistente['rol_id']);  
                
                $redirect = $usuarioExistente['rol_id'] !== 2 ? '/CampoLibre/public/campos' : '/CampoLibre/public/admin';
                
            } else {
                // Usuario no existe - registrarlo como en validarRegistro()
                $nuevoUsuarioId = $this->userModel->create([
                    'nombre' => $nombre,
                    'email' => $email,
                    'passwd' => password_hash(uniqid(), PASSWORD_DEFAULT), // Password aleatoria para usuarios de Google
                    'tlf' => '', // Campo vacío para usuarios de Google
                    'codigo_militar' => '',
                    'rol_id' => 1
                ]);
                
                // Crear sesión para el nuevo usuario
                Sessions::crearSesionLogueado();
                Sessions::crearSesionUsername($nombre);
                Sessions::crearSesionEmail($email); 
                Sessions::crearSesionIdUsuario($nuevoUsuarioId);
                $_SESSION["rol"] = 1;
                
                $redirect = '/CampoLibre/public/campos';
            }

            // enviar correo de bienvenida
            try {
                $this->mailService->enviarBienvenidaGoogle($email, $nombre);
            } catch (Exception $e) {
                error_log("Error enviando email de Google: " . $e->getMessage());
            }
            
            // Redirigir según el rol del usuario
            header('Location: ' . $redirect);
            exit;
        }

        /**
         * RENDERIZA LA VISTA DE LOGIN
         * @return void
         */
        public function loginPage()
        {
            
            $csrfTokenManager = new CsrfTokenManager(); 
            $token = $csrfTokenManager->getToken('user_login')->getValue(); 
            $_SESSION["login_csrf_token"] = $token; 

            require __DIR__ . '/../view/user/login.php'; 
        }

        /**
         * RENDERIZA LA VISTA DE REGISTRO
         * @return void
         */
        public function registerPage()
        {
            $csrfTokenManager = new CsrfTokenManager(); 
            $token = $csrfTokenManager->getToken('user_register')->getValue(); 
            $_SESSION["register_csrf_token"] = $token; 

            require __DIR__ . '/../view/user/registro.php'; 
        }

        /**
         * RENDERIZA LA VISTA DE PERFIL DE USUARIO
         * @return void
         */
        public function profilePage() {

            $csrfTokenManager = new CsrfTokenManager(); 
            $token = $csrfTokenManager->getToken('user_edit')->getValue(); 
            $_SESSION["editUser_csrf_token"] = $token; 

            require __DIR__ . '/../view/user/perfil.php'; 
        }

        /**
         * VALIDAR LOGIN DE USUARIO
         * @return void
         */
        public function validarLogin() {

            Validador::validarMetodoHTTP('POST');

            $csrfTokenManager = new CsrfTokenManager();
            if (!$csrfTokenManager->isTokenValid(new CsrfToken('user_login', $_POST['csrf_token'] ?? ''))) {
                RespuestaJSON::error("Token CSRF inválido");
                return;
            }

            $camposValidos = Validador::validarCamposLoginUsuario(
                Security::sanitizeString($_POST["email"]),
                Security::sanitizeString($_POST["passwd"])
            ); 
            
            // validamos los campos del formulario de login
            if (!$camposValidos) {
                RespuestaJSON::error('Los campos no son validos'); 
                return; 
            }

            try {
                v::arrayType()
                    ->key('email', v::email()->notEmpty()->setName('correo'))
                    ->key('passwd', v::stringType()->length(5, null)->setName('Contraseña'))
                    ->assert($_POST);  

                // Comprobamos que el usuario existe 
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
                $redirect = $_SESSION["rol"] !== 2 ? '/campos' : '/admin';

                $this->mailService->enviarBienvenidaLogin($_POST["email"], $_SESSION["nombre_usuario"]);

                // Indicamos al JS que tooo ha ido con exito
                RespuestaJSON::exito($mensaje, null, $redirect); 


                

            } catch (ValidationException $e) {
                // Devuelve todos los mensajes de error en un array simple
                $errores = $e->getMessage();
                RespuestaJSON::error("Errores de validación", $errores);
            }
        }

        /**
         * VALIDAR REGISTRO DE USUARIO
         * @return void
         */
        public function validarRegistro() {

            Validador::validarMetodoHTTP('POST');

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
                Sessions::crearSesionEmail($_POST["email"]);
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

                // enviamos un email de bienvenida 
                $this->mailService->enviarBienvenidaRegistro($_POST["email"], $_POST["nombre"]);

                // indicamos respuesta de exito
                RespuestaJSON::exito('Usuario creado', null, '/campos');

                

            } catch (ValidationException $e) {
                // Devuelve todos los mensajes de error en un array simple
                $errores = $e->getMessage();
                RespuestaJSON::error("Errores de validación", $errores);
            }
            
        }

        public function editUser() {

            Validador::validarMetodoHTTP('POST');

            $camposValidos = Validador::validarNombre(Security::sanitizeString($_POST["input_0"])) 
            && Validador::validarEmail(Security::sanitizeString($_POST["input_1"])) 
            && Validador::validarTelefono(Security::sanitizeString($_POST["input_2"])); 

            if (!$camposValidos) {
                RespuestaJSON::error('Los campos no son validos'); 
                return; 
            }

             // comprobar que al cambiar el email si el email ya esta asignado a otro usuario
            $usuarioExistente = $this->userModel->getByEmail($_POST['input_1']);

            if ($usuarioExistente && $usuarioExistente['id'] != $_SESSION["id_usuario"]) {
                RespuestaJSON::error('Este correo ya está registrado'); 
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

        public function deleteUser() {

            // Validar que el método sea POST
            Validador::validarMetodoHTTP('POST');

            // comprobar si esta logueado
            if (!Security::estaLogueado()) {
                RespuestaJSON::error("No estás logueado");
                return;
            }

            // Comprobar si el usuario es admin
            if ($_SESSION["rol"] !== 2) {
                RespuestaJSON::error("No tienes permisos para eliminar usuarios");
                return;
            }
        
            $this->userModel->delete($_POST['id_usuario']);
            RespuestaJSON::exito('Usuario eliminado correctamente');
            
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