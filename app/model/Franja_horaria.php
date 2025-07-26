<?php 
    namespace App\Model;

    use Core\EmptyModel;
    use PDO;
    use PDOException; 
    use Exception; 

    class Franja_horaria extends EmptyModel {

        public function __construct() {
            parent::__construct('franja_horaria'); 
        }

        public function getHorariosByFecha($fecha,$id)
        {
            try {
                $sql = "SELECT * FROM franja_horaria WHERE fecha = :fecha AND pista_id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':fecha', $fecha);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
                
            } catch (PDOException $e) {
                throw new Exception("Error" . $e->getMessage()); 
            }
        }

        public function getHorarioByFechaHora($fecha, $hora,$id_campo)
        {
            try {
                $sql = "SELECT * FROM franja_horaria WHERE fecha = :fecha AND hora_inicio = :hora AND pista_id = :id_campo";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':hora', $hora);
                $stmt->bindParam(':fecha', $fecha);
                $stmt->bindParam(':id_campo', $id_campo);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
                
            } catch (PDOException $e) {
                throw new Exception("Error" . $e->getMessage()); 
            }
        }

    }
?>