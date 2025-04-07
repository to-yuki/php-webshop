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
        <h1>ログアウトしますか？</h1>
        <div class="actions">
            <a href="control.php?action=LogoutAction">LogOut</a>
        </div>
    </div>
</body>
</html>