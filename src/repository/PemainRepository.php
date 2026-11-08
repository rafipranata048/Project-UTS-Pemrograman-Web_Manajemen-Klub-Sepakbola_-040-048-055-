<?php

class PemainRepository
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        $sql = "SELECT
                    pemain.id_pemain,
                    pemain.nama_pemain,
                    pemain.posisi,
                    pemain.nomor_punggung,
                    pemain.tanggal_lahir,
                    pemain.kewarganegaraan,
                    klub.nama_klub
                FROM pemain
                INNER JOIN klub
                    ON pemain.id_klub = klub.id_klub
                ORDER BY pemain.id_pemain ASC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getAllKlub()
    {
    $sql = "SELECT id_klub, nama_klub
            FROM klub
            ORDER BY nama_klub ASC";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll();
    }

    public function getKlubById($id)
    {
    $sql = "SELECT id_klub
            FROM klub
            WHERE id_klub = :id";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        ':id' => $id
    ]);

    return $stmt->fetch();
    }

    public function insert($data)
    {
    $sql = "INSERT INTO pemain
            (id_klub, nama_pemain, posisi, nomor_punggung,
             tanggal_lahir, kewarganegaraan)
            VALUES
            (:id_klub, :nama_pemain, :posisi, :nomor_punggung,
             :tanggal_lahir, :kewarganegaraan)";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        ':id_klub' => $data['id_klub'],
        ':nama_pemain' => $data['nama_pemain'],
        ':posisi' => $data['posisi'],
        ':nomor_punggung' => $data['nomor_punggung'] ?: null,
        ':tanggal_lahir' => $data['tanggal_lahir'] ?: null,
        ':kewarganegaraan' => $data['kewarganegaraan'] ?: null
    ]);
    }

   
    public function getById($id)
    {
    $sql = "SELECT * FROM pemain
            WHERE id_pemain = :id";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([
        ':id' => $id
    ]);

    return $stmt->fetch();
    }

    public function update($id, $data)
    {
    $sql = "UPDATE pemain SET
                id_klub = :id_klub,
                nama_pemain = :nama_pemain,
                posisi = :posisi,
                nomor_punggung = :nomor_punggung,
                tanggal_lahir = :tanggal_lahir,
                kewarganegaraan = :kewarganegaraan
            WHERE id_pemain = :id";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        ':id_klub' => $data['id_klub'],
        ':nama_pemain' => $data['nama_pemain'],
        ':posisi' => $data['posisi'],
        ':nomor_punggung' => $data['nomor_punggung'] ?: null,
        ':tanggal_lahir' => $data['tanggal_lahir'] ?: null,
        ':kewarganegaraan' => $data['kewarganegaraan'] ?: null,
        ':id' => $id
    ]);
    }

    
public function delete($id)
{
    $sql = "DELETE FROM pemain
            WHERE id_pemain = :id";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        ':id' => $id
    ]);
    }
}