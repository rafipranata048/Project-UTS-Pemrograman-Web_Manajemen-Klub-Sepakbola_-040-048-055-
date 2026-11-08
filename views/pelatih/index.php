<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div class="container">

    <?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

    <main class="main-content">

        <div class="topbar">
            <div>
                <h1>Manajemen Pelatih</h1>
                <p>Kelola data pelatih klub sepak bola.</p>
            </div>

            <div class="admin">Administrator</div>
        </div>

    
    <section class="content-card">

        <div class="section-header">
        <div>
            <h2>Data Pelatih</h2>
            <p>Daftar seluruh pelatih yang terdaftar pada klub.</p>
        </div>

        <a href="/football_club/public/pelatih/tambah"
           class="btn-primary">
            + Tambah Pelatih
        </a>
    </div>

    <div class="table-wrapper">

        <table class="data-table">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pelatih</th>
                    <th>Jabatan</th>
                    <th>Klub</th>
                    <th>Kewarganegaraan</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                <?php if (!empty($dataPelatih)): ?>

                    <?php $no = 1; ?>

                    <?php foreach ($dataPelatih as $pelatih): ?>

                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($pelatih['nama_pelatih']); ?></td>
                            <td><?= htmlspecialchars($pelatih['jabatan']); ?></td>
                            <td><?= htmlspecialchars($pelatih['nama_klub']); ?></td>
                            <td><?= htmlspecialchars($pelatih['kewarganegaraan'] ?? '-'); ?></td>
                            <td>
                                <div class="action-buttons">

                                    <a href="/football_club/public/pelatih/edit?id=<?= (int) $pelatih['id_pelatih']; ?>"
                                    class="btn-edit">
                                        Edit
                                    </a>

                                    <form action="/football_club/public/pelatih/hapus"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data pelatih ini?');">

                                        <input type="hidden"
                                            name="id_pelatih"
                                            value="<?= (int) $pelatih['id_pelatih']; ?>">

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
                        <td colspan="6" class="empty-data">
                            Belum ada data pelatih.
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