<?php if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}?>
<h1>Criar Produto</h1>

<form method="POST" action="/florV2/public/index.php?rota=criar_produto">
    <label>Nome:</label><br>
    <input type="text" name="nome" required><br><br>

    <label>Preço:</label><br>
    <input type="text" name="preco" required><br><br>

    <label>Descrição:</label><br>
    <textarea name="descricao"></textarea><br><br>

    <button type="submit">Salvar Produto</button>
</form>

<br>
<a href="/florV2/public/index.php?rota=produtos">Voltar para lista</a>
