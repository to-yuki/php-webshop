<?php
namespace model;

use model\Logic;

class LogOutLogic implements Logic {
    public function execute($request) {
        // セッションが開始されていない場合のみ開始
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // セッションデータをクリア
        $_SESSION = []; // セッションデータを空にする

        // セッションを破棄
        session_destroy(); // セッションを破棄

        // セッションIDを削除（オプション）
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        return 'LogoutOK';
    }
}
?>