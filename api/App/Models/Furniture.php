<?php

class Furniture extends Product
{
    public $dimensions;

    public function __construct($sku, $name, $type, $price, $dimensions)
    {
        parent::__construct($sku, $name, $type, $price);
        $this->dimensions = $dimensions;
    }

    // Getters and setters
    public function getDimensions()
    {
        return $this->dimensions;
    }

    public function setDimensions($dimensions)
    {
        $this->dimensions = $dimensions;
    }
}