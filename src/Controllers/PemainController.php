
<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/koneksi.php';
require_once __DIR__ . '/../Repository/PemainRepository.php';

class PemainController
{
   
    public function index()
    {
        $repository = new PemainRepository($GLOBALS['pdo']);

        $dataPemain = $repository->getAll();

        require_once __DIR__ . '/../../views/pemain/index.php';
    }

 
    public function create()
    {
        $repository = new PemainRepository($GLOBALS['pdo']);

        $dataKlub = $repository->getAllKlub();

        require_once __DIR__ . '/../../views/pemain/tambah.php';
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

        $repository = new PemainRepository($GLOBALS['pdo']);

        $idKlub = trim($_POST['id_klub'] ?? '');
        $namaPemain = trim($_POST['nama_pemain'] ?? '');
        $posisi = trim($_POST['posisi'] ?? '');
        $nomorPunggung = trim($_POST['nomor_punggung'] ?? '');
        $tanggalLahir = trim($_POST['tanggal_lahir'] ?? '');
        $kewarganegaraan = trim($_POST['kewarganegaraan'] ?? '');

       
        if (
            $idKlub === '' ||
            $namaPemain === '' ||
            $posisi === '' ||
            $nomorPunggung === '' ||
            $kewarganegaraan === ''
        ) {
            $this->pesanError(
                'Semua kolom wajib harus diisi.',
                '/football_club/public/pemain/tambah'
            );
        }

      
        if (!ctype_digit($idKlub) || (int)$idKlub <= 0) {
            $this->pesanError(
                'Klub yang dipilih tidak valid.',
                '/football_club/public/pemain/tambah'
            );
        }

        if (!$this->validasiTeks($namaPemain)) {
            $this->pesanError(
                'Nama pemain harus berupa teks.',
                '/football_club/public/pemain/tambah'
            );
        }

        if (!$this->validasiTeks($posisi)) {
            $this->pesanError(
                'Posisi pemain harus berupa teks.',
                '/football_club/public/pemain/tambah'
            );
        }

        if (!$this->validasiTeks($kewarganegaraan)) {
            $this->pesanError(
                'Kewarganegaraan harus berupa teks.',
                '/football_club/public/pemain/tambah'
            );
        }

        if (!$repository->getKlubById((int)$idKlub)) {
            $this->pesanError(
                'Klub tidak ditemukan.',
                '/football_club/public/pemain/tambah'
            );
        }
        if (
            !ctype_digit($nomorPunggung) ||
            (int)$nomorPunggung > 65535
        ) {
            $this->pesanError(
                'Nomor punggung harus berupa angka antara 0 sampai 65535.',
                '/football_club/public/pemain/tambah'
            );
        }
        if ($tanggalLahir !== '') {
            $tanggal = DateTime::createFromFormat('!Y-m-d', $tanggalLahir);

            if (!$tanggal || $tanggal->format('Y-m-d') !== $tanggalLahir) {
                $this->pesanError(
                    'Tanggal lahir tidak valid.',
                    '/football_club/public/pemain/tambah'
                );
            }
        }

        $data = [
            'id_klub' => (int)$idKlub,
            'nama_pemain' => $namaPemain,
            'posisi' => $posisi,
            'nomor_punggung' => $nomorPunggung,
            'tanggal_lahir' => $tanggalLahir,
            'kewarganegaraan' => $kewarganegaraan
        ];

        try {
            $repository->insert($data);
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                $this->pesanError(
                    'Nomor punggung tersebut sudah digunakan oleh pemain lain di klub yang sama.',
                    '/football_club/public/pemain/tambah'
                );
            }

            throw $e;
        }

        header('Location: /football_club/public/pemain');
        exit;
    }
    public function edit()
    {
        $id = $_GET['id'] ?? '';

        if (!ctype_digit((string)$id) || (int)$id <= 0) {
            http_response_code(400);
            exit('ID pemain tidak valid.');
        }

        $repository = new PemainRepository($GLOBALS['pdo']);

        $pemain = $repository->getById((int)$id);

        if (!$pemain) {
            http_response_code(404);
            exit('Data pemain tidak ditemukan.');
        }

        $dataKlub = $repository->getAllKlub();

        require_once __DIR__ . '/../../views/pemain/edit.php';
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Metode tidak diizinkan.');
        }

        $id = $_POST['id_pemain'] ?? '';

        if (!ctype_digit((string)$id) || (int)$id <= 0) {
            http_response_code(400);
            exit('ID pemain tidak valid.');
        }

        $repository = new PemainRepository($GLOBALS['pdo']);

        
        if (!$repository->getById((int)$id)) {
            http_response_code(404);
            exit('Data pemain tidak ditemukan.');
        }

        $idKlub = trim($_POST['id_klub'] ?? '');
        $namaPemain = trim($_POST['nama_pemain'] ?? '');
        $posisi = trim($_POST['posisi'] ?? '');
        $nomorPunggung = trim($_POST['nomor_punggung'] ?? '');
        $tanggalLahir = trim($_POST['tanggal_lahir'] ?? '');
        $kewarganegaraan = trim($_POST['kewarganegaraan'] ?? '');

        
        if (
            $idKlub === '' ||
            $namaPemain === '' ||
            $posisi === '' ||
            $nomorPunggung === '' ||
            $kewarganegaraan === ''
        ) {
            $this->pesanError(
                'Semua kolom wajib harus diisi.',
                '/football_club/public/pemain/edit?id=' . (int)$id
            );
        }

       
        if (!ctype_digit($idKlub) || (int)$idKlub <= 0) {
            $this->pesanError(
                'Klub yang dipilih tidak valid.',
                '/football_club/public/pemain/edit?id=' . (int)$id
            );
        }


        if (!$this->validasiTeks($namaPemain)) {
            $this->pesanError(
                'Nama pemain harus berupa teks.',
                '/football_club/public/pemain/edit?id=' . (int)$id
            );
        }

        if (!$this->validasiTeks($posisi)) {
            $this->pesanError(
                'Posisi pemain harus berupa teks.',
                '/football_club/public/pemain/edit?id=' . (int)$id
            );
        }

      
        if (!$this->validasiTeks($kewarganegaraan)) {
            $this->pesanError(
                'Kewarganegaraan harus berupa teks.',
                '/football_club/public/pemain/edit?id=' . (int)$id
            );
        }

        if (!$repository->getKlubById((int)$idKlub)) {
            $this->pesanError(
                'Klub tidak ditemukan.',
                '/football_club/public/pemain/edit?id=' . (int)$id
            );
        }

        if (
            !ctype_digit($nomorPunggung) ||
            (int)$nomorPunggung > 65535
        ) {
            $this->pesanError(
                'Nomor punggung harus berupa angka antara 0 sampai 65535.',
                '/football_club/public/pemain/edit?id=' . (int)$id
            );
        }

        if ($tanggalLahir !== '') {
            $tanggal = DateTime::createFromFormat('!Y-m-d', $tanggalLahir);

            if (!$tanggal || $tanggal->format('Y-m-d') !== $tanggalLahir) {
                $this->pesanError(
                    'Tanggal lahir tidak valid.',
                    '/football_club/public/pemain/edit?id=' . (int)$id
                );
            }
        }

        $data = [
            'id_klub' => (int)$idKlub,
            'nama_pemain' => $namaPemain,
            'posisi' => $posisi,
            'nomor_punggung' => $nomorPunggung,
            'tanggal_lahir' => $tanggalLahir,
            'kewarganegaraan' => $kewarganegaraan
        ];

        try {
            $repository->update((int)$id, $data);
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                $this->pesanError(
                    'Nomor punggung tersebut sudah digunakan oleh pemain lain di klub yang sama.',
                    '/football_club/public/pemain/edit?id=' . (int)$id
                );
            }

            throw $e;
        }

        header('Location: /football_club/public/pemain');
        exit;
    }

    public function destroy()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Metode tidak diizinkan.');
        }

        $id = $_POST['id_pemain'] ?? '';

        if (!ctype_digit((string)$id) || (int)$id <= 0) {
            http_response_code(400);
            exit('ID pemain tidak valid.');
        }

        $repository = new PemainRepository($GLOBALS['pdo']);

        if (!$repository->getById((int)$id)) {
            http_response_code(404);
            exit('Data pemain tidak ditemukan.');
        }

        $repository->delete((int)$id);

        header('Location: /football_club/public/pemain');
        exit;
    }
}
