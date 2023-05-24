<?php

class Book extends Product
{
    public $weight;

    public function __construct($sku, $name, $type, $price, $weight)
    {
        parent::__construct($sku, $name, $type, $price);
        $this->weight = $weight;
    }

    // Getters and setters
    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }
}