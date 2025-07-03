<?php 

    namespace App\Controller;

    use App\Model\Franja_horaria;

    class FranjaHorariaController {

        private $franjaHorariaModel;

        public function __construct() {
            $this->franjaHorariaModel = new Franja_horaria();
        }

        /**
         * Obtener horarios por fecha
         * @return void
         */
        public function getHorariosByFecha()
        {
            $datos = json_decode(file_get_contents("php://input"), true);

            if ($datos && isset($datos['fecha'])) {
                $fecha = $datos['fecha'];
                echo json_encode(['horarios' => $this->franjaHorariaModel->getHorariosByFecha($fecha)]);
            } else {
                echo json_encode(['error' => 'No se recibió una fecha válida']);
            }
    }

        
    }
?>