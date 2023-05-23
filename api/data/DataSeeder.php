<?php


class DataSeeder
{

    public function __construct()
    {
    }

    public function seedData($jsonFilePath)
    {
        $this->seedBooks($jsonFilePath);
        $this->seedFurniture($jsonFilePath);
        $this->seedDiscs($jsonFilePath);
    }

    private function seedBooks($jsonFilePath)
    {
        $jsonData = file_get_contents($jsonFilePath);
        $data = json_decode($jsonData, true);

        $booksController = new BooksController();

        if (isset($data["books"])) {
            foreach ($data["books"] as $book) {
                $newBook = new Book($book["id"], $book["name"], $book["type"], $book["price"], $book["weight"]);
                $booksController->createBook($newBook);
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
                $furnitureController->createFurniture($newFurniture);
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
                $newDisc = new DVDDisc($disc["id"], $disc["name"], $disc["type"], $disc["price"], $disc["size"]);
                $discsController->createDisc($newDisc);
            }
        }

        $discsController->closeConnection();
    }
}