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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #026aa7;
        }

        .pedido {
            background-color: #fff;
            margin: 15px auto;
            padding: 20px;
            max-width: 600px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .pedido h3 {
            margin-top: 0;
            color: #444;
        }

        .pedido p {
            margin: 5px 0;
            line-height: 1.5;
        }

        .btn-voltar {
            display: block;
            text-align: center;
            margin: 30px auto;
        }

        .btn-voltar a {
            background-color: #026aa7;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 6px;
            transition: background-color 0.3s;
        }

        .btn-voltar a:hover {
            background-color: #014f87;
        }
    </style>
</head>
<body>

<h2>Lista de Pedidos</h2>

<?php foreach ($pedidos as $pedido): ?>
    <div class="pedido">
        <h3>Pedido #<?= $pedido['id'] ?></h3>
        <p><strong>Cliente:</strong> <?= htmlspecialchars($pedido['nome']) ?></p>
        <p><strong>Tipo:</strong> <?= htmlspecialchars($pedido['tipo']) ?></p>
        <p><strong>Produto:</strong> <?= htmlspecialchars($pedido['produto']) ?></p>
        <p><strong>Quantidade:</strong> <?= htmlspecialchars($pedido['quantidade']) ?></p>
        <p><strong>Complemento:</strong> <?= htmlspecialchars($pedido['complemento']) ?></p>
        <p><strong>Observação:</strong> <?= htmlspecialchars($pedido['obs']) ?></p>
        <p><strong>Data:</strong> <?= date('d/m/Y', strtotime($pedido['data_abertura'])) ?></p>
    </div>
<?php endforeach; ?>

<div class="btn-voltar">
    <a href="index.php?rota=painel">← Voltar ao Painel</a>
</div>
<div id="pedido-container">
    <!-- Os pedidos aparecerão aqui dinamicamente -->
</div>

<script>
function carregarPedidos() {
    fetch('index.php?rota=lista-pedidos-json')
        .then(response => response.json())
        .then(pedidos => {
            const container = document.getElementById('pedido-container');
            container.innerHTML = '';

            pedidos.forEach(pedido => {
                const div = document.createElement('div');
                div.style.marginBottom = '15px';
                div.innerHTML = `
                    <strong>Pedido #${pedido.id}</strong><br>
                    Cliente: ${pedido.nome}<br>
                    Tipo: ${pedido.tipo}<br>
                    Produto: ${pedido.produto}<br>
                    Quantidade: ${pedido.quantidade}<br>
                    Data: ${pedido.data_abertura}<br>
                    <hr>
                `;
                container.appendChild(div);
            });
        });
}

// Atualiza a lista a cada 5 segundos
carregarPedidos();
setInterval(carregarPedidos, 5000);
</script>
</body>
</html>
