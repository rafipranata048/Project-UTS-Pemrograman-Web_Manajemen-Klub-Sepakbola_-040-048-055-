<?php
/**
 * @var array $pelatih
 * @var array $dataKlub
 */

require_once __DIR__ . '/../layout/header.php';
?>
<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container">
    <?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

    <main class="main-content">
        <div class="topbar">
            <div>
                <h1>Edit Pelatih</h1>
                <p>Ubah informasi data pelatih klub.</p>
            </div>
            <div class="admin">Administrator</div>
        </div>

        <section class="content-card">
            <h2>Form Edit Pelatih</h2>

            <form action="/football_club/public/pelatih/edit" method="POST">

                <input type="hidden" name="id_pelatih"
                       value="<?= (int) $pelatih['id_pelatih']; ?>">

                <div class="form-group">
                    <label>Nama Pelatih</label>
                    <input
                        type="text"
                        name="nama_pelatih"
                        value="<?= htmlspecialchars($pelatih['nama_pelatih']); ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Jabatan</label>
                    <input
                        type="text"
                        name="jabatan"
                        value="<?= htmlspecialchars($pelatih['jabatan']); ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Klub</label>
                    <select name="id_klub" required>
                        <?php foreach ($dataKlub as $klub): ?>
                            <option
                                value="<?= (int) $klub['id_klub']; ?>"
                                <?= $klub['id_klub'] == $pelatih['id_klub'] ? 'selected' : ''; ?>
                            >
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
                        value="<?= htmlspecialchars($pelatih['kewarganegaraan'] ?? ''); ?>"
                    >
                </div>

                <button type="submit" class="btn-primary">
                    Simpan Perubahan
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