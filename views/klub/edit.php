<?php
/**
 * @var array $klub
 */

require_once __DIR__ . '/../layout/header.php';
?>

<div class="container">

    <?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

    <main class="main-content">

        <div class="topbar">
            <div>
                <h1>Edit Klub</h1>
                <p>Ubah informasi klub.</p>
            </div>

            <div class="admin">Administrator</div>
        </div>

        <section class="content-card">

            <h2>Form Edit Klub</h2>

            <form action="/football_club/public/klub/edit" method="POST">

                <input type="hidden"
                       name="id_klub"
                       value="<?= htmlspecialchars((string)$klub['id_klub']); ?>">

                <label>Nama Klub</label>
                <input type="text"
                       name="nama_klub"
                       value="<?= htmlspecialchars($klub['nama_klub']); ?>"
                       required>

                <label>Kota</label>
                <input type="text"
                       name="kota"
                       value="<?= htmlspecialchars($klub['kota']); ?>"
                       required>

                <label>Stadion</label>
                <input type="text"
                       name="stadion"
                       value="<?= htmlspecialchars($klub['stadion']); ?>"
                       required>

                <label>Tahun Berdiri</label>
                <input type="number"
                       name="tahun_berdiri"
                       min="1"
                       max="9999"
                       value="<?= htmlspecialchars((string)($klub['tahun_berdiri'] ?? '')); ?>">

                <label>Deskripsi</label>
                <textarea name="deskripsi"><?= htmlspecialchars($klub['deskripsi'] ?? ''); ?></textarea>

                <button type="submit">Simpan Perubahan</button>

                <a href="/football_club/public/klub">Kembali</a>

            </form>

        </section>

    </main>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>