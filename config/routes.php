
 //<?php 

/*require_once __DIR__ . '/../app/controllers/UsuarioController.php';

//-----------------------------------------
// Produtos
$rotas['produtos'] = ['ProdutoController', 'listar'];
$rotas['criar-produto'] = ['ProdutoController', 'criar'];
$rotas['excluir-produto'] = ['ProdutoController', 'excluir'];
$rotas['editar-produto'] = ['ProdutoController', 'editar']; // <= ADICIONE ESTA LINHA
$rotas['painel'] = ['UsuarioController', 'painel'];


$rota = $_GET['rota'] ?? 'login';

$rotas['cadastrar-pedido-detalhado'] = ['PedidoController', 'cadastrarDetalhado', 'salvar-pedido-detalhado'];


switch ($rota) {
    case 'login':
        require_once __DIR__ . '/../app/controllers/UsuarioController.php';
        $controller = new UsuarioController();
        $controller->login();
        break;
    case 'logout':
        require_once __DIR__ . '/../app/controllers/UsuarioController.php';
        $controller = new UsuarioController();
        $controller->logout();
        break;
    case 'produtos':
        require_once __DIR__ . '/../app/controllers/ProdutoController.php';
        $controller = new ProdutoController();
        $controller->listar();
        break;
    case 'criar_produto':
        require_once __DIR__ . '/../app/controllers/ProdutoController.php';
        $controller = new ProdutoController();
        $controller->criar();
        break;
    case 'deletar_produto':
        require_once __DIR__ . '/../app/controllers/ProdutoController.php';
        $controller = new ProdutoController();
        $controller->deletar();
        break;
    case 'editar_produto': // NOVO caso adicionado
        $controller = new ProdutoController();
        $controller->editar();
        break;
    case 'painel':
        require_once __DIR__ . '/../../views/painel.php';
        $controller = new UsuarioController();
        $controller->painel();
        break;

    case 'atualizar-status':
        $controller = new PedidoController();
        $controller->atualizarStatus();
        break;
        
    case 'imprimir-pedido':
        require 'app/controllers/PedidoController.php';
        $controller = new PedidoController();
        $controller->imprimir();
        break;

    case 'cadastrar-pedido-detalhado':
        $controller = new PedidoController();
        $controller->cadastrarDetalhado();
        break;
        
    case 'salvar-pedido-detalhado':
        $controller = new PedidoController();
        $controller->salvarDetalhado();
        break;
       


    default:
    echo "Página não encontrada.";
    break;
        

}

?>
*/