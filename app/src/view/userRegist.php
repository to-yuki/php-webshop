<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ユーザー登録フォーム</title>
    <link rel="stylesheet" href="/view/styles.css">
</head>
<body>
    <form action="" method="post">
        <?php if (isset($_SESSION['registError'])): ?>
            <div style="color: red; margin-bottom: 20px;">
                <?php echo htmlspecialchars($_SESSION['registError']); ?>
            </div>
            <?php unset($_SESSION['registError']); // エラーメッセージを表示後にクリア ?>
        <?php endif; ?>

        <label for="userid">ユーザーID:</label>
        <input type="text" id="userid" name="userid" required>
        
        <label for="username">ユーザー名:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="password">パスワード:</label>
        <input type="password" id="password" name="password" required>
        
        <label for="email">メールアドレス:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="age">年齢:</label>
        <input type="number" id="age" name="age" min="0" step="1"> <!-- ageをnumberタイプに変更 -->
        
        <input type="hidden" name="action" value="UserRegistAction">
        <input type="submit" value="登録">
    </form>
    <div class="actions">
            <a href="control.php">戻る</a>
    </div>
</body>
</html>