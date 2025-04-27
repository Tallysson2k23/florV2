<?php


// Se não estiver logado, redireciona para o login
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /public/index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Produtos</title>
</head>
<body>
<?php if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
 ?>
<h1>Lista de Produtos</h1>

<a href="/florV2/public/index.php?rota=criar_produto">Adicionar Produto</a> | 
<a href="/florV2/public/index.php?rota=logout">Sair</a>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th><th>Nome</th><th>Preço</th><th>Descrição</th><th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($produtos as $produto): ?>
            <tr>
                <td><?= $produto['id']; ?></td>
                <td><?= htmlspecialchars($produto['nome']); ?></td>
                <td>R$ <?= number_format($produto['preco'], 2, ',', '.'); ?></td>
                <td><?= htmlspecialchars($produto['descricao']); ?></td>
                <td>
                    <a href="/florV2/public/index.php?rota=deletar_produto&id=<?= $produto['id']; ?>">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


</body>
</html>
