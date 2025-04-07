<?php

namespace model;

use model\ProductsPDO;

class CartAddConfirmLogic implements Logic {
    public function execute($request) {
        // セッションを開始
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // リクエストパラメータの取得
        // PHPでは通常UTF-8がデフォルトなので特に設定しなくても良い場合が多いですが、明示的に設定することも可能です。
        // mb_internal_encoding("UTF-8"); // 必要に応じて追加

        // セッションからカートを取得
        $cart = $_SESSION['cart'] ?? null;

        if ($cart === null) {
            $cart = new Cart(); // カートが存在しない場合、新しく作成
            $_SESSION['cart'] = $cart; // セッションにカートを保存
        }

        // リクエストから商品IDを取得
        $product_id = $request['product_id'] ?? '';

        // 商品をデータベースから取得
        $productsPDO = new ProductsPDO();
        $product = $productsPDO->findByItemId($product_id);

        // セッションに追加する商品を保存
        $_SESSION['add_product_id'] = $product;

        return "cartAddConfirm"; // 次のページに遷移するための識別子を返す
    }
}
?>