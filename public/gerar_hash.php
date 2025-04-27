<?php
$senha = '123456'; // aqui é a senha em texto puro
$hash = password_hash($senha, PASSWORD_DEFAULT);

echo "Novo hash gerado: <br>" . $hash;
?>
