<?php

class Database
{
    public $db_host = "localhost";
    public $db_user = "root";
    public $db_password = "";
    public $db_name = "juniortest";


    public function connect()
    {
        $conn = new mysqli($this->db_host, $this->db_user, $this->db_password, $this->db_name);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed " . $conn->connect_error);
        }

        return $conn;
    }
}
