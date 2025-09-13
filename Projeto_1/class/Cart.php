<?php

require_once('class/Product.php');
require_once('class/Item.php');
require_once('class/Catalog.php');

class Cart
{
    private array $items = [];

    private Catalog $catalog;

    private ?string $coupon = null;

    public function __construct(Catalog $catalog)
    {
        $this->catalog = $catalog;
    }

    public function addItem(int $productId, int $quantity): string
    {
        $product = $this->catalog->find($productId);

        if ($product === null) {
            return 'Produto não encontrado.';
        }

        if ($quantity <=0) {
            return 'Quantidade inválida.';
        }

        if ($product->stock < $quantity) {
            return 'Estoque insuficiente.';
        }

        $this->catalog->reduceStock($productId, $quantity);

        if (isset($this->items[$productId])) {
            $this->items[$productId]->quantity += $quantity;
            $this->items[$productId]->subtotal = $this->items[$productId]->quantity * $product->price;
        } else {
            $subtotal = $quantity * $product->price;
            $this->items[$productId] = new Item($productId, $quantity, $subtotal);
        }

        return 'Item adicionado com sucesso.';
    }

    public function removeItem(int $productId): string
    {
        if (!isset($this->items[$productId])) {
            return 'Item não existe no carrinho.';
        }

        $removed = $this->items[$productId];

        $this->catalog->increaseStock($productId, $removed->quantity);

        unset($this->items[$productId]);

        return 'Item removido com sucesso.';
    }

    public function listItems(): array
    {
        $result = [];

        foreach ($this->items as $item) {
            $product = $this->catalog->find($item->productId);

            $result[] = [
                'product_id' => $item->productId,
                'name' => $product?->name ?? 'Produto removido',
                'quantity' => $item->quantity,
                'price' => $product?->price ?? 0.0,
                'subtotal' => $item->subtotal,
            ];
        }

        return $result;
    }

    public function applyCoupon(?string $couponCode): string
    {
        if ($couponCode === null || $couponCode === '') {
            $this->coupon = null;
            return 'Cupom removido.';
        }

        if ($couponCode === 'DESCONTO10') {
            $this->coupon = $couponCode;
            return 'Cupom aplicado: 10% de desconto.';
        }

        return 'Cupom inválido.';
    }

    public function calculateTotal(): float
    {
        $total = 0.0;

        foreach ($this->items as $item) {
            $total += $item->subtotal;
        }

        if ($this->coupon === 'DESCONTO10') {
            $total *= 0.9;
        }

        return $total;
    }

    public function clear(): void
    {
        foreach ($this->items as $item) {
            $this->catalog->increaseStock($item->productId, $item->quantity);
        }

        $this->items = [];
        $this->coupon = null;
    }
}

?>