<?php 
    namespace App\Model;

    use Core\EmptyModel;
    use PDO;
    use PDOException; 

    class Franja_horaria extends EmptyModel {

        public function __construct() {
            parent::__construct('franja_horaria'); 
        }

    }
?>