<?php
require_once __DIR__ . '/../../config/database.php';

class Pedido {
    private $conn;
    private $table_name = "pedidos";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function criar($nome, $tipo, $numero_pedido, $quantidade, $produto, $complemento, $obs, $data,
                      $telefone_remetente = null, $destinatario = null, $telefone_destinatario = null,
                      $endereco = null, $numero_endereco = null, $bairro = null, $referencia = null,
                      $telefone = null, $adicionais = null)
{
    $status = 'Pendente';

    // Pega o valor máximo da ordem atual para manter a fila correta
    $stmtOrdem = $this->conn->query("SELECT MAX(ordem_fila) as max_fila FROM pedidos");
    $maxOrdem = $stmtOrdem->fetch(PDO::FETCH_ASSOC)['max_fila'] ?? 0;
    $novaOrdem = $maxOrdem + 1;

    // Prepara o INSERT com todos os campos, inclusive os novos
    $query = "
        INSERT INTO pedidos (
            nome, tipo, numero_pedido, quantidade, produto, complemento, observacao, data_abertura, status, ordem_fila,
            telefone_remetente, destinatario, telefone_destinatario, endereco, numero_endereco, bairro, referencia,
            telefone, adicionais
        ) VALUES (
            :nome, :tipo, :numero_pedido, :quantidade, :produto, :complemento, :observacao, :data_abertura, :status, :ordem_fila,
            :telefone_remetente, :destinatario, :telefone_destinatario, :endereco, :numero_endereco, :bairro, :referencia,
            :telefone, :adicionais
        )
    ";

    $stmt = $this->conn->prepare($query);

    return $stmt->execute([
        ':nome' => $nome,
        ':tipo' => $tipo,
        ':numero_pedido' => $numero_pedido,
        ':quantidade' => $quantidade,
        ':produto' => $produto,
        ':complemento' => $complemento,
        ':observacao' => $obs,
        ':data_abertura' => $data,
        ':status' => $status,
        ':ordem_fila' => $novaOrdem,
        ':telefone_remetente' => $telefone_remetente,
        ':destinatario' => $destinatario,
        ':telefone_destinatario' => $telefone_destinatario,
        ':endereco' => $endereco,
        ':numero_endereco' => $numero_endereco,
        ':bairro' => $bairro,
        ':referencia' => $referencia,
        ':telefone' => $telefone,
        ':adicionais' => $adicionais
    ]);
}


    public function listarRecentes($limite = 5) {
        $sql = "SELECT * FROM pedidos ORDER BY data_abertura DESC LIMIT :limite";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarTodosOrdenadosPorData() {
        $sql = "SELECT id, nome, tipo, produto, quantidade, complemento, observacao, data_abertura, status, ordem_fila 
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
    $sql = "SELECT * FROM pedidos WHERE id = :id LIMIT 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); // define tipo INT por segurança
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


    public function obterUltimoNumeroPedido() {
        $stmt = $this->conn->query("SELECT MAX(numero_pedido) AS max_num FROM pedidos");
        $result = $stmt->fetch();
        return $result['max_num'] ?? 0;
    }
    
    
}
?>
