<?php 
    namespace App\Model;

    use Core\EmptyModel;
    use PDO;
    use PDOException; 

    class Reserva extends EmptyModel {

        public function __construct() {
            parent::__construct('reserva'); 
        }

    }
?>