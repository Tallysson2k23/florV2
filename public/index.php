<?php

require_once __DIR__ . '/../app/controllers/UsuarioController.php';
require_once __DIR__ . '/../app/controllers/ProdutoController.php';
require_once __DIR__ . '/../app/controllers/PedidoController.php';

$controller = null;
$rota = $_GET['rota'] ?? 'login';
$rotas['cadastrar-pedido-detalhado'] = ['PedidoController', 'cadastrarDetalhado', 'salvar-pedido-detalhado'];
switch ($rota) {
    case 'login':
        $controller = new UsuarioController();
        $controller->login();
        break;

    case 'logout':
        $controller = new UsuarioController();
        $controller->logout();
        break;

    case 'produtos':
        $controller = new ProdutoController();
        $controller->listar();
        break;

    case 'criar_produto':
        $controller = new ProdutoController();
        $controller->criar();
        break;

    case 'deletar_produto':
        $controller = new ProdutoController();
        $controller->deletar();
        break;

    case 'editar-produto':
        $controller = new ProdutoController();
        $controller->editar();
        break;

    case 'listar-usuarios':
        $controller = new UsuarioController();
        $controller->listar();
        break;

    case 'cadastrar_usuario':
        $controller = new UsuarioController();
        $controller->cadastrar();
        break;

    case 'salvar_usuario':
        $controller = new UsuarioController();
        $controller->salvar();
        break;

    case 'excluir-usuario':
        $controller = new UsuarioController();
        $controller->excluir();
        break;

    case 'cadastrar-pedido':
        $controller = new PedidoController();
        $controller->cadastrar();
        break;

    case 'salvar-pedido':
        $controller = new PedidoController();
        $controller->salvar();
        break;

    case 'painel':
        $controller = new UsuarioController();
        $controller->painel();
        break;

    case 'lista-pedidos':
        $controller = new PedidoController();
        $controller->listar();
        break;

    case 'lista-pedidos-json':
        $controller = new PedidoController();
        $controller->listaPedidosJson();
        break;

    case 'atualizar-status':
        $controller = new PedidoController();
        $controller->atualizarStatus();
        break;

    case 'atualizar-status-pedido':
        $controller = new PedidoController();
        $controller->atualizarStatus();
        break;

    case 'imprimir-pedido':
        $controller = new PedidoController();
        $controller->imprimir();
        break;

        case 'cadastrar-pedido-detalhado':
            $controller = new PedidoController();
            $controller->cadastrarDetalhado();
            break;
         //---------------------------------------------------------------
            case 'cadastrar-detalhado':
    require_once __DIR__ . '/../app/controllers/PedidoController.php';
    $controller = new PedidoController();
    $controller->cadastrarDetalhado(); // novo método
    break;

case 'cadastrar-retirada':
    require_once __DIR__ . '/../app/controllers/PedidoController.php';
    $controller = new PedidoController();
    $controller->cadastrarRetirada(); // novo método
    break;
    //------------------------------
            
       // case 'salvar-pedido-detalhado':
         //   $controller = new PedidoController();
           // $controller->salvarDetalhado();
            //break;
           
            //case 'cadastrar-pedido-retirada':
              //  $controller = new PedidoController();
                //$controller->cadastrarRetirada();
                //break;
            
            case 'salvar-pedido-retirada':
                $controller = new PedidoController();
                $controller->salvarRetirada();
                break;
            
    
        default:
        echo "Página não encontrada.";
        break;
            
}
?>
