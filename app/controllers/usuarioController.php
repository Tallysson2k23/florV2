<?php
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController {
    public function login() {
        $erro = ""; // <--- Criei a variável para erro

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $usuarioModel = new Usuario();
            $usuario = $usuarioModel->login($email, $senha);

            if ($usuario) {
                // Inicia sessão e salva dados do usuário
                session_start();
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];

                header("Location: index.php?rota=produtos");
                exit;
            } else {
                $erro = "❌ Email ou senha inválidos.";
            }
        }

        require __DIR__ . '/../views/usuarios/login.php'; // aqui carrega o login
        exit;
    }
}
?>
