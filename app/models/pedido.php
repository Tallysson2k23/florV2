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
        $status = 'Pendente';

        $stmt = $this->conn->query("SELECT MAX(ordem_fila) as max_fila FROM pedidos");
        $maxOrdem = $stmt->fetch(PDO::FETCH_ASSOC)['max_fila'] ?? 0;
        $novaOrdem = $maxOrdem + 1;

        $query = "INSERT INTO " . $this->table_name . " 
                  (nome, tipo, numero_pedido, quantidade, produto, complemento, obs, data_abertura, status, ordem_fila)
                  VALUES (:nome, :tipo, :numero_pedido, :quantidade, :produto, :complemento, :obs, :data_abertura, :status, :ordem_fila)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':numero_pedido', $numero_pedido);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':produto', $produto);
        $stmt->bindParam(':complemento', $complemento);
        $stmt->bindParam(':obs', $obs);
        $stmt->bindParam(':data_abertura', $data);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':ordem_fila', $novaOrdem, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function listarRecentes($limite = 5) {
        $sql = "SELECT * FROM pedidos ORDER BY data_abertura DESC LIMIT :limite";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarTodosOrdenadosPorData() {
        $sql = "SELECT id, nome, tipo, produto, quantidade, complemento, obs, data_abertura, status, ordem_fila 
                FROM pedidos ORDER BY ordem_fila DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function atualizarStatus($id, $status) {
        $sql = "UPDATE pedidos SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function listarTodos() {
        $sql = "SELECT * FROM pedidos ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $sql = "SELECT * FROM pedidos WHERE id = :id";
        $stmt = $this->conn->prepare($sql); // <-- corrigido: usava $this->db
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
