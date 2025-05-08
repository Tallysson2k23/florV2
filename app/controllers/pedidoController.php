<?php
require_once __DIR__ . '/../models/pedido.php';

class PedidoController
{
    public function cadastrar()
    {
        $pedidoModel = new Pedido();
        $ultimoNumero = $pedidoModel->obterUltimoNumeroPedido();
        $proximoNumeroPedido = $ultimoNumero + 1;

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

    public function listaPedidosJson() {
        $pedidoModel = new Pedido();
        $pedidos = $pedidoModel->buscarTodosOrdenadosPorData();

        header('Content-Type: application/json');
        echo json_encode($pedidos);
        exit;
    }

    public function atualizarStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $status = $_POST['status'] ?? null;

            if ($id && $status) {
                $pedidoModel = new Pedido();
                $sucesso = $pedidoModel->atualizarStatus($id, $status);

                if ($sucesso) {
                    http_response_code(200);
                } else {
                    http_response_code(500);
                    error_log("Erro ao atualizar status do pedido ID $id para $status");
                }
            } else {
                http_response_code(400);
                error_log("Dados ausentes para atualizar status: id=$id, status=$status");
            }
        } else {
            http_response_code(405);
        }
    }

    public function imprimir()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo "Pedido não encontrado.";
            return;
        }

        $pedidoModel = new Pedido();
        $pedido = $pedidoModel->buscarPorId($id);

        if (!$pedido) {
            echo "Pedido não encontrado.";
            return;
        }

        include __DIR__ . '/../views/pedidos/imprimir.php';
    }

    public function gerarNumeroPedido()
    {
        $model = new Pedido();
        $ultimoNumero = $model->obterUltimoNumeroPedido();
        return $ultimoNumero + 1;
    }

    public function cadastrarDetalhado() {
        require_once __DIR__ . '/../views/pedidos/cadastrar_detalhado.php';
    }

    public function salvarDetalhado()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Processar os dados do formulário detalhado
        // Exemplo:
        $numero_pedido = $_POST['numero_pedido'];
        $tipo = $_POST['tipo'];
        // ... outros campos ...

        // Salvar os dados usando o modelo Pedido
        $pedidoModel = new Pedido();
        $pedidoModel->criarDetalhado($numero_pedido, $tipo, /* outros parâmetros */);

        // Redirecionar após o salvamento
        header('Location: /florV2/public/index.php?rota=painel&sucesso=1');
        exit;
    }
}

public function cadastrarRetirada() {
    require_once __DIR__ . '/../views/pedidos/cadastrar_retirada.php';
}

public function salvarRetirada() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $numero = $_POST['numero_pedido'];
        $tipo = $_POST['tipo'];
        $data = $_POST['data'];
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $produtos = $_POST['produtos'];
        $adicionais = $_POST['adicionais'];

        // Aqui você precisa chamar o método do model para salvar. Exemplo:
        $pedidoModel = new Pedido();
        $pedidoModel->criarRetirada($numero, $tipo, $data, $nome, $telefone, $produtos, $adicionais);

        header('Location: index.php?rota=painel&sucesso=1');
        exit;
    }
}


    
}
?>
