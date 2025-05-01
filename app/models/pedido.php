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
                  (nome, tipo, numero_pedido, quantidade, produto, complemento, obs, data_abertura)
                  VALUES (:nome, :tipo, :numero_pedido, :quantidade, :produto, :complemento, :obs, :data_abertura)";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':numero_pedido', $numero_pedido);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':produto', $produto);
        $stmt->bindParam(':complemento', $complemento);
        $stmt->bindParam(':obs', $obs);
        $stmt->bindParam(':data_abertura', $data);

        return $stmt->execute();
    }

    public function listarRecentes($limite = 5) {
        $sql = "SELECT * FROM pedidos ORDER BY data_abertura DESC LIMIT :limite";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarTodosOrdenadosPorData()
{
    $sql = "SELECT * FROM pedidos ORDER BY data_abertura DESC";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function atualizarStatus($id, $status) {
    $pdo = Database::getInstance();

    $stmt = $pdo->prepare("UPDATE pedidos SET status = :status WHERE id = :id");
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
}



}
?>
