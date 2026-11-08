<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container">
    <?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

    <main class="main-content">
        <div class="topbar">
            <div>
                <h1>Tambah Klub</h1>
                <p>Masukkan informasi klub baru.</p>
            </div>
            <div class="admin">Administrator</div>
        </div>

        <section class="content-card">
            <h2>Form Tambah Klub</h2>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert-error">
                    <?= htmlspecialchars($_SESSION['error']); ?>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <form action="/football_club/public/klub/tambah" method="POST">

                <label>Nama Klub</label>
                <input type="text" name="nama_klub" required>

                <label>Kota</label>
                <input type="text" name="kota" required>

                <label>Stadion</label>
                <input type="text" name="stadion" required>

                <label>Tahun Berdiri</label>
                <input type="number" name="tahun_berdiri"
                       min="1" max="9999">

                <label>Deskripsi</label>
                <textarea name="deskripsi"></textarea>

                <button type="submit">Simpan Klub</button>
                <a href="/football_club/public/klub">Kembali</a>

            </form>
        </section>
    </main>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>