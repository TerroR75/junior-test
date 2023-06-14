<?php

class Furniture extends Product
{
    private $dimensions;

    public function __construct($sku, $name, $type, $price, $dimensions = "")
    {
        parent::__construct($sku, $name, $type, $price);
        $this->dimensions = $dimensions;
    }

    public function addSpecificData($row)
    {
        $details = [];
        $newRow["dimensions"] = $row["details"];
        $details[] = $newRow;
        $this->productData['details'] = $details;
    }

    /**
     * @return string
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }

    /**
     * @param string $dimensions 
     * @return self
     */
    public function setDimensions($dimensions): self
    {
        $this->dimensions = $dimensions;
        return $this;
    }
}