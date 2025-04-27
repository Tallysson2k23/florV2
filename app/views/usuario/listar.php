<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Verifica se é admin
if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo'] !== 'admin') {
    header('Location: /florV2/public/index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuários</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f7f7f7;
        }
        h1 {
            color: #333;
            text-align: center;
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
        .button {
            text-decoration: none;
            background-color: rgb(35, 10, 81);
            color: white;
            padding: 10px 15px;
            margin: 10px 5px;
            border-radius: 5px;
            display: inline-block;
        }
        .button:hover {
            background-color: #45a049;
        }
        .actions a {
            margin: 0 5px;
            color: #d9534f;
            font-weight: bold;
        }
        .actions a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h1>Lista de Usuários</h1>

<a href="/florV2/public/index.php?rota=cadastrar_usuario" class="button">Cadastrar Novo Usuário</a>
<a href="/florV2/public/index.php" class="button">Voltar ao Início</a>

<br><br>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Tipo</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= $usuario['id']; ?></td>
                <td><?= htmlspecialchars($usuario['nome']); ?></td>
                <td><?= htmlspecialchars($usuario['email']); ?></td>
                <td><?= htmlspecialchars($usuario['tipo']); ?></td>
                <td class="actions">
                    <a href="/florV2/public/index.php?rota=deletar_usuario&id=<?= $usuario['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
