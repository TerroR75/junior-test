<?php

class Disc extends Product
{
    private $size;

    public function __construct($sku, $name, $type, $price, $size = 0)
    {
        parent::__construct($sku, $name, $type, $price);
        $this->size = $size;
    }

    public function addSpecificData($row)
    {
        $details = [];
        $newRow["size"] = $row["details"];
        $details[] = $newRow;
        $this->productData['details'] = $details;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param int $size 
     * @return self
     */
    public function setSize($size): self
    {
        $this->size = $size;
        return $this;
    }
}