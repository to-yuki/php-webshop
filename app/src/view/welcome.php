<?php

namespace view;

// オートローダーを読み込む
require_once '../autoload.php'; // autoload.phpのパスを適宜修正

use model\Product;
use model\Account;
use model\ProductsPDO; // ProductsPDOクラスを使用

// セッションからアカウント情報を取得
$account = isset($_SESSION['account']) ? $_SESSION['account'] : null;

// セッションから商品リストを取得、存在しないまたは0個の場合はDBから取得
if (!isset($_SESSION['products']) || empty($_SESSION['products'])) {
    // ProductsPDOのインスタンスを作成し、商品リストを取得
    $productsPDO = new ProductsPDO();
    $products = $productsPDO->findByAll(); // データベースから商品リストを取得
    
    // 取得した商品リストをセッションに保存
    $_SESSION['products'] = $products;

} else {
    // セッションから商品リストを取得
    $products = $_SESSION['products'];
}
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>スッキリ商店</title>
        <link rel="stylesheet" href="/view/styles.css">
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li><a href="control.php?"><img src="/img/home.png" style="width: 30px; height: 30px;" alt="Home"></a></li>
                    <li><a href="control.php?action=cart"><img src="/img/cart.png" style="width: 30px; height: 30px;" alt="ショッピングカート"></a></li>
                    <?php if ($account): ?>
                        ログイン中：<li><a href="control.php?action=userRegistOK"><?= htmlspecialchars($account->getUserId()) ?></a></li>
                    <?php else: ?>
                        <li><a href="control.php?action=login">ログイン</a></li>
                        <li><a href="control.php?action=userRegist">ユーザー登録</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </header>
        
        <div class="container">
            <h1>商品リスト</h1>
            <table>
                <tr>
                    <th>商品ID</th>
                    <th>商品イメージ</th>
                    <th>商品名</th>
                    <th>商品説明</th>
                    <th>価格</th>
                </tr>
                
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product->getProduct_id()) ?></td>
                    <td>
                        <a href="control.php?action=cartAddConfirm&product_id=<?= htmlspecialchars($product->getProduct_id()) ?>">
                            <img src="/img/<?= htmlspecialchars($product->getImg_url()) ?>" style="width: 180px; height: 230px;" alt="商品イメージがありません">
                        </a>
                    </td>
                    <td>
                        <a href="control.php?action=cartAddConfirm&product_id=<?= htmlspecialchars($product->getProduct_id()) ?>">
                            <?= htmlspecialchars($product->getProduct_name()) ?>
                        </a>
                    </td>
                    <td><?= htmlspecialchars($product->getProduct_describe()) ?></td>
                    <td><?= htmlspecialchars($product->getPrice()) ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </body>
</html>