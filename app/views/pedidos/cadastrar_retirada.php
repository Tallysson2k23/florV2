<?php
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: /florV2/public/index.php?rota=login');
    exit;
}

$dataHoje = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Pedido - Retirada</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .container {
            max-width: 700px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 10px;
            vertical-align: top;
        }
        label {
            font-weight: bold;
        }
        input, select, textarea {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .buttons {
            text-align: right;
            margin-top: 20px;
        }
        .buttons button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .submit {
            background-color: #4CAF50;
            color: white;
        }
        .cancel {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Cadastrar de Pedido</h2>
    <form action="index.php?rota=salvar-pedido-retirada" method="POST">
        <table>
            <tr>
                <td><label for="numero_pedido">Nº Pedido:</label></td>
                <td><input type="text" name="numero_pedido" id="numero_pedido" required></td>
                <td><label for="tipo">Tipo:</label></td>
                <td>
    <select name="tipo" id="tipo" onchange="trocarFormulario(this.value)">
        <option value="Retirada" selected>2-Retirada</option>
        <option value="Entrega">1-Entrega</option>
    </select>
</td>

            </tr>
            <tr>
                <td><label for="data">Data:</label></td>
                <td colspan="3"><input type="date" name="data" id="data" value="<?= $dataHoje ?>" required></td>
            </tr>
            <tr>
                <td><label for="nome">Nome:</label></td>
                <td colspan="3"><input type="text" name="nome" id="nome" required></td>
            </tr>
            <tr>
                <td><label for="telefone">Telefone:</label></td>
                <td colspan="3"><input type="text" name="telefone" id="telefone" required></td>
            </tr>
            <tr>
                <td><label for="produtos">Produtos:</label></td>
                <td colspan="3"><input type="text" name="produtos" id="produtos"></td>
            </tr>
            <tr>
                <td><label for="adicionais">Adicionais:</label></td>
                <td colspan="3"><textarea name="adicionais" id="adicionais"></textarea></td>
            </tr>
        </table>
        <div class="buttons">
            <button type="submit" class="submit">Salvar</button>
            <button type="button" class="cancel" onclick="window.location.href='index.php?rota=painel'">Cancelar</button>
        </div>
        <tr>
    <td><label for="quantidade">Quantidade:</label></td>
    <td><input type="number" name="quantidade" id="quantidade"></td>
    <td><label for="complemento">Complemento:</label></td>
    <td><input type="text" name="complemento" id="complemento"></td>
</tr>
<tr>
    <td><label for="observacao">Observação:</label></td>
    <td colspan="3"><textarea name="observacao" id="observacao"></textarea></td>
</tr>

    </form>
</div>
<script>
function trocarFormulario(valor) {
    if (valor === 'Entrega') {
        window.location.href = 'index.php?rota=cadastrar-pedido-detalhado';
    }
}
</script>

</body>
</html>
