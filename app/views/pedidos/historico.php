<?php
$numeroBuscado = $_GET['numero_pedido'] ?? null;
?>

<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f1f3f6;
    padding: 30px;
  }

  .container {
    max-width: 800px;
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

  form {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-bottom: 30px;
  }

  input[type="text"] {
    padding: 10px;
    width: 300px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
  }

  button {
    padding: 10px 20px;
    background-color: #3f51b5;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: bold;
  }

  ul {
    list-style: none;
    padding: 0;
  }

  li {
    padding: 15px;
    border-bottom: 1px solid #eee;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  li:last-child {
    border-bottom: none;
  }

  .pedido-info {
    flex: 1;
  }

  .pedido-link a {
    background-color: #4CAF50;
    color: white;
    padding: 8px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 14px;
  }

  .pedido-link a:hover {
    background-color: #45a049;
  }
</style>

<div class="container">
  <h2>📋 Histórico de Pedidos</h2>

  <form method="GET" action="index.php">
    <input type="hidden" name="rota" value="historico-pedidos">
    <input type="text" name="numero_pedido" placeholder="Buscar por número do pedido..." required>
    <button type="submit">Buscar</button>
  </form>

  <ul>
    <?php
    if ($numeroBuscado) {
      $pedidoBuscado = (new Pedido())->buscarPorNumero($numeroBuscado);
      if ($pedidoBuscado):
    ?>
        <li>
          <div class="pedido-info">
            <strong>Nº <?= htmlspecialchars($pedidoBuscado['numero_pedido']) ?></strong> - 
            <?= htmlspecialchars($pedidoBuscado['nome']) ?> - 
            <?= htmlspecialchars($pedidoBuscado['tipo']) ?>
          </div>
          <div class="pedido-link">
            <a href="index.php?rota=detalhes-pedido&numero_pedido=<?= urlencode($pedidoBuscado['numero_pedido']) ?>">Ver detalhes</a>
          </div>
        </li>
    <?php else: ?>
        <li>Nenhum pedido encontrado com esse número.</li>
    <?php endif; } else {
      // Mostrar apenas os 5 mais recentes
      $pedidosRecentes = array_slice($pedidos, 0, 5);
      foreach ($pedidosRecentes as $pedido):
    ?>
      <li>
        <div class="pedido-info">
          <strong>Nº <?= htmlspecialchars($pedido['numero_pedido']) ?></strong> - 
          <?= htmlspecialchars($pedido['nome']) ?> - 
          <?= htmlspecialchars($pedido['tipo']) ?>
        </div>
        <div class="pedido-link">
          <a href="index.php?rota=detalhes-pedido&numero_pedido=<?= urlencode($pedido['numero_pedido']) ?>">Ver detalhes</a>
        </div>
      </li>
    <?php endforeach; } ?>
  </ul>
  <div style="margin-top: 30px; text-align: center;">
  <a href="index.php?rota=painel" style="
    display: inline-block;
    background-color: #607d8b;
    color: white;
    padding: 12px 24px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
  ">
    ⬅ Voltar ao Painel
  </a>
</div>

</div>
