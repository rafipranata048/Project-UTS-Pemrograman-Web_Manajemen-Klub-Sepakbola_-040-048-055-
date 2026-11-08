
<?php
$currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$baseUrl = '/football_club/public';

?>

<aside class="sidebar">

    <div class="logo">
        FOOTBALL<span> CLUB</span>
    </div>

    <p class="menu-title">MENU UTAMA</p>

    <nav class="menu">

        <a href="<?= $baseUrl ?>/"
           class="<?= $currentPath === $baseUrl . '/' || $currentPath === $baseUrl . '/index.php' ? 'active' : ''; ?>">
            Dashboard
        </a>

        <a href="<?= $baseUrl ?>/klub"
           class="<?= strpos($currentPath, $baseUrl . '/klub') === 0 ? 'active' : ''; ?>">
            Data Klub
        </a>

        <a href="<?= $baseUrl ?>/pemain"
           class="<?= strpos($currentPath, $baseUrl . '/pemain') === 0 ? 'active' : ''; ?>">
            Manajemen Pemain
        </a>

        <a href="<?= $baseUrl ?>/pelatih"
           class="<?= strpos($currentPath, $baseUrl . '/pelatih') === 0 ? 'active' : ''; ?>">
            Manajemen Pelatih
        </a>

    </nav>

</aside>
