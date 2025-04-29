<?php
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /florV2/public/index.php?rota=login');
    exit;
}
$nomeUsuario = $_SESSION['usuario_nome'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel - Flor de Cheiro</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f5f7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        header {
            background-color: #026aa7;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 22px;
            font-weight: 500;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 20px;
        }

        h2 {
            margin-bottom: 30px;
            font-weight: 400;
        }

        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            width: 100%;
            max-width: 900px;
        }

        .card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card button {
            background-color: #5aac44;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
            margin-top: 10px;
            transition: background-color 0.2s;
        }

        .card button:hover {
            background-color: #519839;
        }

        .logout {
            margin-top: 30px;
            color: #555;
            font-size: 14px;
        }

        .logout a {
            color: #c0392b;
            text-decoration: none;
            font-weight: bold;
        }

        .logout a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<header>Flor de Cheiro</header>

<div class="container">
    <h2>Olá, <?= htmlspecialchars($nomeUsuario) ?>!</h2>

    <div class="card-container">
        <div class="card">
            <h3>Cadastrar Pedido</h3>
            <button onclick="location.href='index.php?rota=cadastrar-pedido'">Acessar</button>
        </div>
        <div class="card">
            <h3>Cadastrar Produto</h3>
            <button onclick="location.href='../app/views/produtos/criar.php'">Acessar</button>
        </div>
        <div class="card">
            <h3>Lista de Pedidos</h3>
            <button onclick="location.href='index.php?rota=lista-pedidos'">Acessar</button>
        </div>
        <div class="card">
            <h3>Lista de Usuario</h3>
            <button onclick="location.href='/florV2/public/index.php?rota=listar-usuarios'">Acessar</button>
        </div>

    </div>

    <div class="logout">
        <a href="/florV2/public/index.php?rota=logout">Sair da conta</a>
    </div>
</div>

</body>
</html>
