<?php 
    namespace App\Controller;

    use App\Model\User;

    class UserController{
        private $userModel; 

        public function __construct() {
            $this->userModel = new User();
        }

        public function hola() {
            var_dump($this->userModel->getAll());  
        }

        public function landingPage()
        {    
            require __DIR__ . '/../view/user/landing.php'; 
        }
    }

?>