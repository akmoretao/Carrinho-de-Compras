<?php

class Product
{
    public int $id;
    public string $name;
    public float $price;
    public int $stock;

    public function __construct(int $id, string $name, float $price, int $stock)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->stock = $stock;
    }
}

?>