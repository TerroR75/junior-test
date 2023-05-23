<?php
use Api\Controllers\BaseController;

class FurnitureController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createFurniture(Furniture $item)
    {
        $sql = "INSERT INTO furniture (sku, name, type, price, dimensions) 
        VALUES ('$item->sku','$item->name','$item->type','$item->price','$item->dimensions')";

        if (mysqli_query($this->conn, $sql)) {
            echo "New item addded!";
        } else {
            echo "Error: " . $sql . "<br/>" . mysqli_error($this->conn);
        }
    }
}