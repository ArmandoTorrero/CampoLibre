<?php 
    namespace App\Model;

    use Core\EmptyModel;
    use PDO;
    use PDOException; 
    use Exception; 

    class User extends EmptyModel{

        public function __construct() {
            parent::__construct('usuario'); 
        }

        /**
         * Obtener el rol de un usuario
         * @param int $id_usuario
         * @return array
         */
        public function getUserRol($id_usuario) 
        {
            try {
                $sql = "SELECT rol_id FROM usuario WHERE id = :id_usuario";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':id_usuario', $id_usuario);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            
            } catch (PDOException $e) {
                throw new Exception("Error" . $e->getMessage()); 
            }

        }
    }
?>