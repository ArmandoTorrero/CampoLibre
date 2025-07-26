<?php 
    namespace App\Controller;
    use App\Model\Campo;
    use Core\Utilities\RespuestaJSON;
    use Core\Utilities\Security;
    use Core\utilities\Sessions;
    use Core\utilities\Validador;
    use Exception;
    use Symfony\Component\Security\Csrf\CsrfToken;
    use Symfony\Component\Security\Csrf\CsrfTokenManager;

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
            $_SESSION["nombre_campo"] = $campo['nombre'];

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

            $datos = json_decode(file_get_contents("php://input"), true);

            if (!isset($datos['id_campo']) || empty($datos['id_campo'])) {
                echo json_encode(['info_campo' => $this->campoModel->getById($_SESSION["id_campo"])]); 
                return; 
            }

            echo json_encode(['info_campo' => $this->campoModel->getById($datos['id_campo'])]);

        }

        public function deleteCampo(){
            // Validar que el método sea POST
            Validador::validarMetodoHTTP('POST');

            // comprobar si esta logueado
            if (!Security::estaLogueado()) {
                RespuestaJSON::error("No estás logueado");
                return;
            }

            // Comprobar si el usuario es admin
            if ($_SESSION["rol"] !== 2) {
                RespuestaJSON::error("No tienes permisos para eliminar campos");
                return;
            }

            try {
                $this->campoModel->delete($_POST["id_campo"]);
                RespuestaJSON::exito("Campo eliminado correctamente");
            } catch (Exception $e) {
                RespuestaJSON::error("Error al eliminar el campo: " . $e->getMessage());
                return;
            }
        }

        public function editCampo() {
            
            Validador::validarMetodoHTTP('POST');

            $csrfTokenManager = new CsrfTokenManager();
            if (!$csrfTokenManager->isTokenValid(new CsrfToken('edit_campo', $_POST['csrf_token'] ?? ''))) {
                RespuestaJSON::error("Token CSRF inválido");
                return;
            }

            $this->campoModel->update(
                [
                    'nombre' => $_POST["nombre_campo"],
                    'disponible' => $_POST["disponibilidad"],
                    'modalidad_id' => $_POST["modalidad"]
                ], $_POST["id_campo"]
            );

            RespuestaJSON::exito("Campo editado correctamente");
        }

        

    }
?>