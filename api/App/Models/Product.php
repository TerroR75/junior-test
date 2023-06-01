<?php

abstract class Product
{
    public $sku;
    public $name;
    public $type;
    public $price;

    protected $productData = [];

    public function __construct($sku, $name, $type, $price = 0)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->type = $type;
        $this->price = $price;
    }

    public function addProductData($row)
    {
        $this->productData['id'] = $row['product_id'];
        $this->productData['sku'] = $row['sku'];
        $this->productData['name'] = $row['name'];
        $this->productData['type'] = $row['type'];
        $this->productData['price'] = $row['price'];
    }
    public abstract function addSpecificData($row);

    public function getData()
    {
        return $this->productData;
    }
}