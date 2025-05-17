<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f1f3f6;
    padding: 30px;
  }

  .container {
    max-width: 700px;
    margin: 0 auto;
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  }

  h2 {
    color: #333;
    text-align: center;
    margin-bottom: 30px;
  }

  ul {
    list-style: none;
    padding: 0;
    margin-bottom: 30px;
  }

  ul li {
    padding: 12px 15px;
    border-bottom: 1px solid #eee;
    font-size: 16px;
  }

  ul li:last-child {
    border-bottom: none;
  }

  ul li strong {
    color: #555;
    display: inline-block;
    width: 140px;
  }

  .btn-voltar {
    display: inline-block;
    padding: 10px 20px;
    background-color: #3f51b5;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: bold;
  }

  .btn-voltar:hover {
    background-color: #2c3e91;
  }
</style>

<div class="container">
  <h2>📄 Detalhes do Pedido Nº <?= htmlspecialchars($pedido['numero_pedido']) ?></h2>

  <ul>
    <li><strong>Nome:</strong> <?= htmlspecialchars($pedido['nome']) ?></li>
    <li><strong>Tipo:</strong> <?= htmlspecialchars($pedido['tipo']) ?></li>
    <li><strong>Produto:</strong> <?= htmlspecialchars($pedido['produto']) ?></li>
    <li><strong>Quantidade:</strong> <?= htmlspecialchars($pedido['quantidade']) ?></li>
    <li><strong>Complemento:</strong> <?= htmlspecialchars($pedido['complemento']) ?></li>
    <li><strong>Observação:</strong> <?= htmlspecialchars($pedido['obs']) ?></li>
    <li><strong>Data de Abertura:</strong> <?= htmlspecialchars($pedido['data_abertura']) ?></li>
  </ul>

  <div style="margin-top: 30px; text-align: center;">
  <a href="index.php?rota=historico-pedidos" style="
    display: inline-block;
    background-color: #607d8b;
    color: white;
    padding: 12px 24px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
  ">
    ← Voltar ao Histórico
  </a>
</div>


</div>
