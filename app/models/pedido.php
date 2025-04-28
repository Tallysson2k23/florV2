<?php
require_once __DIR__ . '/../../config/database.php';

class Pedido {
    private $conn;
    private $table_name = "pedidos";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function criar($nome, $tipo, $numero_pedido, $quantidade, $produto, $complemento, $obs, $data) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (nome, tipo, numero_pedido, quantidade, produto, complemento, obs, data)
                  VALUES (:nome, :tipo, :numero_pedido, :quantidade, :produto, :complemento, :obs, :data)";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':numero_pedido', $numero_pedido);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':produto', $produto);
        $stmt->bindParam(':complemento', $complemento);
        $stmt->bindParam(':obs', $obs);
        $stmt->bindParam(':data', $data);

        return $stmt->execute();
    }
}
?>
