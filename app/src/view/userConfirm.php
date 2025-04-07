<?php

// セッションからアカウント情報を取得
$account = isset($_SESSION['account']) ? $_SESSION['account'] : null;

// アカウント情報が存在しない場合は、エラーメッセージを表示するか、リダイレクトする処理を追加できます。
if ($account === null) {
    echo "ユーザー情報が見つかりません。ログインしてください。";
    exit; // 処理を終了
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ユーザー情報確認画面</title>
    <style>
        body {
            font-size: 16px;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f5f5;
            padding-top: 50px;
        }

        h1 {
            font-size: 36px;
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            margin: auto;
            border-collapse: collapse;
            border-spacing: 0;
            width: 600px;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 1px 3px rgba(0,0,0,.08);
        }

        td, th {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f5f5f5;
            font-weight: bold;
            color: #333;
            border-right: 1px solid #ddd;
        }

        td {
            border-right: 1px solid #ddd;
        }

        .actions {
            margin-top: 30px;
            text-align: center;
        }

        .actions a {
            display: inline-block;
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
</head>
<body>
    <div class="container">
        <h1>ユーザー情報確認画面</h1>
        <table>
            <tr>
                <th>項目</th>
                <th>内容</th>
            </tr>
            <tr>
                <td>ユーザーID</td>
                <td><?php echo htmlspecialchars($account->getUserId()); ?></td>
            </tr>
            <tr>
                <td>ユーザー名</td>
                <td><?php echo htmlspecialchars($account->getName()); ?></td>
            </tr>
            <tr>
                <td>メールアドレス</td>
                <td><?php echo htmlspecialchars($account->getMail()); ?></td>
            </tr>
            <tr>
                <td>年齢</td>
                <td><?php echo htmlspecialchars($account->getAge()); ?></td>
            </tr>
        </table>

        <div class="actions">
            <a href="control.php">OK</a>
            <a href="control.php?action=Logout">LogOut</a>
        </div>
    </div>
</body>
</html>