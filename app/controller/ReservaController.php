<?php 
    namespace App\Controller;

    use App\Model\Franja_horaria;
    use App\Model\Reserva;
    use Core\Utilities\RespuestaJSON;
    use Core\utilities\Validador;
    use Symfony\Component\Security\Csrf\CsrfTokenManager;
    use Symfony\Component\Security\Csrf\CsrfToken;

    class ReservaController {

        private $reservaModel;
        private $franjaHorariaModel; 

        public function __construct() {
            $this->reservaModel = new Reserva();
            $this->franjaHorariaModel = new Franja_horaria();
        }

        /**
         * Validar la reserva realizada por un usuario
         * @return void
         */
        public function validarReserva()  {

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                RespuestaJSON::error("Metodo no permitido"); 
                return; 
            }

            $csrfTokenManager = new CsrfTokenManager();
            if (!$csrfTokenManager->isTokenValid(
                new CsrfToken('user_reserva', $_POST['csrf_token'] ?? '')
            )) {
                RespuestaJSON::error("Token CSRF inválido");
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

            $horario = $this->franjaHorariaModel->getHorarioByFechaHora($_POST["fecha"], $_POST["horario"]); 

            if ($horario) {
                RespuestaJSON::error('Horario no disponible');
                return;  
            }
            
            // creamos el horario en la tabla 'franja_horaria' y lo deshabilitamos
            $horarioID = $this->franjaHorariaModel->create([
                'fecha' => $_POST["fecha"],
                'hora_inicio' => $_POST["horario"],
                'disponible' => 0,
                'pista_id' => $_SESSION["id_campo"]
            ]);

            // creamos la reserva
            $this->reservaModel->create([
                'usuario_id' => $_SESSION["id_usuario"],
                'metodo_pago' => 'tarjeta', 
                'franja_horaria_id' => $horarioID
            ]);

            RespuestaJSON::exito('Reserva realizada con exito', null); 

        }

        public function getAllReservasByUser() {
            echo json_encode(['reservas' => $this->reservaModel->getReservasByUserId($_SESSION["id_usuario"])]); 
        }

        public function getAll() {
            echo json_encode(['reservas' => $this->reservaModel->getReservas()]);  
        }
        
    }

?>