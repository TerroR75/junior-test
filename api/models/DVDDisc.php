<?php
require_once "api/models/Product.php";

class DVDDisc extends Product
{
    public $size;

    public function __construct($sku, $name, $type, $price, $size)
    {
        parent::__construct($sku, $name, $type, $price);
        $this->size = $size;
    }

    // Getters and setters
    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }
}
