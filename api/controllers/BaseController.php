<?php
require_once "api/services/database.php";

class BaseController
{
    protected $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }


    public function closeConnection()
    {
        mysqli_close($this->conn);
    }
}
