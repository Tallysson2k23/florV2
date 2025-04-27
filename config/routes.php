<?php
require_once __DIR__ . '/../app/controllers/UsuarioController.php';
require_once __DIR__ . '/../app/controllers/ProdutoController.php';
require_once __DIR__ . '/../app/controllers/PedidoController.php';

//-----------------------------------------
// Produtos
$rotas['produtos'] = ['ProdutoController', 'listar'];
$rotas['criar-produto'] = ['ProdutoController', 'criar'];
$rotas['excluir-produto'] = ['ProdutoController', 'excluir'];
$rotas['editar-produto'] = ['ProdutoController', 'editar']; // <= ADICIONE ESTA LINHA


$rota = $_GET['rota'] ?? 'login';

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

    default:
        echo "Página não encontrada.";
        break;
}
?>
