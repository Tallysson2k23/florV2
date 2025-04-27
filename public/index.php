<?php
require_once '../config/database.php';
require_once '../config/routes.php';

$route = $_GET['route'] ?? 'login'; // Rota padrão é login se não passar nenhuma

if (isset($routes[$route])) {
    $controllerName = $routes[$route]['controller'];
    $actionName = $routes[$route]['action'];

    require_once '../app/controllers/' . $controllerName . '.php';

    $controller = new $controllerName();
    $controller->$actionName();
} else {
    echo "Página não encontrada.";
}
?>
