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

            // Criar o pedido e receber o ID retornado
            $idPedido = $pedidoModel->criar(
                $_POST['nome'] ?? null,
                $_POST['tipo'] ?? null,
                $_POST['numero_pedido'] ?? null,
                $_POST['quantidade'] ?? null,
                $_POST['produto'] ?? null,
                $_POST['complemento'] ?? null,
                $_POST['observacao'] ?? null,
                $_POST['data'] ?? null
            );

            // Redirecionar para cadastrar_detalhado.php passando o ID
            header('Location: index.php?rota=cadastrar-pedido-detalhado&id=' . $idPedido);
            exit;
        }
    }

    //-----------------------------------------------------
    public function cadastrarDetalhado()
{
    $pedidoModel = new Pedido();
    $ultimoNumero = $pedidoModel->obterUltimoNumeroPedido();
    $proximoNumeroPedido = $ultimoNumero + 1;

    require_once __DIR__ . '/../views/pedidos/cadastrar_detalhado.php';
}
//public function cadastrarDetalhado()
//{
  //  session_start();

    //$idPedido = $_GET['id'] ?? null;

    //if ($idPedido) {
      //  $pedidoModel = new Pedido();
       /// $_SESSION['dados_pedido'] = $pedidoModel->buscarPorId($idPedido);
    //}

    //require_once __DIR__ . '/../views/pedidos/cadastrar_detalhado.php';
//}



    public function salvarDetalhado()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pedidoModel = new Pedido();

            $pedidoModel->criar(
                $_POST['remetente'] ?? $_POST['nome'] ?? null,
                $_POST['tipo'] ?? null,
                $_POST['numero_pedido'] ?? null,
                $_POST['quantidade'] ?? null,
                $_POST['produtos'] ?? $_POST['produto'] ?? null,
                $_POST['complemento'] ?? null,
                $_POST['observacao'] ?? $_POST['obs'] ?? null,
                $_POST['data'] ?? null,
                $_POST['telefone_remetente'] ?? null,
                $_POST['destinatario'] ?? null,
                $_POST['telefone_destinatario'] ?? null,
                $_POST['endereco'] ?? null,
                $_POST['numero'] ?? null,
                $_POST['bairro'] ?? null,
                $_POST['referencia'] ?? null,
                $_POST['telefone'] ?? null,
                $_POST['adicionais'] ?? null
            );

            header('Location: index.php?rota=painel&sucesso=1');
            exit;
        }
    }

    public function listar()
    {
        $pedidoModel = new Pedido();
        $pedidos = $pedidoModel->buscarTodosOrdenadosPorData();

        require_once __DIR__ . '/../views/pedidos/lista.php';
    }

    public function listaPedidosJson()
    {
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
                $pedidoModel->atualizarStatus($id, $status);
                http_response_code(200);
            } else {
                http_response_code(400);
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
        return $model->obterUltimoNumeroPedido() + 1;
    }
    //--------------------------------

public function cadastrarRetirada()
{
    $pedidoModel = new Pedido();
    $ultimoNumero = $pedidoModel->obterUltimoNumeroPedido();
    $proximoNumeroPedido = $ultimoNumero + 1;

    require_once __DIR__ . '/../views/pedidos/cadastrar_retirada.php';
}
    //public function cadastrarRetirada()
   // {
      //  require_once __DIR__ . '/../views/pedidos/cadastrar_retirada.php';
    //}

    public function salvarRetirada()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pedidoModel = new Pedido();

            $pedidoModel->criar(
                $_POST['nome'] ?? null,
                $_POST['tipo'] ?? null,
                $_POST['numero_pedido'] ?? null,
                $_POST['quantidade'] ?? 1,
                $_POST['produtos'] ?? null,
                $_POST['complemento'] ?? null,
                $_POST['observacao'] ?? $_POST['obs'] ?? null,
                $_POST['data'] ?? null,
                null, null, null, null, null, null, null,
                $_POST['telefone'] ?? null,
                $_POST['adicionais'] ?? null
            );

            header('Location: index.php?rota=painel&sucesso=1');
            exit;
        }
    }

    public function historico()
{
    $pedidoModel = new Pedido();
    $pedidos = $pedidoModel->buscarTodos();

    require_once __DIR__ . '/../views/pedidos/historico.php';
}

public function detalhes($numeroPedido)
{
    if (!$numeroPedido) {
        echo "Número do pedido inválido.";
        return;
    }

    $pedidoModel = new Pedido();
    $pedido = $pedidoModel->buscarPorNumero($numeroPedido);

    if (!$pedido) {
        echo "Pedido não encontrado.";
        return;
    }

    require_once __DIR__ . '/../views/pedidos/detalhes.php';
}


}
?>
