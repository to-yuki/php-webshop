<?php

namespace model;

class Cart {
    private array $list; // カートアイテムのリスト
    private int $price = 0; // 合計金額

    public function __construct() {
        $this->list = []; // 空の配列で初期化
    }

    public function getPrice(): int {
        $this->price = 0; // 価格をリセット
        foreach ($this->list as $item) {
            $this->price += $item->getProduct()->getPrice() * $item->getQuantity(); // 各アイテムの価格を計算
        }
        return $this->price; // 合計金額を返す
    }

    public function add(CartItem $item): void {
        $this->list[] = $item; // カートにアイテムを追加
    }

    public function remove(CartItem $item): void {
        foreach ($this->list as $key => $cartItem) {
            if ($cartItem === $item) {
                unset($this->list[$key]); // カートからアイテムを削除
                break; // ループを終了
            }
        }
    }

    public function getList(): array {
        return $this->list; // カートアイテムのリストを返す
    }
}
?>