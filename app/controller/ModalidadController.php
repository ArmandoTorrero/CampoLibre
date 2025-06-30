<?php 

    namespace App\Controller;

    use App\Model\Modalidad; 

    class ModalidadController  {

        private $modalidadModel; 

        public function __construct() {
            $this->modalidadModel = new Modalidad(); 
        }

        public function getModalidades() {
            echo json_encode(['modalidades' => $this->modalidadModel->getAll()]);
        }
    }
?>