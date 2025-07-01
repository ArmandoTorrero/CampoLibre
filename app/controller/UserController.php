<?php 
    namespace App\Controller;

    use App\Model\User;
    use Core\Utilities\Security;

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
            require __DIR__ . '/../view/user/login.php'; 
        }

        public function registerPage()
        {
            require __DIR__ . '/../view/user/registro.php'; 
        }

        public function validarLogin() {

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                echo json_encode(['exito'=>true,'mensaje' => "exito"]); 
            }else{
                echo json_encode(['exito'=>false,'mensaje' => "no exito"]); 
            }
        }

        public function validarRegistro() {

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                echo json_encode(['exito'=>true,'mensaje' => "exito"]); 
            }else{
                echo json_encode(['exito'=>false,'mensaje' => "no exito"]); 
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