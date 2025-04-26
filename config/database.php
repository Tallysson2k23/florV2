<?php
class Database {
    private $host = "localhost";
    private $port = "5432"; // adiciona a porta do PostgreSQL
    private $db_name = "loja";
    private $username = "postgres";
    private $password = "159357"; // sua senha
    public $conn;

    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "pgsql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            // Ativar erros no PDO
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Erro na conexão: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
