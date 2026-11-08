<?php require_once __DIR__ . '/../layout/header.php'; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert-error">
        <?= htmlspecialchars($_SESSION['error']); ?>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<div class="container">
    <?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

    <main class="main-content">

        <div class="topbar">
            <div>
                <h1>Edit Pemain</h1>
                <p>Ubah informasi data pemain klub.</p>
            </div>

            <div class="admin">Administrator</div>
        </div>

        <section class="content-card">
            <h2>Form Edit Pemain</h2>

            <form action="/football_club/public/pemain/edit" method="POST">

                <input type="hidden" name="id_pemain"
                       value="<?= (int) $pemain['id_pemain']; ?>">

                <div class="form-group">
                    <label>Nama Pemain</label>
                    <input type="text" name="nama_pemain"
                           value="<?= htmlspecialchars($pemain['nama_pemain']); ?>"
                           required>
                </div>

                <div class="form-group">
                    <label>Klub</label>
                    <select name="id_klub" required>
                        <?php foreach ($dataKlub as $klub): ?>
                            <option
                                value="<?= (int) $klub['id_klub']; ?>"
                                <?= $klub['id_klub'] == $pemain['id_klub'] ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($klub['nama_klub']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Posisi</label>
                    <select name="posisi" required>
                        <?php
                        $posisiPemain = [
                            'Goalkeeper',
                            'Defender',
                            'Midfielder',
                            'Forward'
                        ];
                        ?>

                        <?php foreach ($posisiPemain as $posisi): ?>
                            <option
                                value="<?= $posisi; ?>"
                                <?= $posisi === $pemain['posisi'] ? 'selected' : ''; ?>>
                                <?= $posisi; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Nomor Punggung</label>
                    <input type="number" name="nomor_punggung"
                           min="0" max="65535"
                           value="<?= htmlspecialchars((string) ($pemain['nomor_punggung'] ?? '')); ?>">
                </div>

                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir"
                           value="<?= htmlspecialchars($pemain['tanggal_lahir'] ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label>Kewarganegaraan</label>
                    <input type="text" name="kewarganegaraan"
                           value="<?= htmlspecialchars($pemain['kewarganegaraan'] ?? ''); ?>">
                </div>

                <button type="submit" class="btn-primary">
                    Simpan Perubahan
                </button>

                <a href="/football_club/public/pemain"
                   class="btn-primary"
                   style="background: #64748b;">
                    Kembali
                </a>

            </form>
        </section>

    </main>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>