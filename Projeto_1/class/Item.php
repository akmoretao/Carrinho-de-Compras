<?php

class Item
{
    public int $productId;
    public int $quantity;
    public float $subtotal;

    public function __construct(int $productId, int $quantity, float $subtotal)
    {
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->subtotal = $subtotal;
    }
}

?>