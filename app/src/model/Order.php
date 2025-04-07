<?php

namespace model;

use model\Account;
use model\CartItem;

class Order {
    private int $orderId;
    private Account $account;
    private array $cartItems; // カートアイテムのリスト
    private int $price;

    public function __construct() {
        $this->cartItems = []; // 空の配列で初期化
    }

    public function getPrice(): int {
        return $this->price; // 価格を返す
    }

    public function setPrice(int $price): void {
        $this->price = $price; // 価格を設定
    }

    public function getAccount(): Account {
        return $this->account; // アカウントを返す
    }

    public function setAccount(Account $account): void {
        $this->account = $account; // アカウントを設定
    }

    public function getOrderId(): int {
        return $this->orderId; // 注文IDを返す
    }

    public function setOrderId(int $orderId): void {
        $this->orderId = $orderId; // 注文IDを設定
    }

    public function getCartItems(): array {
        return $this->cartItems; // カートアイテムのリストを返す
    }

    public function setCartItems(array $cartItems): void {
        $this->cartItems = $cartItems; // カートアイテムのリストを設定
    }

    public function addCartItem(CartItem $item): void {
        $this->cartItems[] = $item; // カートアイテムを追加
    }
}
?>