<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login - Flor de Cheiro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f5f7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 400px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
        }

        h2 {
            text-align: center;
            color: #172b4d;
            font-weight: 500;
            margin-bottom: 30px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 14px;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="email"],
        input[type="password"] {
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            background-color: #fafafa;
        }

        button {
            background-color: #5aac44;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #519839;
        }

        .error-message {
            background-color: #ffe6e6;
            color: #c0392b;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Login - Flor de Cheiro</h2>

    <?php if (!empty($erro)) : ?>
        <div class="error-message">❌ <?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form method="POST" action="index.php?rota=login">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>

        <button type="submit">Entrar</button>
    </form>
</div>

</body>
</html>
