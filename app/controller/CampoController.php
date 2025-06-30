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

        public function camposPage() {
            require __DIR__ . '/../view/campos/campos.php'; 
        }

        public function getCampo() {
            $datos = json_decode(file_get_contents("php://input"), true);

            if ($datos) {
                echo json_encode(['campos'=> $this->campoModel->getCampo($datos['nombre_campo'], $datos['id_categoria'])]);   
            }else {
                echo json_encode(['error' => 'Error al recibir los datos']); 
            }
        }

    }
?>