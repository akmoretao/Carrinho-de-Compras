<?php

require_once('class/Product.php');
require_once('class/Item.php');
require_once('class/Catalog.php');
require_once('class/Cart.php');

$products = [
    ['id' => 1, 'name' => 'Camiseta', 'price' => 59.90, 'stock' => 10],
    ['id' => 2, 'name' => 'Calça Jeans', 'price' => 129.90, 'stock' => 5],
    ['id' => 3, 'name' => 'Tênis', 'price' => 199.90, 'stock' => 3],
];

$catalog = new Catalog($products);
$cart = new Cart($catalog);

echo "Caso 1 - Adicionar Camiseta x2:<br>";
echo $cart->addItem(1, 2) . "<br>";

echo "<br>Caso 2 - Adicionar Tênis x10:<br>";
echo $cart->addItem(3, 10) . "<br>";

echo "<br>Caso 3 - Adicionar Calça x1 e depois remover:<br>";
echo $cart->addItem(2, 1) . "<br>";
echo $cart->removeItem(2) . "<br>";

echo "<br>Caso 4 - Aplicar cupom DESCONTO10:<br>";
echo $cart->addItem(1, 1) . "<br>";
echo $cart->applyCoupon('DESCONTO10') . "<br>";

echo "<br>Itens no carrinho:\n";
foreach ($cart->listItems() as $line) {
    echo $line['product_id'] . ' - ' .
         $line['name'] . ' | qtd: ' .
         $line['quantity'] . ' | unid: R$ ' .
         $line['price'] . ' | subtotal: R$ ' .
         $line['subtotal'] . "<br>";
}

echo "<br>Total final (com cupom, se houver): R$ " . $cart->calculateTotal() . "\n";

?>