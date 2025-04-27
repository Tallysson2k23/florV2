<?php
require_once __DIR__ . '/../../config/database.php';

class Usuario {
    private $conn;
    private $table_name = "usuarios";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function login($email, $senha) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return $usuario;
        }

        return false;
    }

    public function criar($nome, $email, $senha, $tipo) {
        $query = "INSERT INTO usuarios (nome, email, senha, tipo) VALUES (:nome, :email, :senha, :tipo)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':tipo', $tipo);
        return $stmt->execute();
    }
    
    public function listar() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrar($nome, $email, $senha, $nivel_acesso) {
        $query = "INSERT INTO " . $this->table_name . " (nome, email, senha, nivel_acesso) 
                  VALUES (:nome, :email, :senha, :nivel_acesso)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':nivel_acesso', $nivel_acesso);

        return $stmt->execute();
    }

    public function buscarTodos() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>
