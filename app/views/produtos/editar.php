<?php if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); } ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
</head>
<body>
    <h1>Editar Produto</h1>

    <form method="POST" action="/florV2/public/index.php?rota=editar-produto">
        <input type="hidden" name="id" value="<?= htmlspecialchars($produto['id']) ?>">

        <label>Nome:</label><br>
        <input type="text" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required><br><br>

        <label>Preço:</label><br>
        <input type="number" step="0.01" name="preco" value="<?= htmlspecialchars($produto['preco']) ?>" required><br><br>

        <label>Descrição:</label><br>
        <textarea name="descricao" required><?= htmlspecialchars($produto['descricao']) ?></textarea><br><br>

        <button type="submit">Salvar Alterações</button>
    </form>

    <br>
    <a href="/florV2/public/index.php?rota=produtos">Cancelar</a>
</body>
</html>
