<?php
// PHPファイルの取り込み(クラスロード)
require_once '../model/DatabaseManager.php';

use model\DatabaseManager;

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>環境構築</title>
</head>
<body>
    <p><?php print ("ハローワールド!");?></p>
        
        <?php
        // 使用例
		print ("DB接続開始<br>");
        try {
         	$db = DatabaseManager::getConnection();
         	// データベース操作をここで行う
        } catch (Exception $e) {
         	echo $e->getMessage();
         }

        
        
		// $mysqli = new mysqli('host=app-db-1', 'root', 'pass', 'app');
        // if($mysqli->connect_error) {
        // echo '接続失敗'.PHP_EOL;
        // exit();
        // } else {
        // echo '接続成功'.PHP_EOL;
        // }
        
        ?>
</body>
</html>

