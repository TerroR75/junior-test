<?php
require_once "api/services/database.php";
require_once "api/controllers/BaseController.php";

class DVDDiscController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createDisc(DVDDisc $disc)
    {
        $sql = "INSERT INTO dvds (sku, name, type, price, size) 
        VALUES ('$disc->sku','$disc->name','$disc->type','$disc->price','$disc->size')";

        if (mysqli_query($this->conn, $sql)) {
            echo "New item addded!";
        } else {
            echo "Error: " . $sql . "<br/>" . mysqli_error($this->conn);
        }
    }
}
