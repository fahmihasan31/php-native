<?php

class Penerbit{

    //koneksi databse dan nama table
    private $conn;
    private $table_name = "penerbit";

    // property object penerbit
    public $ID;
    public $NamaPenerbit;
    public $Alamat;
    public $NoTelp;

    public function __construct($db) {
        $this->conn = $db;
    }
    function create() {
        // insert
        $query = "INSERT INTO " . $this->table_name . " (NamaPenerbit, Alamat, NoTelp)" .
                                  " VALUES (:NamaPenerbit, :Alamat, :NoTelp)";
        
        $result = $this->conn->prepare($query);
    
        $this->NamaPenerbit = htmlspecialchars(strip_tags($this->NamaPenerbit));
        $this->Alamat = htmlspecialchars(strip_tags($this->Alamat));
        $this->NoTelp = htmlspecialchars(strip_tags($this->NoTelp));

        $result->bindParam(":NamaPenerbit", $this->NamaPenerbit);
        $result->bindParam(":Alamat", $this->Alamat);
        $result->bindParam(":NoTelp", $this->NoTelp);
        
        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }
    function update() {
        $query = "UPDATE " . $this->table_name . " SET
                                                    NamaPenerbit = :NamaPenerbit,
                                                    Alamat = :Alamat,
                                                    NoTelp = :NoTelp
                                                    WHERE 
                                                    ID = :ID";
        
        $result = $this->conn->prepare($query);

        $this->NamaPenerbit = htmlspecialchars(strip_tags($this->NamaPenerbit));
        $this->Alamat = htmlspecialchars(strip_tags($this->Alamat));
        $this->NoTelp = htmlspecialchars(strip_tags($this->NoTelp));;
    
        // Bind parameters
        $result->bindParam(":NamaPenerbit", $this->NamaPenerbit);
        $result->bindParam(":Alamat", $this->Alamat);
        $result->bindParam(":NoTelp", $this->NoTelp);
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
        
        $this->NamaPenerbit = $row["NamaPenerbit"];
        $this->Alamat = $row["Alamat"];
        $this->NoTelp = $row["NoTelp"];
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



