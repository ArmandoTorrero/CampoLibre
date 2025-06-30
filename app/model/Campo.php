<?php 
    namespace App\Model;

    use Core\EmptyModel;
    use PDO;
    use PDOException; 

    class Campo extends EmptyModel {

        public function __construct() {
            parent::__construct('pista'); 
        }

        public function getCampo($campo,$categoria) {

            try {
                $palabra = trim($campo) . '%'; 

                // Si la categoria es 0, no se filtra por categoria

                if ($categoria != 0) {
                    $sql = "SELECT * FROM pista WHERE nombre LIKE :campo AND modalidad_id = :categoria";
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindParam(':campo', $palabra);
                    $stmt->bindParam(':categoria', $categoria);
                } else {
                    $sql = "SELECT * FROM pista WHERE nombre LIKE :campo";
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindParam(':campo', $palabra);
                }

                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                error_log('Error en la busqueda: ' . $e->getMessage()); 
                return []; 
            }

            
        }

    }
?>