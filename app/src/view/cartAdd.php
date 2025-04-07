<?php
namespace view;

use model\Account;
use model\Product;

// セッションが開始されていない場合のみ、セッションを開始
if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>スッキリ商店 Shopping Cart 追加</title>
    <link rel="stylesheet" href="/view/styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="control.php"><img src="/img/home.png" style="width: 30px; height: 30px;" alt="Home"></a></li>
                <li><a href="control.php?action=cart"><img src="/img/cart.png" style="width: 30px; height: 30px;" alt="ショッピングカート"></a></li>
                <?php
                $account = $_SESSION['account'] ?? null; // セッションからアカウント情報を取得
                if ($account !== null) {
                ?>
                    <li><a href="control.php?action=userRegistOK"><?= htmlspecialchars($account->getUserId()) ?></a></li>
                <?php
                } else {
                ?>
                    <li><a href="control.php?action=login">ログイン</a></li>
                    <li><a href="control.php?action=userRegist">ユーザー登録</a></li>
                <?php
                }
                ?>
            </ul>
        </nav>
        <style>
        form {
            display: flex;
            flex-direction: column;
            max-width: 500px;
            margin: 0 auto;
        }
        label {
            margin-bottom: 10px;
        }
        input[type="text"], input[type="password"], input[type="email"], input[type="age"] {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: none;
            box-shadow: 0px 0px 5px #d3d3d3;
            font-size: 16px;
            font-family: Arial, sans-serif;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .actions {
            margin-top: 30px;
            text-align: center;
        }
        .actions a {
            display: inline-block;
            max-width: 500px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }
        .actions a:hover {
            background-color: #0069d9;
        }
    </style>
    </header>

    <div class="container">
        <h1>ショッピングカートに追加しますか？</h1>
        <table>
            <tr>
                <th>商品ID</th>
                <th>商品イメージ</th>
                <th>商品名</th>
                <th>商品説明</th>
                <th>価格</th>
                <th>個数</th>
                <th></th>
            </tr>
            <tr>
            <?php 
            $product = $_SESSION['add_product_id'] ?? null; // セッションから商品情報を取得
            if ($product !== null) {
            ?>
                <form action="control.php" method="post">
                    <td><?= htmlspecialchars($product->getProduct_id()) ?></td>
                    <td><img src="/img/<?= htmlspecialchars($product->getImg_url()) ?>" style="width: 180px; height: 230px;" alt="商品イメージがありません"></td>
                    <td><?= htmlspecialchars($product->getProduct_name()) ?></td>
                    <td><?= htmlspecialchars($product->getProduct_describe()) ?></td>
                    <td><?= htmlspecialchars($product->getPrice()) ?></td>
                    <td><input type="number" name="quantity" value="1"></td>
                    <td><input type="submit" name="cartUpdate" value="cartAdd"></td>
                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($product->getProduct_id()) ?>">
                    <input type="hidden" name="action" value="cartAdd">
                </form>
            <?php
            } else {
                echo '<td colspan="7">商品が見つかりません。</td>'; // 商品が存在しない場合のメッセージ
            }
            ?>
            </tr>
        </table>
        <div class="actions">
            <a href="control.php">いいえ</a>
        </div>
    </div>
</body>
</html>