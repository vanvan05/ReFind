<?php

class Database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "root";
    private $dbname = "refind2";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli(
            $this->host, $this->user, $this->pass, $this->dbname
        );
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }
}