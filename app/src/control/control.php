<?php

// オートローダーを読み込む
require_once '../autoload.php'; // autoload.phpのパスを適宜修正

use model\LoginLogic;
use model\LogOutLogic;
use model\AccountRegistLogic;
use model\CartAddConfirmLogic;
use model\CartAddLogic;
use model\OrderLogic;
use model\ProductLogic;

// セッションをクリア（デバッグ用）
// $_SESSION = []; // セッションデータを空にする
// session_destroy(); // セッションを破棄

// セッションが開始されていない場合のみ、セッションを開始
if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}

class ControlPHP {
    
    public function handleRequest() {
        // リクエストパラメータの取得
        $action = isset($_GET['action']) ? $_GET['action'] : (isset($_POST['action']) ? $_POST['action'] : '');

        $bo = null;

        // アクションに応じてLogicを選択
        switch ($action) {
            case 'LoginAction':
                $bo = new LoginLogic();
                break;
            
            case 'LogoutAction':
                $bo = new LogOutLogic();
                break;
            
            case 'UserRegistAction':
                $bo = new AccountRegistLogic();
                break;
            
            case 'cartAddConfirm':
                $bo = new CartAddConfirmLogic();
                break;
            
            case 'cartAdd':
            case 'cartUpdate':
            case 'cart';
                $bo = new CartAddLogic();
                break;
            
            case 'order':
                $bo = new OrderLogic();
                break;
            default:
                // 商品一覧
                $bo = new ProductLogic();
                break;
        }

        // Logic action Dump
        // echo "form action params BF: ";
        // var_dump($action);  

        // Logicを実行
        if ($bo !== null) {
            $action = $bo->execute($_REQUEST);
        }

        // Logic action Dump
        // echo "form action params AF: ";
        // var_dump($action);         

        // 次のページの決定
        $this->forward($action);
    }

    private function forward($action) {

        switch ($action) {
            
            case 'login':
                include '../view/loginView.php';
                break;
            
            case 'loginOK':
                include '../view/welcome.php';
                break;
            case 'Logout':
                include '../view/logout.php';
                break;
            case 'LogoutOK':
                    include '../view/welcome.php';
                    break;
            case 'loginNG':
                include '../view/loginNG.php';
                break;
            case 'userRegist':
                include '../view/userRegist.php';
                break;
            case 'userRegistOK':
                include '../view/userConfirm.php';
                break;
            case 'userRegistNG':
                include '../view/userRegist.php';
                break;
            case 'cartAddConfirm':
                include '../view/cartAdd.php';
                break;
            case 'cart':
                include '../view/cartView.php';
                break;
            case 'cartUpdate':
                include '../view/cart.php';
                break;
            case 'order':
                include '../view/orderView.php';
                break;
            default:
                // トップページ
                include '../view/welcome.php';
                break;
        }
    }
}

// 使用例
$control = new ControlPHP();
$control->handleRequest();
?>