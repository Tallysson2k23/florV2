<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Impressão de Pedido</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            font-size: 12px;
            width: 58mm;
            margin: 0 auto;
            padding: 5px;
        }

        .ticket {
            border: 1px solid #000;
            padding: 10px;
            margin-bottom: 15px;
        }

        .titulo {
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        td {
            padding: 4px;
            border: 1px solid #000;
            vertical-align: top;
        }

        .label {
            font-weight: bold;
            width: 30%;
        }

        .valor {
            width: 70%;
        }

        .tipo {
            text-align: center;
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 8px;
        }
    </style>
    <script>
        window.onload = function () {
            window.print();
        };

        window.onafterprint = function () {
            // window.close(); // Descomente se quiser fechar automaticamente após impressão
        };
    </script>
</head>
<body>

<?php
    $tipo = strtoupper(trim($pedido['tipo']));
    $tipoLabel = ($tipo === 'RETIRADA') ? 'RETIRADA' : 'ENTREGA';
?>

<div class="ticket">
    <div class="titulo">Ordem de Produção</div>
    <table>
        <tr>
            <td class="label">Nome</td>
            <td class="valor"><?= htmlspecialchars($pedido['nome']) ?></td>
        </tr>
        <tr>
            <td class="label">Produtos</td>
            <td class="valor"><?= htmlspecialchars($pedido['quantidade']) ?>X - <?= htmlspecialchars($pedido['produto']) ?></td>
        </tr>
        <tr>
            <td class="label">Complemento</td>
            <td class="valor"><?= htmlspecialchars($pedido['complemento']) ?></td>
        </tr>
        <tr>
            <td class="label">N. pedido</td>
            <td class="valor">L<?= $pedido['id'] ?></td>
        </tr>
        <tr>
            <td class="label">Data</td>
            <td class="valor"><?= date('d/m/Y', strtotime($pedido['data_abertura'])) ?></td>
        </tr>
    </table>
    <div class="tipo"><?= $tipoLabel ?></div>
</div>

</body>
</html>
