
<?php

class PelatihRepository
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    
    public function getAll()
    {
        $sql = "SELECT
                    pelatih.id_pelatih,
                    pelatih.nama_pelatih,
                    pelatih.jabatan,
                    pelatih.kewarganegaraan,
                    klub.nama_klub
                FROM pelatih
                INNER JOIN klub
                    ON pelatih.id_klub = klub.id_klub
                ORDER BY pelatih.id_pelatih ASC";

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
    $sql = "SELECT id_klub FROM klub WHERE id_klub = :id";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        ':id' => $id
    ]);

    return $stmt->fetch();
    }
    public function insert($data)
    {
    $sql = "INSERT INTO pelatih
            (id_klub, nama_pelatih, jabatan, kewarganegaraan)
            VALUES
            (:id_klub, :nama_pelatih, :jabatan, :kewarganegaraan)";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        ':id_klub' => $data['id_klub'],
        ':nama_pelatih' => $data['nama_pelatih'],
        ':jabatan' => $data['jabatan'],
        ':kewarganegaraan' => $data['kewarganegaraan'] ?: null
    ]);
    }

    public function getById($id)
    {
    $sql = "SELECT * FROM pelatih
            WHERE id_pelatih = :id";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([
        ':id' => $id
    ]);

    return $stmt->fetch();
    }

    public function update($id, $data)
    {
    $sql = "UPDATE pelatih SET
                id_klub = :id_klub,
                nama_pelatih = :nama_pelatih,
                jabatan = :jabatan,
                kewarganegaraan = :kewarganegaraan
            WHERE id_pelatih = :id";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        ':id_klub' => $data['id_klub'],
        ':nama_pelatih' => $data['nama_pelatih'],
        ':jabatan' => $data['jabatan'],
        ':kewarganegaraan' => $data['kewarganegaraan'] ?: null,
        ':id' => $id
    ]);
    }

    
    public function delete($id)
    {
    $sql = "DELETE FROM pelatih
            WHERE id_pelatih = :id";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        ':id' => $id
    ]);
    }
}
