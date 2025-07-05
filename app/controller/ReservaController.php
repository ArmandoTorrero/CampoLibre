<?php 
    namespace App\Controller;

    use App\Model\Reserva;
    use Core\Utilities\RespuestaJSON;

    class ReservaController {

        private $reservaModel;

        public function __construct() {
            $this->reservaModel = new Reserva();
        }

        public function getAll() {
            echo json_encode(['reservas' => $this->reservaModel->getReservasByUserId($_SESSION["id_usuario"])]); 
        }

        public function validarReserva()  {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                RespuestaJSON::exito("Reservada realizada con exito"); 
            }else{
                RespuestaJSON::error("Error al recibir los datos"); 
            }
        }
        
    }

?>