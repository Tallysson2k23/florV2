<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario_id'])) {
    header('Location: /florV2/public/index.php?rota=login');
    exit;
}
$nomeUsuario = $_SESSION['usuario_nome'];
require_once __DIR__ . '/../../config/database.php';

$conn = Database::conectar();
$db = new Database();
$pdo = $db->getConnection();

$dataSelecionada = $_GET['data'] ?? date('Y-m-d');

$stmtAgenda = $pdo->prepare("SELECT * FROM pedidos WHERE data_abertura = ?");
$stmtAgenda->execute([$dataSelecionada]);
$pedidosHoje = $stmtAgenda->fetchAll(PDO::FETCH_ASSOC);

$stmtWorkflow = $pdo->query("SELECT * FROM pedidos ORDER BY data_abertura, hora");
$pedidosWorkflow = $stmtWorkflow->fetchAll(PDO::FETCH_ASSOC);

$statusAgrupado = [
    'Pendente' => [],
    'Produção' => [],
    'Pronto' => [],
    'Entregue' => []
];
foreach ($pedidosWorkflow as $pedido) {
    $status = $pedido['status'];
    if (isset($statusAgrupado[$status])) {
        $statusAgrupado[$status][] = $pedido;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <!--<meta http-equiv="refresh" content="5">  Esta linha atualiza a página a cada 50 segundos -->
    <title>Painel - Flor de Cheiro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <style>
        body {
            margin: 0;
            background-color: #f4f5f7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }
        header {
            background-color:rgb(10, 10, 11);
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }
        .container {
            padding: 30px;
            max-width: 1200px;
            margin: auto;
        }
        h2 {
            color: #172b4d;
            text-align: center;
            margin-top: 30px;
        }
        form label {
            font-size: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            color: #333;
        }
        form input[type="date"] {
    font-size: 16px;
    padding: 5px 10px;
    border: none;
    border-radius: 6px;
    background: transparent;
    color: #333;
     font-weight: bold;
}

        .agenda-box {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.51);
            margin-top: 20px;
        }
        .agenda-list {
            list-style: none;
            padding-left: 0;
            margin: 0;
            max-height: 150px;
            overflow: hidden;
            transition: max-height 0.4s ease;
        }
        .agenda-list.expandido {
            max-height: 1000px;
        }
        .agenda-list li {
    padding: 12px 16px;
    margin-bottom: 6px;
    background-color:rgba(165, 146, 146, 0.45);
    border-radius: 6px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    font-size: 16px;
}

        .toggle-agenda {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            margin-top: -10px;
            float: right;
        }
        .status-columns {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            padding: 20px 0;
        }
        .status-column {
            background: #ebecf0;
            border-radius: 8px;
            padding: 10px;
            min-width: 250px;
            flex: 1;
        }
        .status-column h3 {
            text-align: center;
            color: #333;
        }
        .pedido-card {
            background: white;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            font-size: 14px;
            color: #333;
        }
        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-top: 40px;
        }
        .card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            transition: transform 0.2s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card button {
            background-color: #5aac44;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
            margin-top: 10px;
            transition: background-color 0.2s;
        }
        .card button:hover {
            background-color: #519839;
        }
        .logout {
            text-align: center;
            margin-top: 30px;
        }
        .logout a {
            color: crimson;
            font-weight: bold;
            font-size: 18px;
            text-decoration: none;
        }
        .logout a:hover {
            text-decoration: underline;
        }

        .menu-lateral {
    position: fixed;
    top: 0;
    left: -289px;
    width: 250px;
    height: 100%;
    background-color:rgb(5, 5, 5);
    color: white;
    padding: 20px;
    box-shadow: 2px 0 8px rgba(0,0,0,0.2);
    transition: left 0.3s ease;
    z-index: 999;
}

.menu-lateral p {
    margin-top: 60px;
    font-size: 18px;
}

.fechar-menu {
    position: absolute;
    top: 15px;
    right: 20px;
    font-size: 24px;
    cursor: pointer;
}

.btn-menu {
    position: fixed;
    top: 20px;
    left: 20px;
    background-color: transparent;
    border: none;
    font-size: 28px;
    cursor: pointer;
    color: white;
    z-index: 1000;
}

@keyframes fadeOut {
    to {
        opacity: 0;
        transform: translateY(-20px);
        visibility: hidden;
    }
}

.toast-sucesso {
    position: fixed;
    top: 20px;
    right: 20px;
    background-color: #2ecc71;
    color: white;
    padding: 12px 18px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    font-weight: bold;
    font-size: 14px;
    z-index: 9999;
    opacity: 1;
    transition: opacity 0.5s, transform 0.5s;
}



    </style>
</head>
<body>
<div id="menu-lateral" class="menu-lateral">
    <span class="fechar-menu" onclick="toggleMenu()">×</span>
    <p>🙋🏻‍♂️ Olá <strong><?= htmlspecialchars($nomeUsuario) ?></strong></p>
</div>

<button class="btn-menu" onclick="toggleMenu()">☰</button>




<header>𝓕𝓵𝓸𝓻 𝓭𝓮 𝓒𝓱𝓮𝓲𝓻𝓸 </header>
<!-- <h2>Olá, <?= htmlspecialchars($nomeUsuario) ?>!</h2> -->
<div class="container">
  <?php if (isset($_GET['sucesso']) && $_GET['sucesso'] == 1): ?>
    <div id="toast" class="toast-sucesso">
        ✅ Pedido cadastrado com sucesso!
    </div>
    <script>
        // Remove o parâmetro da URL após carregar
        if (history.replaceState) {
            const url = new URL(window.location);
            url.searchParams.delete('sucesso');
            history.replaceState(null, '', url.toString());
        }

        // Faz a notificação sumir após 2,5 segundos
        setTimeout(() => {
            const toast = document.getElementById('toast');
            if (toast) {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(100%)';
                setTimeout(() => toast.remove(), 500); // remove do DOM
            }
        }, 2500);
    </script>
<?php endif; ?>




<!-- <form method="get" action="index.php" style="text-align:center; margin-bottom: 20px;">
    <input type="hidden" name="rota" value="painel">
    <label for="data">
    <strong> Agenda do Dia:</strong>

        <input type="date" id="data" name="data" value="<?= htmlspecialchars($dataSelecionada) ?> " onchange="this.form.submit()">
    </label>
</form>  Agenda onde fica a data e os pedido da data selecionada.  

<div class="agenda-box">
    <ul id="lista-agenda" class="agenda-list">
        <?php foreach ($pedidosHoje as $pedido): ?>
            <li><?= htmlspecialchars($pedido['nome']) ?> (<?= htmlspecialchars($pedido['produto']) ?>)</li>
        <?php endforeach; ?>
    </ul>
    <?php if (count($pedidosHoje) > 3): ?>
        <div style="text-align: right; margin-top: 20px;">
    <button id="toggle-btn" class="toggle-agenda" onclick="alternarLista()">⬇🌹</button>
</div>

    <?php endif; ?>
</div>
-->



<h2>Status dos Pedidos</h2>
<div class="status-columns">
<?php foreach ($statusAgrupado as $status => $lista): 
    $corFundoClaro = match($status) {
        'Pendente' => '#F08080',     // vermelho claro
        'Produção' => '#DEB887',     // laranja claro
        'Pronto'   => '#87CEFA',     // azul claro
        'Entregue' => '#00FA9A',     // verde claro
        default    => '#f4f5f7'
    };
?>
    <div class="status-column" style="background-color: <?= $corFundoClaro ?>;">

        <h3><?= $status ?></h3>
        <?php if (count($lista) > 0): ?>
            <?php foreach ($lista as $pedido): ?>
                <div class="pedido-card">
                    <strong>#<?= $pedido['id'] ?></strong><br>
                    <?= htmlspecialchars($pedido['nome']) ?><br>
                    <small><?= htmlspecialchars($pedido['produto']) ?> - <?= date('d/m', strtotime($pedido['data_abertura'])) ?> às <?= $pedido['hora'] ?></small>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align:center; color:#999;">Nenhum</p>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
</div>


<div class="card-container">
    <div class="card">
        <h3>Cadastrar Pedido</h3>
        <button onclick="location.href='index.php?rota=cadastrar-pedido'">Acessar</button>
    </div>
    <div class="card">
        <h3>Cadastrar Entrega/Retirada</h3>
        <button onclick="location.href='index.php?rota=cadastrar-pedido-detalhado'">Acessar</button>
    </div>
    <?php if ($_SESSION['tipo'] === 'admin'): ?>
        <div class="card">
            <h3>Cadastrar Produto</h3>
            <button onclick="location.href='../app/views/produtos/criar.php'">Acessar</button>
        </div>
        <div class="card">
            <h3>Lista de Usuários</h3>
            <button onclick="location.href='index.php?rota=listar-usuarios'">Acessar</button>
        </div>
    <?php endif; ?>
    <div class="card">
        <h3>Lista de Pedidos</h3>
        <button onclick="location.href='index.php?rota=lista-pedidos'">Acessar</button>
    </div>
    <div class="card">
        <h3>Agenda de Pedidos</h3>
        <button onclick="location.href='index.php?rota=painel'">Acessar</button>
    </div>

</div>

<div class="logout">
    <a href="/florV2/public/index.php?rota=logout">Sair da conta</a>
</div>
</div>
<script>
function alternarLista() {
    const lista = document.getElementById('lista-agenda');
    const btn = document.getElementById('toggle-btn');
    lista.classList.toggle('expandido');
    btn.classList.toggle('girado');
}
</script>

<script>
function toggleMenu() {
    const menu = document.getElementById('menu-lateral');
    menu.style.left = menu.style.left === '0px' ? '-289px' : '0px';
}
</script>

</body>
</html>
