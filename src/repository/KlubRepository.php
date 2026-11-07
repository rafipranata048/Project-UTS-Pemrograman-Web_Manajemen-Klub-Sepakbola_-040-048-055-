<?php

class KlubRepository
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    
    public function getAll()
    {
        $sql = "SELECT * FROM klub ORDER BY id_klub ASC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function insert($data)
    {
    $sql = "INSERT INTO klub
            (nama_klub, kota, stadion, tahun_berdiri, deskripsi)
            VALUES
            (:nama_klub, :kota, :stadion, :tahun_berdiri, :deskripsi)";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        ':nama_klub' => $data['nama_klub'],
        ':kota' => $data['kota'],
        ':stadion' => $data['stadion'],
        ':tahun_berdiri' => $data['tahun_berdiri'] ?: null,
        ':deskripsi' => $data['deskripsi']
    ]);
    }

public function getById($id)
{
    $sql = "SELECT * FROM klub WHERE id_klub = :id";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([':id' => $id]);

    return $stmt->fetch();
}


public function update($id, $data)
{
    $sql = "UPDATE klub SET
            nama_klub = :nama_klub,
            kota = :kota,
            stadion = :stadion,
            tahun_berdiri = :tahun_berdiri,
            deskripsi = :deskripsi
            WHERE id_klub = :id";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        ':nama_klub' => $data['nama_klub'],
        ':kota' => $data['kota'],
        ':stadion' => $data['stadion'],
        ':tahun_berdiri' => $data['tahun_berdiri'] ?: null,
        ':deskripsi' => $data['deskripsi'],
        ':id' => $id
    ]);
}

public function delete($id)
{
    $sql = "DELETE FROM klub WHERE id_klub = :id";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        ':id' => $id
    ]);
}
}