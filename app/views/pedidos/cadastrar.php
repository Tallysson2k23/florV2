<?php
require_once __DIR__ . '/../../../config/database.php';
require_once __DIR__ . '/../../../app/models/produto.php';

$dataHoje = date('Y-m-d');

// Buscar produtos cadastrados
$modelProduto = new Produto();
if (method_exists($modelProduto, 'listar')) {
  $listaProdutos = $modelProduto->listar();
} else {
  $listaProdutos = [];
}
?>

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
      width: 700px;
      margin: 40px auto;
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    td {
      padding: 10px;
      vertical-align: middle;
    }

    label {
      font-weight: bold;
      color: #333;
    }

    input[type="text"], input[type="number"], input[type="date"], select, textarea {
      width: 100%;
      padding: 8px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    textarea {
      resize: vertical;
      height: 60px;
    }

    .buttons {
      text-align: right;
      margin-top: 20px;
    }

    .buttons button {
      padding: 10px 20px;
      font-size: 16px;
      margin-left: 10px;
      border: none;
      border-radius: 5px;
      color: white;
      cursor: pointer;
    }

    .submit {
      background-color: #4CAF50;
    }

    .cancel {
      background-color: #f44336;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Cadastrar Pedido</h2>
  <form id="formPedido" method="POST">
    <table>
      <tr>
        <td><label for="nome">Nome:</label></td>
        <td colspan="3"><input type="text" name="nome" id="nome" required></td>
      </tr>
      <tr>
        <td><label for="tipo">Tipo:</label></td>
        <td><select name="tipo" id="tipo" required>
          <option value="Retirada">Retirada</option>
          <option value="Entrega">Entrega</option>
        </select></td>
        <td><label for="numero_pedido">Nº Pedido:</label></td>
        <td><input type="text" name="numero_pedido" id="numero_pedido" value="<?= $proximoNumeroPedido ?>" readonly></td>
      </tr>
      <tr>
        <td><label for="quantidade">QNT:</label></td>
        <td><input type="number" name="quantidade" id="quantidade" required></td>
        <td><label for="produto">Produto:</label></td>
        <td>
  <input list="produtos" name="produto" id="produto" placeholder="Digite ou selecione o produto" required
         style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc; box-sizing: border-box;">
  <datalist id="produtos">
    <?php foreach ($listaProdutos as $produto): ?>
      <option value="<?= htmlspecialchars($produto['nome']) ?>">
    <?php endforeach; ?>
  </datalist>
</td>

      </tr>
      <tr>
        <td><label for="complemento">Complemento:</label></td>
        <td colspan="3"><input type="text" name="complemento" id="complemento"></td>
      </tr>
      <tr>
        <td><label for="observacao">Obs.:</label></td>
        <td colspan="3"><textarea name="observacao" id="observacao"></textarea></td>
      </tr>
      <tr>
        <td><label for="data">Data:</label></td>
        <td colspan="3"><input type="date" name="data" id="data" value="<?= $dataHoje ?>" required></td>
      </tr>
    </table>

    <div class="buttons">
      <button type="submit" class="submit" id="enviarButton">Enviar</button>
      <button type="button" class="cancel" id="cancelarButton">Cancelar</button>
    </div>
  </form>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const btnCancelar = document.getElementById("cancelarButton");
    const form = document.getElementById("formPedido");
    const btnEnviar = document.getElementById("enviarButton");

    btnCancelar.addEventListener("click", function () {
      const confirmacao = confirm("Tem certeza que deseja cancelar? Todos os dados não salvos serão perdidos.");
      if (confirmacao) {
        window.location.href = "index.php?rota=painel";
      }
    });

    btnEnviar.addEventListener("click", function (e) {
      e.preventDefault(); // Impede o envio imediato do form

      const confirmarEnvio = confirm("Tem certeza que deseja enviar este pedido?");
      if (!confirmarEnvio) return;

      const tipo = document.getElementById("tipo").value;

      if (tipo === "Entrega") {
        form.action = "index.php?rota=cadastrar-detalhado";
      } else if (tipo === "Retirada") {
        form.action = "index.php?rota=cadastrar-retirada";
      } else {
        alert("Tipo de pedido inválido.");
        return;
      }

      form.submit(); // Envia o formulário para o destino definido
    });
  });
</script>


</body>
</html>
