<?php
// use Api\Controllers\BaseController;

class BooksController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllBooks()
    {
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        $sql = "SELECT * FROM books";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $books = array();

            // Fetch the books and add them to the $books array
            while ($row = $result->fetch_assoc()) {
                $books[] = $row;
            }

            // Close the database connection
            $this->conn->close();

            // Send the JSON response
            header("Content-Type: application/json");
            echo json_encode($books);
        } else {
            // If no books were found close the connection
            $this->conn->close();

            // Send an empty JSON response
            header("Content-Type: application/json");
            echo json_encode([]);
        }
    }
}