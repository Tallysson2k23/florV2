<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login - FlorV2</title>
</head>
<body>

<h2>Login</h2>

<?php if (!empty($erro)) : ?>
    <p style="color:red;">❌ <?= $erro ?></p>
<?php endif; ?>

<form method="POST" action="index.php?rota=login">
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Senha:</label><br>
    <input type="password" name="senha" required><br><br>

    <button type="submit">Entrar</button>
</form>


</body>
</html>
