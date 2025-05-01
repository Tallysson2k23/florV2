<?php
require_once __DIR__ . '/../models/Pedido.php';

class PedidoController
{
    public function cadastrar()
    {
        require_once __DIR__ . '/../views/pedidos/cadastrar.php';
    }

    public function salvar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pedidoModel = new Pedido();

            $nome = $_POST['nome'];
            $tipo = $_POST['tipo'];
            $numero_pedido = $_POST['numero_pedido'];
            $quantidade = $_POST['quantidade'];
            $produto = $_POST['produto'];
            $complemento = $_POST['complemento'];
            $obs = $_POST['observacao'] ?? null;
            $data = $_POST['data'];

            $pedidoModel->criar($nome, $tipo, $numero_pedido, $quantidade, $produto, $complemento, $obs, $data);

            header('Location: /florV2/public/index.php?rota=painel&sucesso=1');
            exit;
        }
    }

    public function listar()
    {
        $pedidoModel = new Pedido();
        $pedidos = $pedidoModel->buscarTodosOrdenadosPorData();

        require_once __DIR__ . '/../views/pedidos/lista.php';
    }

    public function listarJson()
    {
        $pedidoModel = new Pedido();
        $pedidos = $pedidoModel->buscarTodosOrdenadosPorData();

        header('Content-Type: application/json');
        echo json_encode($pedidos);
    }

    public function atualizarStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $status = $_POST['status'] ?? null;

            if ($id && $status) {
                $pedidoModel = new Pedido();
                $pedidoModel->atualizarStatus($id, $status);
                http_response_code(200);
            } else {
                http_response_code(400);
            }
        } else {
            http_response_code(405);
        }
    }
}
?>
