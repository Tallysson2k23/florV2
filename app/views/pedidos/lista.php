<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /florV2/public/index.php?rota=login');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Pedidos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e5e5e5;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        th, td {
            border: 1px solid #c0c0c0;
            padding: 10px;
        }

        th {
            background-color: #b0b0b0;
            color: #fff;
            text-align: center;
        }

        td {
            text-align: center;
        }

        td.cliente {
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f0f0f0;
        }

        tr:nth-child(odd) {
            background-color: #d9d9d9;
        }

        .btn-voltar {
            text-align: center;
            margin-top: 20px;
        }

        .btn-voltar a {
            background-color: #666;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 6px;
            display: inline-block;
        }

        .btn-voltar a:hover {
            background-color: #444;
        }
    </style>
</head>
<body>

<h2>Lista de Pedidos</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Tipo</th>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Complemento</th>
            <th>Observação</th>
            <th>Status</th>
            <th>Data</th>
        </tr>
    </thead>
    <tbody id="pedido-body">
        <?php foreach ($pedidos as $pedido): ?>
            <tr>
                <td><?= $pedido['id'] ?></td>
                <td class="cliente"><?= htmlspecialchars($pedido['nome']) ?></td>
                <td><?= htmlspecialchars($pedido['tipo']) ?></td>
                <td><?= htmlspecialchars($pedido['produto']) ?></td>
                <td><?= htmlspecialchars($pedido['quantidade']) ?></td>
                <td><?= htmlspecialchars($pedido['complemento']) ?></td>
                <td><?= htmlspecialchars($pedido['obs']) ?></td>
                <td><?= htmlspecialchars($pedido['status'] ?? 'Pendente') ?></td>
                <td><?= date('d/m/Y', strtotime($pedido['data_abertura'])) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="btn-voltar">
    <a href="index.php?rota=painel">← Voltar ao Painel</a>
</div>

<script>
function carregarPedidos() {
    fetch('index.php?rota=lista-pedidos-json')
        .then(response => response.json())
        .then(pedidos => {
            const tbody = document.getElementById('pedido-body');
            tbody.innerHTML = '';

            pedidos.forEach(pedido => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${pedido.id}</td>
                    <td class="cliente">${pedido.nome}</td>
                    <td>${pedido.tipo}</td>
                    <td>${pedido.produto}</td>
                    <td>${pedido.quantidade}</td>
                    <td>${pedido.complemento}</td>
                    <td>${pedido.obs}</td>
                    <td>${pedido.status || 'Pendente'}</td>
                    <td>${new Date(pedido.data_abertura).toLocaleDateString()}</td>
                `;
                tbody.prepend(tr);
            });
        });
}

carregarPedidos();
setInterval(carregarPedidos, 5000);
</script>

</body>
</html>