
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>タスク作成画面</title>
</head>
<body>
<?php
  $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
  unset($_SESSION['errors']);

  foreach ($errors as $error) {
    echo '<p>' . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . '</p>';
  }
  ?>

  <a href="../category/index.php">カテゴリを追加</a>
  <form action="./store.php" method="post">
    <select name="category_id" id="category">
      <option value="">カテゴリを選んでください</option>
      <?php
      $dbUserName = 'root';
      $dbPassword = 'password';
      $pdo = new PDO('mysql:host=mysql; dbname=todo; charset=utf8', $dbUserName, $dbPassword);
      $sql = 'SELECT id, name FROM categories';
      $statement = $pdo->query($sql);
      while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
      }
      ?>
    </select>
    <input type="text" name="contents" placeholder="タスクを追加">
    <input type="date" name="deadline">
    <button type="submit">追加</button>
  </form>
  <a href="../index.php">戻る</a>
</body>
</html>