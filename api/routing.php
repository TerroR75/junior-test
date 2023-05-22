<?php
// error_reporting(E_ALL);
// ini_set("display_errors","1");

require "services/database.php";
require "controllers/ProductsController.php";

// Get current URL
$current_link = $_SERVER["REQUEST_URI"];
var_dump($current_link);
exit;

// Routes
$urls = [
    "junior-assignment/api/products" => ["ProductsController@getAllProducts"]
];
