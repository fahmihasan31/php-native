<?php

class Petugas{

    //koneksi databse dan nama table
    private $conn;
    private $table_name = "petugas";

    // property object penerbit
    public $ID;
    public $Username;
    public $Email;
    public $Password;
    public $Role;

    public function __construct($db) {
        $this->conn = $db;
    }
    function create() {
        // insert
        $query = "INSERT INTO " . $this->table_name . " (Username, Email, Password, Role)" .
                                  " VALUES (:Username, :Email, :Password, :Role)";
        
        $result = $this->conn->prepare($query);
    
        $this->Username = htmlspecialchars(strip_tags($this->Username));
        $this->Email = htmlspecialchars(strip_tags($this->Email));
        $this->Password = htmlspecialchars(strip_tags($this->Password));
        $this->role = htmlspecialchars(strip_tags($this->Role));

        $result->bindParam(":Username", $this->Username);
        $result->bindParam(":Email", $this->Email);
        $result->bindParam(":Password", $this->Password);
        $result->bindParam(":Role", $this->Role);
        
        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }
    function update() {
        $query = "UPDATE " . $this->table_name . " SET
                                                    Username = :Username,
                                                    Email = :Email,
                                                    Password = :Password,
                                                    Role = :Role
                                                    WHERE 
                                                    ID = :ID";
        
        $result = $this->conn->prepare($query);

        $this->Username = htmlspecialchars(strip_tags($this->Username));
        $this->Email = htmlspecialchars(strip_tags($this->Email));
        $this->Password = htmlspecialchars(strip_tags($this->Password));
        $this->Role = htmlspecialchars(strip_tags($this->Role));
    
        // Bind parameters
        $result->bindParam(":Username", $this->Username);
        $result->bindParam(":Email", $this->Email);
        $result->bindParam(":Password", $this->Password);
        $result->bindParam(":Role", $this->Role);
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
        
        $this->Username = $row["Username"];
        $this->Email = $row["Email"];
        $this->Password = $row["Password"];
        $this->Role = $row["Role"];
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

    function authenticate() {
        $query = "SELECT * FROM "  . $this->table_name . " WHERE Email = :Email AND Password = :Password";

        $result = $this->conn->prepare($query);

        $this->Email = htmlspecialchars(strip_tags($this->Email));
        $this->Password = htmlspecialchars(strip_tags($this->Password));

        $result->bindParam( ":Email", $this->Email );
        $result->bindParam( ":Password", $this->Password);

        $result->execute();

        if($result->rowCount() > 0) {
            $petugas= $result->fetch(PDO::FETCH_ASSOC);

            $_SESSION["namapetugas"] = $petugas["Username"];
            $_SESSION["rolepetugas"] = $petugas["Role"];
            $_SESSION["idpetugas"] = $petugas["ID"];
            $_SESSION["emailpetugas"] = $petugas["Email"];
            return true;
        } else {
            return false;
        }
    }
    
}