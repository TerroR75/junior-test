<?php
// namespace Api\Controllers;

// use Database;

class ProductsController
{
    public $conn = null;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getProducts()
    {
        try {
            $url = "https://jsonplaceholder.typicode.com/posts";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_ENCODING, 0);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));


            $responseData = json_decode(curl_exec($ch), true);

            header('Content-Type: application/json');
            echo json_encode($responseData);
            exit;
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            exit;
        }
    }

    public function devSeedDatabase()
    {
    }
}