<?php

class Book extends Product
{
    public $weight;

    public function __construct($sku, $name, $type, $price, $weight = 0)
    {
        parent::__construct($sku, $name, $type, $price);
        $this->weight = $weight;
    }

    public function addSpecificData($row)
    {
        $details = array();
        $details["weight"] = $row["weight"];
        $this->productData['details'] = $details;
    }
}