<?php
require_once __DIR__ . '/../models/Produto.php';

class ProdutoController {
    public function listar() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (!isset($_SESSION['usuario_id'])) {
            header('Location: /florV2/public/index.php?rota=login');
            exit;
        }

        $produtoModel = new Produto();
        $produtos = $produtoModel->listar();
        require_once __DIR__ . '/../views/produtos/listar.php';
    }

    public function criar() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (!isset($_SESSION['usuario_id'])) {
            header('Location: /florV2/public/index.php?rota=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nome = $_POST['nome'];
            $preco = $_POST['preco'];
            $descricao = $_POST['descricao'];

            $produtoModel = new Produto();
            if ($produtoModel->criar($nome, $preco, $descricao)) {
                header('Location: /florV2/public/index.php?rota=produtos');
                exit;
            }
        }

        require_once __DIR__ . '/../views/produtos/criar.php';
    }

    public function deletar() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (!isset($_SESSION['usuario_id'])) {
            header('Location: /florV2/public/index.php?rota=login');
            exit;
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $produtoModel = new Produto();
            if ($produtoModel->deletar($id)) {
                header('Location: /florV2/public/index.php?rota=produtos');
                exit;
            }
        }
    }

    public function editar() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (!isset($_SESSION['usuario_id'])) {
            header('Location: /florV2/public/index.php?rota=login');
            exit;
        }

        $produtoModel = new Produto();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $preco = $_POST['preco'];
            $descricao = $_POST['descricao'];

            if ($produtoModel->editar($id, $nome, $preco, $descricao)) {
                header('Location: /florV2/public/index.php?rota=produtos');
                exit;
            } else {
                echo "Erro ao atualizar produto.";
            }
        } else {
            $id = $_GET['id'] ?? null;
            if ($id) {
                $produto = $produtoModel->buscarPorId($id);
                if ($produto) {
                    require_once __DIR__ . '/../views/produtos/editar.php';
                } else {
                    echo "Produto não encontrado.";
                }
            } else {
                echo "ID não informado.";
            }
        }
    }
}
?>
