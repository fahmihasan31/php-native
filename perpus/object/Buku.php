<?php
class Buku
{
    private $conn;
    private $table_name = "buku";

    public $ID;
    public $ISBN;
    public $Judul;
    public $Pengarang;
    public $Kategori_ID;
    public $Penerbit_ID;
    public $Deskripsi;
    public $Stok;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function create()
    {
        $query = "INSERT INTO " . $this->table_name . "(ISBN, Judul, Pengarang, Kategori_ID, Penerbit_ID, Deskripsi, Stok)" .
            "   VALUE (:ISBN, :Judul, :Pengarang, :Kategori_ID, :Penerbit_ID, :Deskripsi, :Stok)";

        $result = $this->conn->prepare($query);

        $this->ISBN = htmlspecialchars(strip_tags($this->ISBN));
        $this->Judul = htmlspecialchars(strip_tags($this->Judul));
        $this->Pengarang = htmlspecialchars(strip_tags($this->Pengarang));
        $this->Kategori_ID = htmlspecialchars(strip_tags($this->Kategori_ID));
        $this->Penerbit_ID = htmlspecialchars(strip_tags($this->Penerbit_ID));
        $this->Deskripsi = htmlspecialchars(strip_tags($this->Deskripsi));
        $this->Stok = htmlspecialchars(strip_tags($this->Stok));

        $result->bindParam(":ISBN", $this->ISBN);
        $result->bindParam(":Judul", $this->Judul);
        $result->bindParam(":Pengarang", $this->Pengarang);
        $result->bindParam(":Kategori_ID", $this->Kategori_ID);
        $result->bindParam(":Penerbit_ID", $this->Penerbit_ID);
        $result->bindParam(":Deskripsi", $this->Deskripsi);
        $result->bindParam(":Stok", $this->Stok);

        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }
    function readAll()
    {
        $query = "SELECT buku.ID,
                        buku.ISBN,
                        buku.Judul,
                        buku.Pengarang,
                        buku.Kategori_ID,
                        buku.Penerbit_ID,
                        buku.Deskripsi,
                        buku.Stok,
                        kategori.NamaKategori,
                        penerbit.NamaPenerbit
                        FROM buku JOIN kategori ON buku.Kategori_ID = kategori.ID
                                    JOIN penerbit ON buku.Penerbit_ID = penerbit.ID";

        $result = $this->conn->prepare($query);
        $result->execute();

        return $result;
    }
    function readOne()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE ID = ?";

        $result = $this->conn->prepare($query);
        $result->bindParam(1, $this->ID);
        $result->execute();

        $row = $result->fetch(PDO::FETCH_ASSOC);

        $this->ISBN = $row["ISBN"];
        $this->Judul = $row['Judul'];
        $this->Pengarang = $row['Pengarang'];
        $this->Kategori_ID = $row['Kategori_ID'];
        $this->Penerbit_ID = $row['Penerbit_ID'];
        $this->Deskripsi = $row['Deskripsi'];
        $this->Stok = $row['Stok'];
    }

    function update()
    {
        $query = "UPDATE " . $this->table_name . " SET
                                                ISBN = :ISBN,
                                                Judul= :Judul,
                                                Pengarang = :Pengarang,
                                                Kategori_ID = :Kategori_ID,
                                                Penerbit_ID = :Penerbit_ID,
                                                Deskripsi = :Deskripsi,
                                                Stok = :Stok
                                            WHERE ID  = :ID";

        $result = $this->conn->prepare($query);

        $this->ISBN = htmlspecialchars(strip_tags($this->ISBN));
        $this->Judul = htmlspecialchars(strip_tags($this->Judul));
        $this->Pengarang = htmlspecialchars(strip_tags($this->Pengarang));
        $this->Kategori_ID = htmlspecialchars(strip_tags($this->Kategori_ID));
        $this->Penerbit_ID = htmlspecialchars(strip_tags($this->Penerbit_ID));
        $this->Deskripsi = htmlspecialchars(strip_tags($this->Deskripsi));
        $this->Stok = htmlspecialchars(strip_tags($this->Stok));

        $result->bindParam(":ISBN", $this->ISBN);
        $result->bindParam(":Judul", $this->Judul);
        $result->bindParam(":Pengarang", $this->Pengarang);
        $result->bindParam(":Kategori_ID", $this->Kategori_ID);
        $result->bindParam(":Penerbit_ID", $this->Penerbit_ID);
        $result->bindParam(":Deskripsi", $this->Deskripsi);
        $result->bindParam(":Stok", $this->Stok);
        $result->bindParam(":ID", $this->ID);

        if ($result->execute()) {
            return true;
        } else {
            return false;
        }

    }
    function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE ID = ?";

        $result = $this->conn->prepare($query);
        $result->bindParam(1, $this->ID);

        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }
}