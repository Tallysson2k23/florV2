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
    <h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>!</h1>

    <h2>Lista de Produtos</h2>

    <p>Em breve, vamos listar os produtos aqui! 🚀</p>

    <a href="/florV2/public/index.php?rota=logout">Sair</a>


</body>
</html>
