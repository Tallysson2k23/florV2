<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    
}
$nome = $dadosPedido['nome'] ?? '';
$tipo = $dadosPedido['tipo'] ?? 'Entrega';
$numeroPedido = $dadosPedido['numero_pedido'] ?? '';
$quantidade = $dadosPedido['quantidade'] ?? '';
$produto = $dadosPedido['produto'] ?? '';
$complemento = $dadosPedido['complemento'] ?? '';
$observacao = $dadosPedido['obs'] ?? '';
$data = $dadosPedido['data_abertura'] ?? date('Y-m-d');


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
    <title>Protocolo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
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
        textarea {
            resize: vertical;
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
    <h2>Protocolo</h2>
    <form id="formPedido" action="index.php?rota=salvar-pedido-detalhado" method="POST">

        <table>
            <tr>
                <td><label for="numero_pedido">Nº Pedido:</label></td>
                <td><input type="text" name="numero_pedido" id="numero_pedido" required value="<?= htmlspecialchars($numeroPedido) ?>"></td>
                <td><label for="tipo">Tipo:</label></td>
                <td>
                <select name="tipo" id="tipo" required onchange="trocarFormulario(this.value)">
  <option value="Entrega" <?= $tipo === 'Entrega' ? 'selected' : '' ?>>1-Entrega</option>
  <option value="Retirada" <?= $tipo === 'Retirada' ? 'selected' : '' ?>>2-Retirada</option>
</select>


                </td>
            </tr>
            <tr>
                <td><label for="data">Data:</label></td>
                <td colspan="3"><input type="date" name="data" id="data" value="<?= htmlspecialchars($data) ?>"></td>
            </tr>
            <tr>
                <td><label for="remetente">Remetente:</label></td>
                <td><input type="text" name="remetente" id="remetente" value="<?= htmlspecialchars($nome) ?>"></td>
                <td><label for="telefone_remetente">Telefone:</label></td>
                <td><input type="text" name="telefone_remetente" id="telefone_remetente"></td>
            </tr>
            <tr>
                <td><label for="destinatario">Destinatário:</label></td>
                <td><input type="text" name="destinatario" id="destinatario"></td>
                <td><label for="telefone_destinatario">Telefone:</label></td>
                <td><input type="text" name="telefone_destinatario" id="telefone_destinatario"></td>
            </tr>
            <tr>
                <td><label for="endereco">Endereço:</label></td>
                <td><input type="text" name="endereco" id="endereco"></td>
                <td><label for="numero">Nº:</label></td>
                <td><input type="text" name="numero" id="numero"></td>
            </tr>
            <tr>
                <td><label for="bairro">Bairro:</label></td>
                <td colspan="3">
                    <select name="bairro" id="bairro">
                        
                        <!-- <option value="Centro">Centro</option>
                        <option value="Bairro 1">Bairro 1</option>
                        <option value="Bairro 2">Bairro 2</option> -->
                        <!-- Adicione mais bairros aqui -->
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="referencia">Referência:</label></td>
                <td colspan="3"><input type="text" name="referencia" id="referencia"></td>
            </tr>
            <tr>
                <td><label for="produtos">Produtos:</label></td>
                <td colspan="3"><input type="text" name="produtos" id="produtos" value="<?= htmlspecialchars($produto) ?>"></td>
            </tr>
            <tr>
                <td><label for="adicionais">Adicionais:</label></td>
                <td colspan="3"><textarea name="adicionais" id="adicionais" placeholder=""></textarea></td>
            </tr>
        </table>
<tr>
    <td><label for="quantidade">Quantidade:</label></td>
    <td><input type="number" name="quantidade" id="quantidade" value="<?= htmlspecialchars($quantidade) ?>"></td>
    <td><label for="complemento">Complemento:</label></td>
    <td><input type="text" name="complemento" id="complemento" value="<?= htmlspecialchars($complemento) ?>"></td>
</tr>
<tr>
    <td><label for="observacao">Observação:</label></td>
    <td colspan="3"><textarea name="observacao" id="observacao"><?= htmlspecialchars($observacao) ?></textarea>
</td>
</tr>
        <div class="buttons">
    <button type="submit" id="enviarButton" class="submit">Salvar</button>
    <button type="button" id="cancelarButton" class="cancel">Cancelar</button>
</div>


    </form>
</div>
<script>
function trocarFormulario(valor) {
    if (valor === 'Retirada') {
        window.location.href = 'index.php?rota=cadastrar-pedido-retirada';
    } else if (valor === 'Entrega') {
        window.location.href = 'index.php?rota=cadastrar-pedido-detalhado';
    }
}
</script>

<script>
  function trocarFormulario(valor) {
      if (valor === 'Retirada') {
          window.location.href = 'index.php?rota=cadastrar-pedido-retirada';
      } else if (valor === 'Entrega') {
          window.location.href = 'index.php?rota=cadastrar-pedido-detalhado';
      }
  }

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
      const confirmarEnvio = confirm("Tem certeza que deseja enviar este pedido?");
      if (!confirmarEnvio) {
        e.preventDefault();
      }
    });
  });
</script>

</body>
</html>
