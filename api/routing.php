<?php
require_once 'vendor/autoload.php';

use Api\Controllers\ProductsController;
use Api\Controllers\BooksController;

// Get current URL
$current_link = $_SERVER["REQUEST_URI"];

// Routes
$urls = [
    "/scandiweb-test/api/products" => [ProductsController::class, 'getProducts'],
    "/scandiweb-test/api/books" => [BooksController::class, 'getAllBooks']
];

// Find a matching route
$matchedRoute = null;
foreach ($urls as $url => $handler) {
    if ($url === $current_link) {
        $matchedRoute = $handler;
        break;
    }
}

// Invoke the corresponding controller and method
if ($matchedRoute !== null) {
    $controllerName = $matchedRoute[0];
    $methodName = $matchedRoute[1];

    // Instantiate the controller
    $controller = new $controllerName();

    // Call the method
    $controller->$methodName();
} else {
    echo "404 Not Found";
}