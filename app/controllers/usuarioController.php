<?php
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'] ?? null;
            $senha = $_POST['senha'] ?? null;
    
            if (!$email || !$senha) {
                $erro = "Email e senha são obrigatórios.";
                require_once __DIR__ . '/../views/usuario/login.php';
                exit;
            }
    
            $usuarioModel = new Usuario();
            $usuario = $usuarioModel->login($email, $senha);
    
            if ($usuario) {
                session_start();
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['tipo'] = $usuario['tipo'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
    
                header("Location: index.php?rota=produtos");
                exit;
            } else {
                $erro = "Email ou senha inválidos.";
            }
        }
    
        require_once __DIR__ . '/../views/usuario/login.php';
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: /florV2/public/index.php?rota=login');
        exit;
    }

    public function cadastrar() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    
        if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo'] != 'admin') {
            header('Location: /florV2/public/index.php?rota=login');
            exit;
        }
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
            $tipo = $_POST['tipo']; // <- Novo campo tipo
    
            $usuarioModel = new Usuario();
            if ($usuarioModel->criar($nome, $email, $senha, $tipo)) {
                header('Location: /florV2/public/index.php?rota=usuarios');
                exit;
            } else {
                $erro = "Erro ao cadastrar usuário.";
            }
        }
    
        require_once __DIR__ . '/../views/usuario/cadastrar.php';
    }

    public function listar()
{
    $usuarioModel = new Usuario();
    $usuarios = $usuarioModel->buscarTodos();
    require_once __DIR__ . '/../views/usuario/listar.php';

}

public function salvar()
{
    require_once __DIR__ . '/../models/usuario.php';
    $usuarioModel = new Usuario();

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $tipo = $_POST['tipo'];

    // Verifica se o email já existe antes de cadastrar
    if ($usuarioModel->emailExiste($email)) {
        echo "<script>alert('Erro: Email já cadastrado!'); window.history.back();</script>";
        exit;
    }

    // Cadastra o usuário
    $usuarioModel->criar($nome, $email, $senha, $tipo);

    // Redireciona para a lista de usuários
    header('Location: /florV2/public/index.php?rota=listar-usuarios');
    exit;
}

public function excluir()
{
    if (isset($_GET['id'])) {
        $usuarioModel = new Usuario();
        $id = $_GET['id'];
        $usuarioModel->excluir($id);
    }

    header('Location: /florV2/public/index.php?rota=listar-usuarios');
    exit;
}

 
    
    
    
}
?>
