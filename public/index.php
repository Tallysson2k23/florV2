<?php
session_start();

// Carrega as rotas
require_once __DIR__ . '/../config/routes.php';

// Pega a rota da URL
$rota = $_GET['rota'] ?? 'login'; // Se não tiver rota, vai para login

// Define o controller com base na rota
switch ($rota) {
    case 'login':
        $controller = new UsuarioController();
        $controller->login();
        break;

    case 'logout':
        session_destroy();
        header('Location: /florV2/public/index.php?rota=login');
        exit;
        break;

    case 'produtos':
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: /florV2/public/index.php?rota=login');
            exit;
        }
        $controller = new ProdutoController();
        $controller->listar();
        break;

    case 'pedidos':
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: /florV2/public/index.php?rota=login');
            exit;
        }
        $controller = new PedidoController();
        $controller->listar();
        break;

    default:
        echo "Página não encontrada.";
}
