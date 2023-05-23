<?php
use Api\Controllers\BaseController;

class BooksController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createBook(Book $book)
    {
        $sql = "INSERT INTO books (sku, name, type, price, weight) 
        VALUES ('$book->sku','$book->name','$book->type','$book->price','$book->weight')";

        if (mysqli_query($this->conn, $sql)) {
            echo "New item addded!";
        } else {
            echo "Error: " . $sql . "<br/>" . mysqli_error($this->conn);
        }
    }
}