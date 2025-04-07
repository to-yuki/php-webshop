<?php

namespace model;

use model\OrderPDO;
use model\Order;
use model\Logic;

class OrderLogic implements Logic {
    public function execute($request) {
        // セッションを開始
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // セッションからユーザー情報を取得
        $userId = $_SESSION['userId'] ?? null;
        $account = $_SESSION['account'] ?? null;

        // ユーザーがログインしているか確認
        if ($userId === null || $account === null) {
            return "login"; // ログインページにリダイレクト
        }

        // セッションからカートを取得
        $cart = $_SESSION['cart'] ?? null;
        if ($cart === null) {
            return ""; // カートが存在しない場合は何もしない
        }

        // 注文オブジェクトを作成
        $order = new Order();
        $order->setAccount($account); // アカウントを設定

        // カートアイテムのリストを取得
        $list = $cart->getList();
        $order->setCartItems($list); // カートアイテムを設定
        $order->setPrice($cart->getPrice()); // 合計金額を設定

        // 注文をデータベースに保存
        $orderDAO = new OrderPDO();
        $order = $orderDAO->createOrder($order);

        // カートをセッションから削除
        unset($_SESSION['cart']);

        // 注文情報をリクエストに設定
        $_SESSION['order'] = $order; // 注文情報をセッションに保存
        return "order"; // 注文ページに遷移するための識別子を返す
    }
}
?>