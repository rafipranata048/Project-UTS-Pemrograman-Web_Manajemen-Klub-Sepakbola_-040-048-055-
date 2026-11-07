
<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/koneksi.php';
require_once __DIR__ . '/../Repository/KlubRepository.php';

class KlubController
{
    public function index()
    {
        $repository = new KlubRepository($GLOBALS['pdo']);

        $dataKlub = $repository->getAll();

        require_once __DIR__ . '/../../views/klub/index.php';
    }

    
    public function create()
    {
        require_once __DIR__ . '/../../views/klub/create.php';
    }

    private function validasiTeks($nilai)
    {
        return preg_match('/\p{L}/u', $nilai) === 1;
    }

    private function pesanError($pesan, $halaman)
    {
        $_SESSION['error'] = $pesan;

        header('Location: ' . $halaman);
        exit;
    }


    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Metode tidak diizinkan.');
        }

        $nama = trim($_POST['nama_klub'] ?? '');
        $kota = trim($_POST['kota'] ?? '');
        $stadion = trim($_POST['stadion'] ?? '');
        $tahun = trim($_POST['tahun_berdiri'] ?? '');
        $deskripsi = trim($_POST['deskripsi'] ?? '');

        if ($nama === '' || $kota === '' || $stadion === '' || $tahun === '') {
            $this->pesanError(
                'Nama klub, kota, stadion, dan tahun berdiri wajib diisi.',
                '/football_club/public/klub/tambah'
            );
        }

        if (
            !$this->validasiTeks($nama) ||
            !$this->validasiTeks($kota) ||
            !$this->validasiTeks($stadion)
        ) {
            $this->pesanError(
                'Nama klub, kota, dan stadion harus berupa teks.',
                '/football_club/public/klub/tambah'
            );
        }

        if (
            !ctype_digit($tahun) ||
            (int)$tahun < 1 ||
            (int)$tahun > 9999
        ) {
            $this->pesanError(
                'Tahun berdiri harus berupa angka yang valid.',
                '/football_club/public/klub/tambah'
            );
        }

        $repository = new KlubRepository($GLOBALS['pdo']);

        $repository->insert([
            'nama_klub' => $nama,
            'kota' => $kota,
            'stadion' => $stadion,
            'tahun_berdiri' => $tahun,
            'deskripsi' => $deskripsi
        ]);

        header('Location: /football_club/public/klub');
        exit;
    }

    public function edit()
    {
        $id = $_GET['id'] ?? '';

        if (!ctype_digit((string)$id) || (int)$id < 1) {
            http_response_code(400);
            exit('ID klub tidak valid.');
        }

        $repository = new KlubRepository($GLOBALS['pdo']);

        $klub = $repository->getById((int)$id);

        if (!$klub) {
            http_response_code(404);
            exit('Data klub tidak ditemukan.');
        }

        require_once __DIR__ . '/../../views/klub/edit.php';
    }

    public function update()
    {
        $id = $_POST['id_klub'] ?? '';

        if (!ctype_digit((string)$id) || (int)$id < 1) {
            http_response_code(400);
            exit('ID klub tidak valid.');
        }

        $nama = trim($_POST['nama_klub'] ?? '');
        $kota = trim($_POST['kota'] ?? '');
        $stadion = trim($_POST['stadion'] ?? '');
        $tahun = trim($_POST['tahun_berdiri'] ?? '');
        $deskripsi = trim($_POST['deskripsi'] ?? '');


        if ($nama === '' || $kota === '' || $stadion === '' || $tahun === '') {
            $this->pesanError(
                'Nama klub, kota, stadion, dan tahun berdiri wajib diisi.',
                '/football_club/public/klub/edit?id=' . (int)$id
            );
        }

        if (
            !$this->validasiTeks($nama) ||
            !$this->validasiTeks($kota) ||
            !$this->validasiTeks($stadion)
        ) {
            $this->pesanError(
                'Nama klub, kota, dan stadion harus berupa teks.',
                '/football_club/public/klub/edit?id=' . (int)$id
            );
        }

        if (
            !ctype_digit($tahun) ||
            (int)$tahun < 1 ||
            (int)$tahun > 9999
        ) {
            $this->pesanError(
                'Tahun berdiri harus berupa angka yang valid.',
                '/football_club/public/klub/edit?id=' . (int)$id
            );
        }

        $repository = new KlubRepository($GLOBALS['pdo']);

        $repository->update((int)$id, [
            'nama_klub' => $nama,
            'kota' => $kota,
            'stadion' => $stadion,
            'tahun_berdiri' => $tahun,
            'deskripsi' => $deskripsi
        ]);

        header('Location: /football_club/public/klub');
        exit;
    }

    public function destroy()
    {
        $id = $_POST['id_klub'] ?? '';

    
        if (!ctype_digit((string)$id) || (int)$id < 1) {
            http_response_code(400);
            exit('ID klub tidak valid.');
        }

        $repository = new KlubRepository($GLOBALS['pdo']);

        try {
            $repository->delete((int)$id);

            header('Location: /football_club/public/klub');
            exit;

        } catch (PDOException $e) {
            http_response_code(409);
            exit('Klub tidak dapat dihapus karena masih memiliki data pemain atau pelatih.');
        }
    }
}
