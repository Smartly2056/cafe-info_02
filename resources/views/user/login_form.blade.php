<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログインページ</title>
</head>
<body>
    <h1>ログインページ</h1>
    <form action="login.php" method="post">
        <div>
            <label for="usernameLabel">ユーザーID:</label>
            <input type="text" name="username" required>
        </div>
        <div>
            <label for="passLabel">パスワード:</label>
            <input type="text" name="pass" required>
        </div>
        <input type="submit" value="ログイン">
    </form>
</body>

</html>
