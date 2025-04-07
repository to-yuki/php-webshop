<?php
namespace view;

use model\Order;

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>注文完了</title>
    <link rel="stylesheet" href="/view/styles.css">
</head>
<body>
    <form action="control.php" method="post">
        <?php
        $order = $_SESSION['order'] ?? null; // セッションから注文情報を取得
        if ($order !== null) {
        ?>
            <h1>注文No: <?= htmlspecialchars($order->getOrderId()) ?><br/>
            注文完了！</h1>
        <?php
        } else {
            echo "<h1>注文情報が見つかりません。</h1>"; // 注文情報がない場合のメッセージ
        }
        ?>
        <input type="submit" value="Home">
    </form>
</body>
</html>