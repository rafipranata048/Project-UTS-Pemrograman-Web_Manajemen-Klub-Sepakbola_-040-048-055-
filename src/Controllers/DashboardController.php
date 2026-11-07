<?php

require_once __DIR__ . '/../config/koneksi.php';

class DashboardController
{
    public function index()
    {
        global $pdo;

    
        $queryKlub = $pdo->prepare("SELECT COUNT(*) FROM klub");
        $queryKlub->execute();
        $totalKlub = $queryKlub->fetchColumn();

    
        $queryPemain = $pdo->prepare("SELECT COUNT(*) FROM pemain");
        $queryPemain->execute();
        $totalPemain = $queryPemain->fetchColumn();

        $queryPelatih = $pdo->prepare("SELECT COUNT(*) FROM pelatih");
        $queryPelatih->execute();
        $totalPelatih = $queryPelatih->fetchColumn();

        require_once __DIR__ . '/../../views/dashboard/index.php';
    }
}