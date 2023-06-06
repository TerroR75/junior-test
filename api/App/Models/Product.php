<?php

abstract class Product
{
    private $sku;
    private $name;
    private $type;
    private $price;

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
    /**
     * @return string
     */
    public function getSKU()
    {
        return $this->sku;
    }

    /**
     * @param string $name 
     * @return self
     */
    public function setSKU($sku): self
    {
        $this->sku = $sku;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name 
     * @return self
     */
    public function setName($name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type 
     * @return self
     */
    public function setType($type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param int $price 
     * @return self
     */
    public function setPrice($price): self
    {
        $this->price = $price;
        return $this;
    }
}