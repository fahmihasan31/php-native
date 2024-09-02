<?php

class Kategori
{

    //koneksi databse dan nama table
    private $conn;
    private $table_name = "kategori";

    // property object anggota
    public $ID;
    public $NamaKategori;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    function create()
    {
        // insert
        $query = "INSERT INTO " . $this->table_name . " (NamaKategori)" .
            " VALUES (:NamaKategori)";

        $result = $this->conn->prepare($query);

        $result->bindParam(":NamaKategori", $this->NamaKategori);

        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }
    function update()
    {
        $query = "UPDATE " . $this->table_name . " SET
                                                    NamaKategori = :namakategori
                                                    WHERE 
                                                    ID = :ID";

        $result = $this->conn->prepare($query);

        // $this->NamaKategori = htmlspecialchars(strip_tags($this->NamaKategori));
        // $this->ID = htmlspecialchars(strip_tags($this->ID));

        // Bind parameters
        $result->bindParam(":namakategori", $this->NamaKategori);
        $result->bindParam(":ID", $this->ID);

        // Execute the query
        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function readAll()
    {
        // select
        $query = "SELECT * FROM " . $this->table_name;

        $result = $this->conn->prepare($query);
        $result->execute();

        return $result;
    }
    function readOne()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE ID = ?";

        $result = $this->conn->prepare($query);
        $result->bindParam(":ID", $this->ID);
        $result->execute();

        $row = $result->fetch(PDO::FETCH_ASSOC);

        $this->NamaKategori = $row["NamaKategori"];
        $this->ID = $row["ID"];
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



