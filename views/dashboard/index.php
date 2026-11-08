<?php
/**
 * @var int $totalKlub
 * @var int $totalPemain
 * @var int $totalPelatih
 */

require_once __DIR__ . '/../layout/header.php';
?>
<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container">

    <?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

    <main class="main-content">

        <div class="topbar">
            <div>
                <h1>Dashboard</h1>
                <p>Selamat datang di Football Club Management System.</p>
            </div>

            <div class="admin">
                Administrator
            </div>
        </div>

        <section class="stats">

            <div class="stat-card">
                <p>Total Klub</p>
                <h2><?= $totalKlub; ?></h2>
            </div>

            <div class="stat-card">
                <p>Total Pemain</p>
                <h2><?= $totalPemain; ?></h2>
            </div>

            <div class="stat-card">
                <p>Total Pelatih</p>
                <h2><?= $totalPelatih; ?></h2>
            </div>

        </section>

        <section class="content-card">
            <h2>Football Club Management System</h2>

            <p>
                Sistem ini digunakan untuk mengelola informasi
                klub sepak bola, data pemain, dan data pelatih
                dalam satu platform.
            </p>
        </section>

    </main>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
