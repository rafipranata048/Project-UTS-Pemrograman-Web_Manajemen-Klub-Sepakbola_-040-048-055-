<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../src/Core/Router.php';

require_once __DIR__ . '/../src/Controllers/DashboardController.php';
require_once __DIR__ . '/../src/Controllers/KlubController.php';
require_once __DIR__ . '/../src/Controllers/PemainController.php';
require_once __DIR__ . '/../src/Controllers/PelatihController.php';

$router = new Router();

$basePath = dirname($_SERVER['SCRIPT_NAME']);
$basePath = rtrim($basePath, '/');

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($basePath !== '' && $basePath !== '/' &&
    strpos($path, $basePath) === 0) {
    $path = substr($path, strlen($basePath));
}


if ($path === '/index.php') {
    $path = '/';
}

$path = '/' . trim($path, '/');

$dashboardController = new DashboardController();
$klubController = new KlubController();
$pemainController = new PemainController();
$pelatihController = new PelatihController();

// Route GET dan POST
$router->get('/', [$dashboardController, 'index']);
$router->get('/klub', [$klubController, 'index']);
$router->get('/klub/edit', [$klubController, 'edit']);
$router->post('/klub/edit', [$klubController, 'update']);
$router->get('/klub/tambah', [$klubController, 'create']);
$router->post('/klub/tambah', [$klubController, 'store']);
$router->get('/pemain', [$pemainController, 'index']);
$router->get('/pelatih', [$pelatihController, 'index']);
$router->post('/klub/hapus', [$klubController, 'destroy']);
$router->get('/pelatih/tambah', [$pelatihController, 'create']);
$router->post('/pelatih/tambah', [$pelatihController, 'store']);
$router->get('/pelatih/edit', [$pelatihController, 'edit']);
$router->post('/pelatih/edit', [$pelatihController, 'update']);
$router->post('/pelatih/hapus', [$pelatihController, 'destroy']);
$router->get('/pemain', [$pemainController, 'index']);
$router->get('/pemain/tambah', [$pemainController, 'create']);
$router->post('/pemain/tambah', [$pemainController, 'store']);
$router->get('/pemain/edit', [$pemainController, 'edit']);
$router->post('/pemain/edit', [$pemainController, 'update']);
$router->post('/pemain/hapus', [$pemainController, 'destroy']);
// Menjalankan Router
$router->dispatch($_SERVER['REQUEST_METHOD'], $path);
