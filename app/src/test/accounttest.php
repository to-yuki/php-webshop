<html>
<body>
<?php
require_once '../pdo/DatabaseManager.php';
require_once '../pdo/AccountsPDO.php';
require_once '../pdo/Login.php';
require_once '../pdo/Account.php';

use pdo\DatabaseManager;
use pdo\AccountsPDO;
use pdo\Login;
use pdo\Account;
        
// 手動テスト用の関数
function testFindByLogin() {
    $dao = new AccountsPDO();
    $login = new Login('newUser', 'newPass');
    
    // データベース接続を取得
    //$conn = DatabaseManager::getConnection();
    
    // テスト用のデータを挿入
    //$conn->exec("CREATE TABLE IF NOT EXISTS ACCOUNTS (USER_ID TEXT, PASS TEXT, MAIL TEXT, NAME TEXT, AGE INTEGER)");
    //$conn->exec("DELETE FROM ACCOUNTS"); // 既存データを削除
    //$conn->exec("INSERT INTO ACCOUNTS (USER_ID, PASS, MAIL, NAME, AGE) VALUES ('testUser', 'testPass', 'test@example.com', 'Test User', 30)");
    
    // メソッドを呼び出し
    $account = $dao->findByLogin($login);
    
    // 結果を検証
    if ($account !== null) {
        echo "testFindByLogin: Success\n";
        echo "UserId: " . $account->getUserId() . "\n";
        echo "Mail: " . $account->getMail() . "\n";
    } else {
        echo "testFindByLogin: Failed\n";
    }
}

function testCreateAccount() {
    $dao = new AccountsPDO();
    $account = new Account('newUser', 'newPass', 'new@example.com', 'New User', 25);
    
    // データベース接続を取得
    $conn = DatabaseManager::getConnection();
    
    // テスト用のデータを挿入
    print ("Createing User:newUser  pass: newPass <br>");
    $conn->exec("CREATE TABLE IF NOT EXISTS ACCOUNTS (USER_ID TEXT, PASS TEXT, MAIL TEXT, NAME TEXT, AGE INTEGER)");
    $conn->exec("DELETE FROM ACCOUNTS"); // 既存データを削除
    
    // メソッドを呼び出し
    $result = $dao->createAccount($account);
    
    // 結果を検証
    if ($result !== null) {
        echo "testCreateAccount: Success\n";
        echo "UserId: " . $result->getUserId() . "\n";
    } else {
        echo "testCreateAccount: Failed\n";
    }
}

// テストを実行
print ("<br>=== testCreateAccount-start ===<br>");
testCreateAccount();
print ("<br><br>=== testCreateAccount-end ===<br>");

print ("<br>=== testFindByLogin-start ===<br>");
testFindByLogin();
print ("<br>=== testFindByLogin-end ===<br>");
?>
</body>
</html>