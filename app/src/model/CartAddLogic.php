<?php

namespace model;

use model\ProductsPDO;

class CartAddLogic implements Logic {
    public function execute($request) {
        // セッションを開始
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // セッションからカートを取得
        $cart = $_SESSION['cart'] ?? null;

        if ($cart === null) {
            $cart = new Cart(); // カートが存在しない場合、新しく作成
            $_SESSION['cart'] = $cart; // セッションにカートを保存
        }

        // リクエストから数量を取得
        $quantity = 0;
        if (isset($request['quantity'])) {
            $quantity = (int)$request['quantity']; // 数量を整数に変換
        }

        // 商品IDを取得
        $productId = $request['product_id'] ?? '';
        $productsPDO = new ProductsPDO();
        $product = $productsPDO->findByItemId($productId); // 商品をデータベースから取得

        if ($product !== null) {
            // 既にカートに同じ商品が存在するかチェック
            $existingItemIndex = null; // アイテムリストの何番に同じアイテムがあるかカウントする変数
            foreach ($cart->getList() as $key => $item) {
                if ($item->getProduct()->getProduct_id() === $productId) {
                    $existingItemIndex = $key; // 同じ商品が見つかった場合のインデックスを保存
                    break;
                }
            }

            if ($existingItemIndex !== null) {
                // 同じ商品が存在する場合は置き換える
                $cart->remove($cart->getList()[$existingItemIndex]); // 既存のアイテムを削除
            }

            // 新しいカートアイテムを作成し、追加
            $cartItem = new CartItem($product, $quantity); // 入力された数量でカートアイテムを作成
            $cart->add($cartItem); // 新しいアイテムを追加
        }

        return "cart"; // カートページに遷移するための識別子を返す
    }
}
?>