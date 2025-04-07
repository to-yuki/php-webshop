<?php
namespace model;

// オートローダーを読み込む
require_once '../autoload.php'; // autoload.phpのパスを適宜修正

use model\Logic;
use model\AccountsPDO;
use model\Account;

class LoginLogic implements Logic {
    public function execute($request) {
        // リクエストパラメータの取得
        // ここでは、$_POST または $_GET を使って直接取得します。
        $userId = isset($request['userId']) ? $request['userId'] : '';
        $pass = isset($request['pass']) ? $request['pass'] : '';

        // ログイン処理の実行
        $login = new Login($userId, $pass);
        $dao = new AccountsPDO();
        $account = $dao->findByLogin($login);

        // ログイン処理の成否によって処理を分岐
        if ($account !== null && ($account->verifyPassword($pass)) == true) { // ログイン成功時
            $_SESSION['userId'] = $userId;
            $_SESSION['account'] = $account;
            return "loginOK";
        }

        return "loginNG";
    }
}?>