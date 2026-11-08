

<?php 

/**
 * @var array $dataKlub
 */

require_once __DIR__ . '/../layout/header.php'; ?>

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
                <h1>Tambah Pemain</h1>
                <p>Tambahkan data pemain baru ke dalam sistem.</p>
            </div>
            <div class="admin">Administrator</div>
        </div>

        <section class="content-card">
            <h2>Form Tambah Pemain</h2>

            <form action="/football_club/public/pemain/tambah" method="POST">

                <div class="form-group">
                    <label>Nama Pemain</label>
                    <input type="text" name="nama_pemain"
                           placeholder="Masukkan nama pemain" required>
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
                    <label>Posisi</label>
                    <select name="posisi" required>
                        <option value="">-- Pilih Posisi --</option>
                        <option value="Goalkeeper">Goalkeeper</option>
                        <option value="Defender">Defender</option>
                        <option value="Midfielder">Midfielder</option>
                        <option value="Forward">Forward</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Nomor Punggung</label>
                    <input type="number" name="nomor_punggung"
                           min="0" max="65535"
                           placeholder="Masukkan nomor punggung">
                </div>

                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir">
                </div>

                <div class="form-group">
                    <label>Kewarganegaraan</label>
                    <input type="text" name="kewarganegaraan"
                           placeholder="Masukkan kewarganegaraan">
                </div>

                <button type="submit" class="btn-primary">
                    Simpan Pemain
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