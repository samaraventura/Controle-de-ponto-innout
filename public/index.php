<?php

require_once(dirname(__FILE__, 2) . '/src/config/config.php');

// Obtém o caminho da URL
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Extrai apenas o nome do arquivo com a barra inicial (ex: /LoginController.php)
$uri = preg_replace('#^.*/#', '/', $uri);

// Define controllers públicos que não exigem autenticação
$publicRoutes = [
    '/LoginController.php',
    '/Logout.php'
];

// Redireciona para LoginController por padrão (ex: acesso a / ou /index.php)
if ($uri === '/' || $uri === '' || $uri === '/index.php') {
    $uri = '/LoginController.php';
}

// Aplica verificação de login caso a rota não seja pública
if (!in_array($uri, $publicRoutes)) {
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: /LoginController.php');
        exit();
    }
}

// Monta o caminho completo da controller
$controllerFile = CONTROLLER_PATH . $uri;

// Verifica se o arquivo existe antes de incluir
if (file_exists($controllerFile)) {
    require_once($controllerFile);
} else {
    // Página 404 simples
    http_response_code(404);
    echo "Página não encontrada: $uri";
}
