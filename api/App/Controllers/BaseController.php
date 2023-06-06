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
            COALESCE(b.weight, f.dimensions, d.size) AS details
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
                $product = new $productType($row["sku"], $row["name"], $row["type"], $row["price"], $row["details"]);
                $product->addProductData($row);
                $product->addSpecificData($row);

                $products[] = $product->getData();
            }

            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode($products);
        } else {
            http_response_code(500);
            echo "Error fetching products: " . mysqli_error($this->conn);
        }
    }

    private function createProduct(Product $product)
    {
        $sql = "INSERT INTO products (sku, name, type, price) " .
            "VALUES " . "('" . $product->getSKU() . "', '" . $product->getName() . "', '" . $product->getType() . "', " . $product->getPrice() . ")";


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

            $properties = [];
            $propKeys = [];

            // Create a reflection to access specific private property on each product
            $reflection = new ReflectionObject($product);
            $reflectionProperties = $reflection->getProperties();

            foreach ($reflectionProperties as $property) {
                $propertyName = $property->getName();
                $getterMethod = 'get' . ucfirst($propertyName);

                if ($reflection->hasMethod($getterMethod)) {
                    $getter = $reflection->getMethod($getterMethod);
                    $propertyValue = $getter->invoke($product);
                    $properties[$propertyName] = $propertyValue;
                    $propKeys[] = $propertyName;
                }
            }

            array_unshift($propKeys, 'product_id');
            array_unshift($properties, $productId);

            $values = array_map(function ($value) {
                return "'" . $value . "'";
            }, $properties);
            $sql = "INSERT INTO " . $product->getType() . " (" . implode(",", $propKeys) . ")"
                . " VALUES (" . implode(", ", $values) . ")";


            if (mysqli_query($this->conn, $sql)) {
                echo "New item addded! <br/>" . json_encode($product);
            } else {
                echo "Error: " . $sql . "<br/>" . mysqli_error($this->conn);
            }
        }
    }


    public function deleteAllProducts()
    {
        $requestPayload = json_decode(file_get_contents('php://input'), true);


        foreach ($requestPayload as $product) {
            $sql = "DELETE FROM " . $product["type"] . " WHERE product_id = " . $product["id"];
            mysqli_query($this->conn, $sql);

            // Check if any child product was deleted
            if (mysqli_affected_rows($this->conn) > 0) {

                $sql = "DELETE FROM products WHERE id = " . $product["id"];
                mysqli_query($this->conn, $sql);

                if (mysqli_affected_rows($this->conn) > 0) {
                    $response = [
                        'success' => true,
                        'message' => 'Parent product and corresponding child records deleted successfully.',
                        'sql' => $sql,
                        'requestPayload' => $requestPayload
                    ];
                } else {
                    $response = [
                        'success' => false,
                        'message' => 'Parent product not found or could not be deleted.',
                        'sql' => $sql,
                        'requestPayload' => $requestPayload
                    ];
                }
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Child product not found or could not be deleted.',
                    'sql' => $sql,
                    'requestPayload' => $requestPayload
                ];
            }



        }

        header('Content-Type: application/json');
        echo json_encode($response);

    }


    public function closeConnection()
    {
        mysqli_close($this->conn);
    }


}