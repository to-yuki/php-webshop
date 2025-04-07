<?php
namespace model;

use model\AccountsPDO;
use model\Account;

class AccountRegistLogic implements Logic {
    public function execute($request) {
        // リクエストパラメータの取得
        // PHPではUTF-8がデフォルトなので特に設定しなくても良い場合が多いですが、明示的に設定することも可能です。
        // mb_internal_encoding("UTF-8"); // 必要に応じて追加

        $userid = $request['userid'] ?? '';
        $password = $request['password'] ?? '';
        $username = $request['username'] ?? '';
        $email = $request['email'] ?? '';
        $age = isset($request['age']) ? (int)$request['age'] : 0; // 年齢を整数に変換

        // アカウントオブジェクトの作成
        $account = new Account($userid, $password, $email, $username, $age);
        $dao = new AccountsPDO();
        $result = $dao->createAccount($account);

        // セッションが開始されていない場合のみ、セッションを開始
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); 
        }

        if ($result !== null) { // 登録成功時
            // セッションスコープにユーザーIDを保存
            $_SESSION['userId'] = $result->getUserId();
            $_SESSION['account'] = $result;
            return "userRegistOK";
        }

        // 登録失敗時
        $_SESSION['registError'] = "ユーザ登録失敗";
        return "userRegistNG";
    }
}
?>