<?php
// namespace Api\Controllers;

// use Database;
// use Product;

class BaseController
{
    protected $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function createItems(Product $product)
    {
        // 1. $properties is an array of $product's prop values to.. --> 2.
        $properties = get_object_vars($product);
        // Extracting prop keys to use in query string
        $propKeys = array_keys(get_object_vars($product));

        // --> 2. then map it to string array to use it in query string for database
        $values = array_map(function ($value) {
            return "'" . $value . "'";
        }, $properties);

        $sql = "INSERT INTO " . $product->type . " (" . implode(",", $propKeys) . ")"
            . " VALUES (" . implode(", ", $values) . ")";


        if (mysqli_query($this->conn, $sql)) {
            echo "New item addded!";
        } else {
            echo "Error: " . $sql . "<br/>" . mysqli_error($this->conn);
        }
    }


    public function closeConnection()
    {
        mysqli_close($this->conn);
    }


}