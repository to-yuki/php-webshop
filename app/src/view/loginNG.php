<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>スッキリ商店</title>
    <link rel="stylesheet" href="/view/styles.css">
</head>
<body>
    <div style="text-align: center; color: red; margin-bottom: 20px;">
        ログインに失敗しました。ユーザーIDとパスワードを確認してください。
    </div>
    <form action="control.php" method="post">
        ユーザーID:<input type="text" name="userId" required><br>
        パスワード:<input type="password" name="pass" required><br>
        <input type="hidden" name="action" value="LoginAction">
        <input type="submit" value="ログイン">
    </form>
    <div class="actions">
            <a href="control.php">戻る</a>
    </div>
</body>
</html>