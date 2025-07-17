<?php 
    namespace App\Controller;
    use App\Model\Campo;
    use Core\Utilities\Security;
    use Core\utilities\Sessions;
    use Symfony\Component\Security\Csrf\CsrfTokenManager;
    use Symfony\Component\Security\Csrf\CsrfToken;

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

        public function getCampoByfiltro() {
            $datos = json_decode(file_get_contents("php://input"), true);

            if ($datos) {
                echo json_encode(['campos'=> $this->campoModel->getCampo($datos['nombre_campo'], $datos['id_categoria'])]);   
            }else {
                echo json_encode(['error' => 'Error al recibir los datos']); 
            }
        }

        public function reservarCampo() {

            $campo = $this->campoModel->getById($_GET["id_campo"]); 

            // comprobamos que el campo existe y esta disponoble, en caso contrario redirgimos al usuario

            $campo && $campo['disponible'] == 1 ? 
            Sessions::crearSesionIdCampo($_GET["id_campo"]) :
            Security::redirigir('/CampoLibre/public/campos');

            // cremaos el token 
            $csrfTokenManager = new CsrfTokenManager(); 
            $token = $csrfTokenManager->getToken('user_reserva')->getValue(); 
            $_SESSION["reserva_csrf_token"] = $token; 


            require __DIR__ . '/../view/campos/reservarCampo.php'; 
        }

        public function getCampoById() {
            echo json_encode(['info_campo' => $this->campoModel->getById($_SESSION["id_campo"])]); 
        }

        

    }
?>