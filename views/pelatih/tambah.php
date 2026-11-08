<?php
/**
 * @var array $dataKlub
 */

require_once __DIR__ . '/../layout/header.php';
?>
<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container">
    <?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

    <main class="main-content">
        <?php if (isset($_SESSION['error'])): ?>
    <div class="alert-error">
        <?= htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8'); ?>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

        <div class="topbar">
            <div>
                <h1>Tambah Pelatih</h1>
                <p>Tambahkan data pelatih baru ke dalam sistem.</p>
            </div>
            <div class="admin">Administrator</div>
        </div>

        <section class="content-card">
            <h2>Form Tambah Pelatih</h2>

            <form action="/football_club/public/pelatih/tambah" method="POST">

                <div class="form-group">
                    <label>Nama Pelatih</label>
                    <input type="text" name="nama_pelatih"
                           placeholder="Masukkan nama pelatih" required>
                </div>

                <div class="form-group">
                    <label>Jabatan</label>
                    <input type="text" name="jabatan"
                           placeholder="Contoh: Head Coach" required>
                </div>

                <div class="form-group">
                    <label>Klub</label>
                    <select name="id_klub" required>
                        <option value="">-- Pilih Klub --</option>

                        <?php foreach ($dataKlub as $klub): ?>
                            <option value="<?= (int) $klub['id_klub']; ?>">
                                <?= htmlspecialchars($klub['nama_klub']); ?>
                            </option>
                        <?php endforeach; ?>

                    </select>
                </div>

                <div class="form-group">
                    <label>Kewarganegaraan</label>
                    <input 
                            type="text"
                            name="kewarganegaraan"
                            placeholder="Masukkan kewarganegaraan"
                            required
                            >  
                </div>

                <button type="submit" class="btn-primary">
                    Simpan Pelatih
                </button>

                <a href="/football_club/public/pelatih"
                   class="btn-primary"
                   style="background: #64748b;">
                    Kembali
                </a>

            </form>
        </section>
    </main>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>