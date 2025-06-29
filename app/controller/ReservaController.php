<?php 
    namespace App\Controller;

    use App\Model\Reserva;

    class ReservaController {

        private $reservaModel;

        public function __construct() {
            $this->reservaModel = new Reserva();
        }

        
    }

?>