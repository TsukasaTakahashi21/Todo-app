<?php 
session_start();
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
unset($_SESSION['errors']);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザー登録</title>
</head>
<body>
  <h2>会員登録</h2>
  <section class="user_login">
    <?php if(!empty($errors)): ?>
      <ul>
        <?php foreach ($errors as $error): ?>
          <li><?php echo $error; ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <form action="./signup_complete.php" method="post">
      <input type="text" name="user_name" placeholder="User name"><br>
      <input type="email" name="email" placeholder="Email"><br>
      <input type="password" name="password"><br>
      <input type="password" name="confirm_password" placeholder="パスワード確認"><br>
      <button type="submit">アカウント作成</button>
    </form>
    <a href="./signin.php">ログイン画面へ</a>
  </section>
</body>
</html>