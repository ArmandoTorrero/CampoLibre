<?php 
    namespace App\Controller;

    use App\Model\User;

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
    }

?>