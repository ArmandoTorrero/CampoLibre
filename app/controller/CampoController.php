<?php 
    namespace App\Controller;
    use App\Model\Campo;

    class CampoController {

        private $campoModel;

        public function __construct() {
            $this->campoModel = new Campo();
        }

        /**
         * Funcion para enviar al JS todos los campos de la BBDD
         * @return void
         */
        public function getCampos() {
            $campos = ['campos' => $this->campoModel->getAll()]; 
            echo json_encode($campos); 
        }

    }
?>