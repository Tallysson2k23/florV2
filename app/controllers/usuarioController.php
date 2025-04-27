<?php
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'] ?? null;
            $senha = $_POST['senha'] ?? null;
    
            if (!$email || !$senha) {
                $erro = "Email e senha são obrigatórios.";
                require_once __DIR__ . '/../views/usuarios/login.php';
                exit;
            }
    
            $usuarioModel = new Usuario();
            $usuario = $usuarioModel->login($email, $senha);
    
            if ($usuario) {
                session_start();
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
    
                header("Location: index.php?rota=produtos");
                exit;
            } else {
                $erro = "Email ou senha inválidos.";
            }
        }
    
        require_once __DIR__ . '/../views/usuarios/login.php';
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: /florV2/public/index.php?rota=login');
        exit;
    }
    
    
    
}
?>
