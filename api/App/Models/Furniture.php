<?php

class Furniture extends Product
{
    public $dimensions;

    public function __construct($sku, $name, $type, $price, $dimensions = "")
    {
        parent::__construct($sku, $name, $type, $price);
        $this->dimensions = $dimensions;
    }

    public function addSpecificData($row)
    {
        $details = array();
        $details["dimensions"] = $row["dimensions"];
        $this->productData['details'] = $details;
    }
}