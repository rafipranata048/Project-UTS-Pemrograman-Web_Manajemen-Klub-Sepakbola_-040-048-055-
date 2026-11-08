

<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container">

    <?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

    <main class="main-content">

        <div class="topbar">
            <div>
                <h1>Manajemen Pemain</h1>
                <p>Kelola data pemain klub sepak bola.</p>
            </div>

            <div class="admin">Administrator</div>
        </div>

        <section class="content-card">

            <div class="section-header">
                <div>
                    <h2>Data Pemain</h2>
                    <p>Daftar seluruh pemain yang terdaftar pada klub.</p>
                </div>

                <a href="/football_club/public/pemain/tambah"
                   class="btn-primary">
                    + Tambah Pemain
                </a>
            </div>

            <div class="table-wrapper">

                <table class="data-table">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pemain</th>
                            <th>Klub</th>
                            <th>Posisi</th>
                            <th>Nomor Punggung</th>
                            <th>Tanggal Lahir</th>
                            <th>Kewarganegaraan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (!empty($dataPemain)): ?>

                            <?php $no = 1; ?>

                            <?php foreach ($dataPemain as $pemain): ?>

                                <tr>
                                    <td><?= $no++; ?></td>

                                    <td>
                                        <?= htmlspecialchars($pemain['nama_pemain']); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($pemain['nama_klub']); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($pemain['posisi']); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($pemain['nomor_punggung'] ?? '-'); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($pemain['tanggal_lahir'] ?? '-'); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($pemain['kewarganegaraan'] ?? '-'); ?>
                                    </td>
                                    <td>
                                        <div class="action-buttons">

                                            <a href="/football_club/public/pemain/edit?id=<?= (int) $pemain['id_pemain']; ?>"
                                            class="btn-edit">
                                                Edit
                                            </a>

                                            <form action="/football_club/public/pemain/hapus"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus data pemain ini?');">

                                                <input type="hidden"
                                                    name="id_pemain"
                                                    value="<?= (int) $pemain['id_pemain']; ?>">

                                                <button type="submit" class="btn-delete">
                                                    Hapus
                                                </button>

                                            </form>

                                        </div>
                                    </td>
                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>
                                <td colspan="8" class="empty-data">
                                    Belum ada data pemain.
                                </td>
                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </section>

    </main>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>