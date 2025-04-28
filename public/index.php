<?php
require_once __DIR__ . '/../app/controllers/UsuarioController.php';
require_once __DIR__ . '/../app/controllers/ProdutoController.php';
require_once __DIR__ . '/../app/controllers/PedidoController.php';

$controller = null;
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
             
         

    default:
        echo "Página não encontrada.";
        break;
}
?>
