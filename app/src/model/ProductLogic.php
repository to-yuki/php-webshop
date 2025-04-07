<?php

namespace model;

use model\ProductsPDO;

class ProductLogic implements Logic {
    public function execute($request) {
        // ProductsDAOのインスタンスを作成
        $productsDAO = new ProductsPDO();
        $productList = $productsDAO->findByAll(); // 商品リストを取得

        // セッションを開始
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // セッションに商品リストを保存
        $_SESSION['products'] = $productList;

        // デバッグ用に商品リストのサイズを表示（必要に応じて）
        // echo count($productList); // 商品リストのサイズを表示

        return ""; // 何も返さない場合は空文字を返す
    }
}
?>