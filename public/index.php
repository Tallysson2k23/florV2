<?php
require_once __DIR__ . '/../app/controllers/UsuarioController.php';
require_once __DIR__ . '/../app/controllers/ProdutoController.php';
require_once __DIR__ . '/../app/controllers/PedidoController.php';

$rota = $_GET['rota'] ?? 'login';

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
    case 'editar-produto': // <= 🚨 ADICIONE ESTE CASE
        $controller = new ProdutoController();
        $controller->editar();
        break;
        case 'listar-usuarios':
            require_once __DIR__ . '/../app/controllers/UsuarioController.php';
            $controller = new UsuarioController();
            $controller->listar();
            break;
            
    default:
        echo "Página não encontrada.";
        exit;
}
?>
