<?php
class Database {
    private $host = "localhost";
    private $db_name = "loja";
    private $username = "postgres";
    private $password = "159357"; // Coloque a senha que você criou na instalação
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("pgsql:host=" . $this->host . ";dbname=" . $this->db_name,
                                  $this->username, $this->password);

            // Ativar erros no PDO (importante para debugar)
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Erro na conexão: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
