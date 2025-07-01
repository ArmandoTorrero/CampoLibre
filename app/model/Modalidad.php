<?php 

    namespace App\Model;

    use Core\EmptyModel;
    use PDO;
    use PDOException; 

    class Modalidad extends EmptyModel{

        public function __construct() {
            parent::__construct('modalidad'); 
        }
    }
?>