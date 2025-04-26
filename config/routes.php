<?php
// Exemplo de rotas
$routes = [
    '/' => ['controller' => 'UsuarioController', 'action' => 'login'],
    '/login' => ['controller' => 'UsuarioController', 'action' => 'login'],
    '/produtos' => ['controller' => 'ProdutoController', 'action' => 'listar'],
    '/produtos/criar' => ['controller' => 'ProdutoController', 'action' => 'criar'],
    // (depois a gente coloca mais rotas)
];
?>
