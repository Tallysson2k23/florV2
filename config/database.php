<?php
class Database {
    private $host = "localhost";
    private $db_name = "loja";
    private $username = "postgres";
    private $password = "159357";
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "pgsql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Erro na conexão: " . $exception->getMessage();
        }

        return $this->conn;
    }

    
    public static function conectar() {
        $db = new self();
        return $db->getConnection();
    }
    
    
    
}
?>
