<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Fazer Pedido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 500px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"], input[type="number"], input[type="date"], select, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        textarea {
            resize: vertical;
            height: 80px;
        }
        .buttons {
            display: flex;
            justify-content: space-between;
        }
        .buttons button {
            width: 48%;
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        .buttons button.cancel {
            background-color: #f44336;
        }
        .buttons button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Cadastrar Pedido</h2>

    <form action="index.php?rota=salvar-pedido" method="POST">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" required>

    <label for="tipo">Tipo:</label>
    <select name="tipo" id="tipo" required>
        <option value="Retirada">Retirada</option>
        <option value="Entrega">Entrega</option>
    </select>

    <label for="numero_pedido">Nº Pedido:</label>
    <input type="text" name="numero_pedido" id="numero_pedido" required>

    <label for="quantidade">Quantidade:</label>
    <input type="number" name="quantidade" id="quantidade" min="1" required>

    <label for="produto">Produto:</label>
    <select name="produto" id="produto" required>
        <option value="Flor 1">Flor 1</option>
        <option value="Flor 2">Flor 2</option>
        <option value="Flor 3">Flor 3</option>
        <option value="Flor 4">Flor 4</option>
        <option value="Flor 5">Flor 5</option>
    </select>

    <label for="complemento">Complemento:</label>
    <input type="text" name="complemento" id="complemento">

    <label for="observacao">Observação:</label>
    <textarea name="observacao" id="observacao"></textarea>

    <label for="data">Data:</label>
    <input type="date" name="data" id="data" required>

    <div class="buttons">
    <button type="submit">Enviar Pedido</button>
    <button type="button" class="cancel" onclick="window.location.href='index.php?rota=produtos';">Cancelar</button>
</div>

</form>

</div>

</body>
</html>
