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
    <title>Painel - Flor de Cheiro</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color:rgb(104, 99, 99);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }
        header {
            background-color:rgb(0, 3, 4);
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 22px;
            font-weight: 500;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 20px;
        }
        h2 {
            margin-bottom: 30px;
            font-weight: 400;
        }
        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            width: 100%;
            max-width: 900px;
        }
        .card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            transition: transform 0.2s ease;
        }
        .card:hover { transform: translateY(-5px); }
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
        .card button:hover { background-color: #519839; }
        .logout {
            margin-top: 30px;
            color: #555;
            font-size: 14px;
        }
        .logout a {
            color: rgb(255, 25, 0);
            text-decoration: none;
            font-weight: bold;
            font-size: 18px;
        }
        .logout a:hover {
            text-decoration: underline;
        }
        .agenda-box {
            position: relative;
            background: #fff;
            padding: 20px 20px 50px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(161, 160, 155, 0.15);
            width: 100%;
            max-width: 600px;
        }
        .agenda-list {
            list-style: none;
            padding-left: 0;
            margin: 0;
            max-height: 130px;
            overflow: hidden;
            transition: max-height 0.4s ease;
        }
        .agenda-list.expandido {
            max-height: 1000px;
        }
        .agenda-list li {
            padding: 10px;
            border-bottom: 1px solid #eee;
            font-size: 16px;
        }
        .toggle-agenda {
            position: absolute;
            bottom: 8px;
            right: 8px;
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            transition: transform 0.3s;
        }
        .toggle-agenda.girado {
            transform: rotate(180deg);
        }
    </style>
</head>
<body>

<header>𝓕𝓵𝓸𝓻 𝓭𝓮 𝓒𝓱𝓮𝓲𝓻𝓸 </header>
<div class="container">
<form method="get" action="index.php" style="text-align:center; margin-bottom: 20px;">
    <input type="hidden" name="rota" value="painel">
    <label for="data" style="font-weight: bold; color: #fff; font-size: 24px; display: inline-flex; align-items: center; gap: 8px;">
        📅 Agenda do Dia:
        <input type="date" id="data" name="data" value="<?= htmlspecialchars($dataSelecionada) ?>" onchange="this.form.submit()" style="
            background: transparent;
            border: none;
            color: #fff;
            font-size: 22px;
            padding: 0 8px;
            outline: none;
            appearance: none;
            -webkit-appearance: none;
            text-align: left;
        ">
    </label>
</form>

<div class="agenda-box">
    <ul id="lista-agenda" class="agenda-list">
        <?php foreach ($pedidosHoje as $pedido): ?>
            <li><?= htmlspecialchars($pedido['nome']) ?> (<?= htmlspecialchars($pedido['produto']) ?>)</li>
        <?php endforeach; ?>
    </ul>

    <?php if (count($pedidosHoje) > 3): ?>
        <button id="toggle-btn" class="toggle-agenda" onclick="alternarLista()">⬇🌹</button>
    <?php endif; ?>
</div>

<script>
function alternarLista() {
    const lista = document.getElementById('lista-agenda');
    const btn = document.getElementById('toggle-btn');

    lista.classList.toggle('expandido');
    btn.classList.toggle('girado');
    btn.innerHTML = lista.classList.contains('expandido') ? '⬇🌹' : '⬇🌹';
}

// Garante que ao carregar a página a lista esteja recolhida
document.addEventListener('DOMContentLoaded', () => {
    const lista = document.getElementById('lista-agenda');
    const btn = document.getElementById('toggle-btn');
    lista.classList.remove('expandido');
    if (btn) btn.classList.remove('girado');
});
</script>


<!-- (restante do conteúdo permanece igual) -->



    <h2 style="margin-top:50px; color:#000;">🔁 Acompanhar Pedidos</h2>
    <div style="display:flex; gap:20px; overflow-x:auto; padding:20px 0;">
    <?php foreach ($statusAgrupado as $status => $lista): 
        $corFundo = match($status) {
            'Pendente' => '#e74c3c',
            'Produção' => '#f39c12',
            'Pronto' => '#2980b9',
            'Entregue' => '#1abc9c',
            default => '#ccc'
        };
    ?>
        <div style="flex:1; min-width:200px; background:<?= $corFundo ?>; padding:10px; border-radius:10px; color:white;">

                <h3 style="text-align:center;"><?= $status ?></h3>
                <?php if (count($lista) > 0): ?>
                    <?php foreach ($lista as $pedido): ?>
                        <div style="
    background: #fff;
    margin-bottom: 10px;
    padding: 12px;
    border-radius: 8px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.15);
    color: #000;
    font-size: 14px;
">

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

    <h2 style="color:#000;">Olá, <?= htmlspecialchars($nomeUsuario) ?>!</h2>
    <div class="card-container">
        <div class="card">
            <h3>Cadastrar Pedido</h3>
            <button onclick="location.href='index.php?rota=cadastrar-pedido'">Acessar</button>
        </div>
        <div class="card">
    <h3>Agenda de Pedidos</h3>
    <button onclick="location.href='index.php?rota=painel'">Acessar</button>
</div>

<?php if ($_SESSION['tipo'] === 'admin'): ?>
    <div class="card">
        <h3>Cadastrar Produto</h3>
        <button onclick="location.href='../app/views/produtos/criar.php'">Acessar</button>
    </div>
    <div class="card">
        <h3>Lista de Usuario</h3>
        <button onclick="location.href='/florV2/public/index.php?rota=listar-usuarios'">Acessar</button>
    </div>
<?php endif; ?>

<div class="card">
    <h3>Lista de Pedidos</h3>
    <button onclick="location.href='index.php?rota=lista-pedidos'">Acessar</button>
</div>
<div class="card">
    <h3>Cadastro Detalhado</h3>
    <button onclick="location.href='index.php?rota=cadastrar-pedido-detalhado'">Acessar</button>
</div>




</div> <!-- FECHA card-container corretamente -->

<!-- Botão de logout agora fora dos cards -->
<div class="logout" style="text-align: center; margin-top: 30px;">
    <a href="/florV2/public/index.php?rota=logout">Sair da conta</a>
</div>


</div>



</script>

</body>
</html>
