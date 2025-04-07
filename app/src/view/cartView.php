<?php
namespace view;

use model\Account;
use model\Cart;
use model\CartItem;
use model\Product;

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>スッキリ商店 Shopping Cart</title>
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
    </header>

    <div class="container">
        <h1>
            <img src="/img/cart.png" style="width: 60px; height: 60px;" alt="ショッピングカート">ショッピングカート
        </h1>

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
            <?php
            $cart = $_SESSION['cart'] ?? null; // セッションからカートを取得
            if ($cart !== null) {
                $list = $cart->getList(); // カート内のアイテムリストを取得
                foreach ($list as $cartitem) {
            ?>
            <tr>
                <form action="control.php" method="post">
                    <td><?= htmlspecialchars($cartitem->getProduct()->getProduct_id()) ?></td>
                    <td><img src="/img/<?= htmlspecialchars($cartitem->getProduct()->getImg_url()) ?>" style="width: 180px; height: 230px;" alt="商品イメージがありません"></td>
                    <td><?= htmlspecialchars($cartitem->getProduct()->getProduct_name()) ?></td>
                    <td><?= htmlspecialchars($cartitem->getProduct()->getProduct_describe()) ?></td>
                    <td><?= number_format($cartitem->getProduct()->getPrice()) ?></td>
                    <td><input type="number" size="3" name="quantity" value="<?= htmlspecialchars($cartitem->getQuantity()) ?>"></td>
                    <td><input type="submit" name="cartUpdate" value="更新"></td>
                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($cartitem->getProduct()->getProduct_id()) ?>">
                    <input type="hidden" name="action" value="cartUpdate">
                </form>
            </tr>
            <?php 
                }
            ?>
            <tr>
                <td colspan="4" style="border: none;"></td>
                <td><b>合計：</b></td>
                <td><b><?= number_format($cart->getPrice()) ?></b></td>
            </tr>
            <?php 
            } else { 
            ?>
            <tr>
                <td colspan="6" style="border: none;"></td>
                <td><b>合計：</b></td>
                <td>0</td>
            </tr>
            <?php 
            } 
            ?>
        </table>
        <div class="actions">
            <a href="control.php">買い物を続ける</a>
            <a href="control.php?action=order">注文</a>
        </div>
    </div>
</body>
</html>