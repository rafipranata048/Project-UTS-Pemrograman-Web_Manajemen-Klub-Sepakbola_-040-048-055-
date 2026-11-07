
<?php

require_once __DIR__ . '/../config/koneksi.php';
require_once __DIR__ . '/../Repository/PelatihRepository.php';

class PelatihController
{
    public function index()
    {
        $repository = new PelatihRepository($GLOBALS['pdo']);

        $dataPelatih = $repository->getAll();

        require_once __DIR__ . '/../../views/pelatih/index.php';
    }

    public function create()
    {
    $repository = new PelatihRepository($GLOBALS['pdo']);


    $dataKlub = $repository->getAllKlub();

    require_once __DIR__ . '/../../views/pelatih/tambah.php';
    }

    private function validasiTeks($nilai)
    {
        return preg_match('/^[\p{L}\s.,\'’-]+$/u', $nilai) === 1;
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
        exit('Method tidak diizinkan.');
    }

    $repository = new PelatihRepository($GLOBALS['pdo']);

    $idKlub = trim($_POST['id_klub'] ?? '');
    $namaPelatih = trim($_POST['nama_pelatih'] ?? '');
    $jabatan = trim($_POST['jabatan'] ?? '');
    $kewarganegaraan = trim($_POST['kewarganegaraan'] ?? '');

    if (
        $idKlub === '' ||
        $namaPelatih === '' ||
        $jabatan === '' ||
        $kewarganegaraan === ''
    ) {
        $this->pesanError(
            'Semua kolom wajib diisi.',
            '/football_club/public/pelatih/tambah'
        );
    }

    if (!ctype_digit($idKlub) || (int) $idKlub <= 0) {
        $this->pesanError(
            'Klub yang dipilih tidak valid.',
            '/football_club/public/pelatih/tambah'
        );
    }


    if (!$this->validasiTeks($namaPelatih)) {
        $this->pesanError(
            'Nama pelatih harus berupa teks.',
            '/football_club/public/pelatih/tambah'
        );
    }

    if (!$this->validasiTeks($jabatan)) {
        $this->pesanError(
            'Jabatan harus berupa teks.',
            '/football_club/public/pelatih/tambah'
        );
    }


    if (!$this->validasiTeks($kewarganegaraan)) {
        $this->pesanError(
            'Kewarganegaraan harus berupa teks.',
            '/football_club/public/pelatih/tambah'
        );
    }


    if (!$repository->getKlubById((int) $idKlub)) {
        $this->pesanError(
            'Klub yang dipilih tidak ditemukan.',
            '/football_club/public/pelatih/tambah'
        );
    }


    $data = [
        'id_klub' => (int) $idKlub,
        'nama_pelatih' => $namaPelatih,
        'jabatan' => $jabatan,
        'kewarganegaraan' => $kewarganegaraan
    ];

  
    $repository->insert($data);

   
    header('Location: /football_club/public/pelatih');
    exit;
}
    public function edit()
    {
    $id = $_GET['id'] ?? '';

    if (!ctype_digit((string) $id) || (int) $id <= 0) {
        exit('ID pelatih tidak valid.');
    }

    $repository = new PelatihRepository($GLOBALS['pdo']);

    $pelatih = $repository->getById($id);

    if (!$pelatih) {
        exit('Data pelatih tidak ditemukan.');
    }

    $dataKlub = $repository->getAllKlub();

    require_once __DIR__ . '/../../views/pelatih/edit.php';
    }

   
    public function update()
    {
   
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        exit('Method tidak diizinkan.');
    }

  
    $id = $_POST['id_pelatih'] ?? '';

    if (!ctype_digit((string) $id) || (int) $id <= 0) {
        http_response_code(400);
        exit('ID pelatih tidak valid.');
    }

    $repository = new PelatihRepository($GLOBALS['pdo']);

   
    if (!$repository->getById((int) $id)) {
        http_response_code(404);
        exit('Data pelatih tidak ditemukan.');
    }

    
    $idKlub = trim($_POST['id_klub'] ?? '');
    $namaPelatih = trim($_POST['nama_pelatih'] ?? '');
    $jabatan = trim($_POST['jabatan'] ?? '');
    $kewarganegaraan = trim($_POST['kewarganegaraan'] ?? '');

    $halaman = '/football_club/public/pelatih/edit?id=' . (int) $id;

    if (
        $idKlub === '' ||
        $namaPelatih === '' ||
        $jabatan === '' ||
        $kewarganegaraan === ''
    ) {
        $this->pesanError('Semua kolom wajib diisi.', $halaman);
    }

   
    if (!ctype_digit($idKlub) || (int) $idKlub <= 0) {
        $this->pesanError('Klub yang dipilih tidak valid.', $halaman);
    }

  
    if (!$this->validasiTeks($namaPelatih)) {
        $this->pesanError('Nama pelatih harus berupa teks.', $halaman);
    }

 
    if (!$this->validasiTeks($jabatan)) {
        $this->pesanError('Jabatan harus berupa teks.', $halaman);
    }

 
    if (!$this->validasiTeks($kewarganegaraan)) {
        $this->pesanError('Kewarganegaraan harus berupa teks.', $halaman);
    }

    
    if (!$repository->getKlubById((int) $idKlub)) {
        $this->pesanError('Klub yang dipilih tidak ditemukan.', $halaman);
    }

   
    $data = [
        'id_klub' => (int) $idKlub,
        'nama_pelatih' => $namaPelatih,
        'jabatan' => $jabatan,
        'kewarganegaraan' => $kewarganegaraan
    ];


    $repository->update((int) $id, $data);

    header('Location: /football_club/public/pelatih');
    exit;
    }
    
    public function destroy()
    {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        exit('Method tidak diizinkan.');
    }

    $id = $_POST['id_pelatih'] ?? '';

  
    if (!ctype_digit((string) $id) || (int) $id <= 0) {
        exit('ID pelatih tidak valid.');
    }

    $repository = new PelatihRepository($GLOBALS['pdo']);

    
    if (!$repository->getById($id)) {
        exit('Data pelatih tidak ditemukan.');
    }

    
    $repository->delete($id);

    header('Location: /football_club/public/pelatih');
    exit;
    }
}
