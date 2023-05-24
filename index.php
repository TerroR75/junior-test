<?php
require_once "./api/App/bootstrapping.php";
// require_once "api/data/DataSeeder.php";
(new DataSeeder)->seedData("api/App/Data/seedProducts.json");