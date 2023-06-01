<?php

class Disc extends Product
{
    public $size;

    public function __construct($sku, $name, $type, $price, $size = 0)
    {
        parent::__construct($sku, $name, $type, $price);
        $this->size = $size;
    }

    public function addSpecificData($row)
    {
        $details = array();
        $details["size"] = $row["size"];
        $this->productData['details'] = $details;
    }
}