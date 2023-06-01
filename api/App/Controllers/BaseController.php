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

    // CRUD OPERATIONS

    public function getAllProducts()
    {
        $sql = "SELECT p.id AS product_id, p.sku, p.name, p.type, p.price,
                b.weight,
                f.dimensions,
                d.size
                FROM products AS p
                LEFT JOIN book AS b ON p.id = b.product_id
                LEFT JOIN furniture AS f ON p.id = f.product_id
                LEFT JOIN disc AS d ON p.id = d.product_id";

        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            $products = [];

            while ($row = mysqli_fetch_assoc($result)) {
                $productType = ucfirst(strtolower($row['type']));



                // Create an instance of the corresponding product type
                $product = new $productType($row["sku"], $row["name"], $row["type"], $row["price"]);
                $product->addProductData($row);
                $product->addSpecificData($row);

                $products[] = $product->getData();
            }

            header('Content-Type: application/json');
            echo json_encode($products);
        } else {
            echo "Error fetching products: " . mysqli_error($this->conn);
        }
    }

    private function createProduct(Product $product)
    {
        $sql = "INSERT INTO products (sku, name, type, price) " .
            "VALUES " . "('" . $product->sku . "', '" . $product->name . "', '" . $product->type . "', " . $product->price . ")";


        if (mysqli_query($this->conn, $sql)) {
            echo "Product table updated...";
            return mysqli_insert_id($this->conn);
        } else {
            echo "Error: " . $sql . "<br/>" . mysqli_error($this->conn);
            return null;
        }
    }

    public function createItems(Product $product)
    {
        $productId = $this->createProduct($product);

        // Check if product was created inside Products table
        if ($productId !== null) {
            // 1. $properties is an array of $product's prop values to.. --> 2.
            $properties = array_slice(get_object_vars($product), 4);
            // Extracting prop keys to use in query string
            $propKeys = array_slice(array_keys(get_object_vars($product)), 4);

            array_unshift($propKeys, 'product_id');
            array_unshift($properties, $productId);

            // --> 2. then map it to string array to use it in query string for database
            $values = array_map(function ($value) {
                return "'" . $value . "'";
            }, $properties);
            $sql = "INSERT INTO " . $product->type . " (" . implode(",", $propKeys) . ")"
                . " VALUES (" . implode(", ", $values) . ")";


            if (mysqli_query($this->conn, $sql)) {
                echo "New item addded! <br/>" . var_dump($propKeys);
            } else {
                echo "Error: " . $sql . "<br/>" . mysqli_error($this->conn);
            }
        }
    }


    public function closeConnection()
    {
        mysqli_close($this->conn);
    }


}