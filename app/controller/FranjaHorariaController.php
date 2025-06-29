<?php 

    namespace App\Controller;

    use App\Model\Franja_horaria;

    class FranjaHorariaController {

        private $franjaHorariaModel;

        public function __construct() {
            $this->franjaHorariaModel = new Franja_horaria();
        }

        
    }
?>