<?php
namespace model;

use model\CartItem;
use model\Order;
use PDO;
use PDOException;

class OrderPDO {
    
    public function createOrder(Order $order) {
        // データベースへ接続
        try {
            $conn = DatabaseManager::getConnection(); // DatabaseManagerクラスで接続を取得

            // 注文のDB登録
            $sql = "INSERT INTO ORDERS(USER_ID, PRICE) VALUES (?, ?)";
            $pStmt = $conn->prepare($sql);
            $pStmt->bindValue(1, $order->getAccount()->getUserId(), PDO::PARAM_STR);
            $pStmt->bindValue(2, $order->getPrice(), PDO::PARAM_INT);
            
            // 実行し、影響を受けた行数を取得
            $updateCount = $pStmt->execute();
            
            if ($updateCount === false) {
                throw new PDOException("INSERT 0");
            }
            
            // 自動採番された注文のOrderIDの取得
            $sql = "SELECT ORDER_ID FROM ORDERS ORDER BY ORDER_ID DESC LIMIT 1";
            $pStmtSL = $conn->prepare($sql);
            $pStmtSL->execute();
            $orderid = $pStmtSL->fetchColumn();
            $order->setOrderId($orderid);
            
            // 注文明細のDB登録
            $sql = "INSERT INTO ORDERITEMS(ORDER_ID, PRODUCT_ID, QUANTITY) VALUES (?, ?, ?)";
            $pStmt2 = $conn->prepare($sql);
            
            foreach ($order->getCartItems() as $item) {
                $pStmt2->bindValue(1, $orderid, PDO::PARAM_INT);
                $pStmt2->bindValue(2, $item->getProduct()->getProduct_id(), PDO::PARAM_STR);
                $pStmt2->bindValue(3, $item->getQuantity(), PDO::PARAM_INT);
                $pStmt2->execute();
            }

        } catch (PDOException $e) {
            // エラーメッセージを表示
            echo $e->getMessage();
            return null;
        }
        return $order;
    }
}
?>