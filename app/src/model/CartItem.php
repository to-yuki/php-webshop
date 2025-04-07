<?php

namespace model;

class CartItem {
    private Product $product; // 商品
    private int $quantity; // 数量

    public function __construct(Product $product, int $quantity) {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function getProduct(): Product {
        return $this->product;
    }

    public function setProduct(Product $product): void {
        $this->product = $product;
    }

    public function getQuantity(): int {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void {
        $this->quantity = $quantity;
    }

    public function __toString(): string {
        return sprintf("CartItem: Product ID: %s, Quantity: %d", $this->product->getProduct_id(), $this->quantity);
    }

    public function equals(CartItem $other): bool {
        return $this->product->getProduct_id() === $other->product->getProduct_id();
    }

    public function hashCode(): int {
        return crc32($this->product->getProduct_id()); // 商品IDのハッシュコードを返す
    }
}
?>