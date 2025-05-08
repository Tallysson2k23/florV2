<?php
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: /florV2/public/index.php?rota=login');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Escolher Tipo de Pedido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eee;
            text-align: center;
            padding: 50px;
        }
        .opcao {
            background: #fff;
            border: 1px solid #ccc;
            display: inline-block;
            margin: 20px;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            cursor: pointer;
        }
        .opcao:hover {
            background: #f9f9f9;
        }
        h2 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<h2>Qual o tipo de pedido?</h2>

<div class="opcao" onclick="window.location.href='index.php?rota=cadastrar-pedido-detalhado'">
    <h3>Entrega</h3>
</div>

<div class="opcao" onclick="window.location.href='index.php?rota=cadastrar-pedido-retirada'">
    <h3>Retirada</h3>
</div>

</body>
</html>
