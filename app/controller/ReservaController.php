<?php 
    namespace App\Controller;

    use App\Model\Franja_horaria;
    use App\Model\Reserva;
use Core\Services\EmailService;
use Core\Utilities\RespuestaJSON;
    use Core\utilities\Validador;
    use Respect\Validation\Rules\Email;
    use Symfony\Component\Security\Csrf\CsrfTokenManager;
    use Symfony\Component\Security\Csrf\CsrfToken;

    class ReservaController {

        private $reservaModel;
        private $franjaHorariaModel; 
        private $emailService;

        public function __construct() {
            $this->reservaModel = new Reserva();
            $this->franjaHorariaModel = new Franja_horaria();
            $this->emailService = new EmailService();
        }

        /**
         * Validar la reserva realizada por un usuario
         * @return void
         */
        public function validarReserva()  {

            Validador::validarMetodoHTTP('POST'); 

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

            $horario = $this->franjaHorariaModel->getHorarioByFechaHora($_POST["fecha"], $_POST["horario"], $_SESSION["id_campo"]); 

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

            // Enviamos un email de confirmación al usuario
            $this->emailService->enviarConfirmacionReserva(
                $_SESSION["email"], 
                $_SESSION["nombre_usuario"],
                $_POST["fecha"],
                $_POST["horario"],
                $_SESSION["nombre_campo"] 
            );

            // Respuesta exitosa
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