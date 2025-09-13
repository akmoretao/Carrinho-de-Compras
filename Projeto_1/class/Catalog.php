<?php

require_once('class/Product.php');
require_once('class/Item.php');

class Catalog
{
    private array $products = [];

    public function __construct(array $productsData)
    {
        foreach ($productsData as $data) {
            $product = new Product(
                (int) $data['id'],
                (string) $data['name'],
                (float) $data['price'],
                (int) $data['stock']
            );

            $this->products[$product->id] = $product;
        }
    }

    public function find(int $id): ?Product
    {
        return $this->products[$id] ?? null;
    }

    public function increaseStock(int $id, int $quantity): bool
    {
        $product = $this->find($id);
        if ($product === null) {
            return false;
        }

        if ($quantity <= 0) {
            return false;
        }

        $product->stock += $quantity;

        return true;
    }

    public function reduceStock(int $id, int $quantity): bool
    {
        $product = $this->find($id);

        if ($product === null) {
            return false;
        }

        if ($quantity <= 0 || $product->stock < $quantity) {
            return false;
        }

        $product->stock -= $quantity;

        return true;
    }

    public function listAll(): array
    {
        return array_values($this->products);
    }
}

?>