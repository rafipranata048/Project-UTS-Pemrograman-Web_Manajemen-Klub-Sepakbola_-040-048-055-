
<?php require_once __DIR__ . '/../layout/header.php'; ?>


<div class="container">

    <?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

    <main class="main-content">

        <div class="topbar">
            <div>
                <h1>Data Klub</h1>
                <p>Daftar klub sepak bola.</p>
            </div>

            <div class="admin">Administrator</div>
        </div>

        <section class="content-card">

            <div class="section-header">
                <div>
                    <h2>Daftar Klub</h2>
                    <p>Kelola informasi klub sepak bola.</p>
                </div>

                <a href="/football_club/public/klub/tambah"
                   class="btn-primary">
                    + Tambah Klub
                </a>
            </div>

            <div class="table-wrapper">

                <table class="data-table">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Klub</th>
                            <th>Kota</th>
                            <th>Stadion</th>
                            <th>Tahun Berdiri</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (!empty($dataKlub)): ?>

                            <?php $no = 1; ?>

                            <?php foreach ($dataKlub as $klub): ?>

                                <tr>
                                    <td><?= $no++; ?></td>

                                    <td>
                                        <strong>
                                            <?= htmlspecialchars($klub['nama_klub'], ENT_QUOTES, 'UTF-8'); ?>
                                        </strong>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($klub['kota'], ENT_QUOTES, 'UTF-8'); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($klub['stadion'], ENT_QUOTES, 'UTF-8'); ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($klub['tahun_berdiri'] ?? '-', ENT_QUOTES, 'UTF-8'); ?>
                                    </td>

                                    <td>
                                        <div class="action-buttons">

                                            <a href="/football_club/public/klub/edit?id=<?= (int) $klub['id_klub']; ?>"
                                               class="btn-edit">
                                                Edit
                                            </a>

                                            <form action="/football_club/public/klub/hapus"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus klub ini?');">

                                                <input type="hidden"
                                                       name="id_klub"
                                                       value="<?= (int) $klub['id_klub']; ?>">

                                                <button type="submit"
                                                        class="btn-delete">
                                                    Hapus
                                                </button>

                                            </form>

                                        </div>
                                    </td>
                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>
                                <td colspan="6" class="empty-state">
                                    Belum ada data klub.
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
