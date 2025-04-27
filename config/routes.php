<?php

$rota = $_GET['rota'] ?? '';

switch ($rota) {
    case 'login':
        require_once __DIR__ . '/../app/controllers/UsuarioController.php';
        $controller = new UsuarioController();
        $controller->login();
        break;

    case 'logout':
        session_start();
        session_destroy();
        header('Location: index.php?rota=login');
        break;

    case 'produtos':
        // Aqui depois podemos criar o ProdutoController certinho
        require_once __DIR__ . '/../app/views/produtos/listar.php';
        break;

    default:
        // Redireciona para login se não achar nenhuma rota
        header('Location: index.php?rota=login');
        break;
}
?>
