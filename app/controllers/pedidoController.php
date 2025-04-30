<?php
require_once __DIR__ . '/../models/Pedido.php';

class PedidoController
{
    public function cadastrar()
    {
        require_once __DIR__ . '/../views/pedidos/cadastrar.php';
    }

    // Outros métodos virão depois (como salvar, listar, etc.)

    public function salvar() {
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
    

}


?>
