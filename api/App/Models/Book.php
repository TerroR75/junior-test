<?php

class Book extends Product
{
    private $weight;

    public function __construct($sku, $name, $type, $price, $weight = 0)
    {
        parent::__construct($sku, $name, $type, $price);
        $this->weight = $weight;
    }

    public function addSpecificData($row)
    {
        $details = [];
        $newRow["weight"] = $row["details"];
        $details[] = $newRow;
        $this->productData['details'] = $details;
    }

    /**
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param int $weight 
     * @return self
     */
    public function setWeight($weight): self
    {
        $this->weight = $weight;
        return $this;
    }
}