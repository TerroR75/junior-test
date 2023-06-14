<?php


class DataSeeder
{

    public function __construct()
    {
    }

    public function seedData($jsonFilePath)
    {
        $database = new Database();
        $conn = $database->connect();
        $sql = "SELECT COUNT(*) as count FROM products";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $rowCount = $row['count'];

            if ($rowCount > 0) {
                // Rows exist in the table
                echo "There are $rowCount rows in the table already.";
                exit;
            }
        }

        $this->seedDiscs($jsonFilePath);
        $this->seedBooks($jsonFilePath);
        $this->seedFurniture($jsonFilePath);
    }

    private function seedBooks($jsonFilePath)
    {
        $jsonData = file_get_contents($jsonFilePath);
        $data = json_decode($jsonData, true);

        $booksController = new BooksController();

        if (isset($data["books"])) {
            foreach ($data["books"] as $book) {
                $newBook = new Book($book["id"], $book["name"], $book["type"], $book["price"], $book["weight"]);
                $booksController->createItems($newBook);
            }
        }

        $booksController->closeConnection();
    }
    private function seedFurniture($jsonFilePath)
    {
        $jsonData = file_get_contents($jsonFilePath);
        $data = json_decode($jsonData, true);

        $furnitureController = new FurnitureController();

        if (isset($data["furniture"])) {
            foreach ($data["furniture"] as $furniture) {
                $newFurniture = new Furniture($furniture["id"], $furniture["name"], $furniture["type"], $furniture["price"], $furniture["dimensions"]);
                $furnitureController->createItems($newFurniture);
            }
        }

        $furnitureController->closeConnection();
    }
    private function seedDiscs($jsonFilePath)
    {
        $jsonData = file_get_contents($jsonFilePath);
        $data = json_decode($jsonData, true);

        $discsController = new DVDDiscController();

        if (isset($data["discs"])) {
            foreach ($data["discs"] as $disc) {
                $newDisc = new Disc($disc["id"], $disc["name"], $disc["type"], $disc["price"], $disc["size"]);
                echo "Creating disc..." . json_encode($newDisc);
                $discsController->createItems($newDisc);

            }
        }

        $discsController->closeConnection();
    }
}