<?php 
    namespace App\Controller;

    use App\Model\Franja_horaria;
    use App\Model\Reserva;
    use Core\Utilities\RespuestaJSON;
    use Core\utilities\Validador;

    class ReservaController {

        private $reservaModel;
        private $franjaHorariaModel; 

        public function __construct() {
            $this->reservaModel = new Reserva();
            $this->franjaHorariaModel = new Franja_horaria();
        }

        public function getAll() {
            echo json_encode(['reservas' => $this->reservaModel->getReservasByUserId($_SESSION["id_usuario"])]); 
        }

        public function validarReserva()  {

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                RespuestaJSON::error("Metodo no permitido"); 
                return; 
            }

            $camposValidos = Validador::validarCamposTarjetaCredito(
                $_POST["num-tarjeta"], 
                $_POST["expiracion"], 
                $_POST["cvc"], 
                $_POST["titular"]
            ); 

            if(!$camposValidos){
                RespuestaJSON::error('Los datos no son validos'); 
                return; 
            }; 

            $horarioID = $this->franjaHorariaModel->create([
                'fecha' => $_POST["fecha"],
                'hora_inicio' => $_POST["horario"],
                'disponible' => 0,
                'pista_id' => $_SESSION["id_campo"]
            ]);

            $this->reservaModel->create([
                'usuario_id' => $_SESSION["id_usuario"],
                'metodo_pago' => 'tarjeta', 
                'franja_horaria_id' => $horarioID
            ]);

            RespuestaJSON::exito('Reserva realizada con exito', null, '/perfil'); 

        }
        
    }

?>