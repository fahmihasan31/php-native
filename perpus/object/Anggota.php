<?php

class Anggota{

    //koneksi databse dan nama table
    private $conn;
    private $table_name = "anggota";

    // property object anggota
    public $ID;
    public $NIK;
    public $NamaLengkap;
    public $Alamat;
    public $NoTelp;
    public $TglRegistrasi;
    public $TglLahir;

    public function __construct($db) {
        $this->conn = $db;
    }
    function create() {
        // insert
        $query = "INSERT INTO " . $this->table_name . " (NIK, NamaLengkap, Alamat, NoTelp, TglRegistrasi, TglLahir)" .
                                  " VALUES (:NIK, :NamaLengkap, :Alamat, :NoTelp, :TglRegistrasi, :TglLahir)";
        
        $result = $this->conn->prepare($query);
    
        $this->NIK = htmlspecialchars(strip_tags($this->NIK));
        $this->NamaLengkap = htmlspecialchars(strip_tags($this->NamaLengkap));
        $this->Alamat = htmlspecialchars(strip_tags($this->Alamat));
        $this->NoTelp = htmlspecialchars(strip_tags($this->NoTelp));
        $this->TglRegistrasi = date("Y-m-d");
        $this->TglLahir = htmlspecialchars(strip_tags($this->TglLahir));
    
        $result->bindParam(":NIK", $this->NIK);
        $result->bindParam(":NamaLengkap", $this->NamaLengkap);
        $result->bindParam(":Alamat", $this->Alamat);
        $result->bindParam(":NoTelp", $this->NoTelp);
        $result->bindParam(":TglRegistrasi", $this->TglRegistrasi);
        $result->bindParam(":TglLahir", $this->TglLahir);
        
        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }
    function update() {
        $query = "UPDATE " . $this->table_name . " SET
                                                    NIK = :NIK,
                                                    NamaLengkap = :NamaLengkap,
                                                    Alamat = :Alamat,
                                                    NoTelp = :NoTelp,
                                                    TglLahir = :TglLahir
                                                    WHERE 
                                                    ID = :ID";
        
        $result = $this->conn->prepare($query);

        $this->NIK = htmlspecialchars(strip_tags($this->NIK));
        $this->NamaLengkap = htmlspecialchars(strip_tags($this->NamaLengkap));
        $this->Alamat = htmlspecialchars(strip_tags($this->Alamat));
        $this->NoTelp = htmlspecialchars(strip_tags($this->NoTelp));
        $this->TglLahir = htmlspecialchars(strip_tags($this->TglLahir));
    
        // Bind parameters
        $result->bindParam(":NIK", $this->NIK);
        $result->bindParam(":NamaLengkap", $this->NamaLengkap);
        $result->bindParam(":Alamat", $this->Alamat);
        $result->bindParam(":NoTelp", $this->NoTelp);
        $result->bindParam(":TglLahir", $this->TglLahir);
        $result->bindParam(":ID", $this->ID);
    
        // Execute the query
        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function readAll() {
        // select
        $query = "SELECT * FROM " . $this->table_name;

        $result = $this->conn->prepare($query);
        $result->execute();

        return $result;
    }
    function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE ID = ?";
        
        $result = $this->conn->prepare($query);
        $result->bindParam(1, $this->ID);
        $result->execute();

        $row = $result->fetch(PDO::FETCH_ASSOC);
        
        $this->NIK = $row["NIK"];
        $this->NamaLengkap = $row["NamaLengkap"];
        $this->Alamat = $row["Alamat"];
        $this->NoTelp = $row["NoTelp"];
        $this->TglLahir = $row["TglLahir"];
        $this->ID = $row["ID"];
    }
    function delete() {
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



