<?php
require_once '../config/database.php';

$db = new Database();
$conn = $db->connect();

if ($conn) {
    echo "✅ Conexão com banco de dados feita com sucesso!";
} else {
    echo "❌ Falha na conexão com banco de dados!";
}
?>
