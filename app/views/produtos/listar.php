<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Se não estiver logado, redireciona para o login
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /florV2/public/index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Produtos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: #f7f7f7;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            background: #fff;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: rgb(19, 156, 67);
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a.button {
            text-decoration: none;
            background-color: rgb(35, 10, 81);
            color: white;
            padding: 10px 15px;
            margin: 10px 5px;
            border-radius: 5px;
        }
        a.button:hover {
            background-color: #45a049;
        }
        .actions .btn {
            padding: 6px 12px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-size: 14px;
        }
        .actions .editar {
            background-color: #007bff;
        }
        .actions .editar:hover {
            background-color: #0056b3;
        }
        .actions .excluir {
            background-color: #dc3545;
        }
        .actions .excluir:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<h1>Lista de Produtos</h1>

<a href="/florV2/public/index.php?rota=criar_produto" class="button">Adicionar Produto</a>
<a href="/florV2/public/index.php?rota=logout" class="button">Sair</a>

<br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th><th>Nome</th><th>Preço</th><th>Descrição</th><th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($produtos as $produto): ?>
            <tr>
                <td><?= $produto['id']; ?></td>
                <td><?= htmlspecialchars($produto['nome']); ?></td>
                <td>R$ <?= number_format($produto['preco'], 2, ',', '.'); ?></td>
                <td><?= htmlspecialchars($produto['descricao']); ?></td>
                <td class="actions">
                    <a href="/florV2/public/index.php?rota=editar-produto&id=<?= $produto['id']; ?>" class="btn editar">Editar</a>
                    <a href="/florV2/public/index.php?rota=deletar_produto&id=<?= $produto['id']; ?>" class="btn excluir" onclick="return confirm('Tem certeza que deseja excluir este produto?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
