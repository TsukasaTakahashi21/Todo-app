<?php
session_start();
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : '';
unset($_SESSION['errors']);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン</title>
</head>
<body>
  <h2>ログイン</h2>
  <section class="user_login">
    <?php if (!empty($errors)): ?>
      <ul>
        <?php foreach ($errors as $error): ?>
          <li><?php echo $error; ?></li>
        <?php endforeach ?>
      </ul>
    <?php endif; ?>

    <div class="login-form">
      <form action="./signin_complete.php" method="post">
        <input type="email" name="email" id="email" placeholder="Email"><br>
        <input type="password" name="password"><br>
        <button type="submit">ログイン</button>
      </form>
      <a href="signup.php">アカウントを作る</a>
    </div>
  </section>
</body>
</html>