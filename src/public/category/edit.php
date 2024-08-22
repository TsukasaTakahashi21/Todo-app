<?php 
session_start(); 
$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=todo; charset=utf8',
    $dbUserName,
    $dbPassword,
);

if (!isset($_GET['id'])) {
  header('Location: index.php');
  exit();
}
$id = $_GET['id'];

$sql = 'SELECT * FROM categories WHERE id = :id';
$statement = $pdo->prepare($sql);
$statement->bindValue(':id', $id, PDO::PARAM_INT);
$statement->execute();
$category = $statement->fetch(PDO::FETCH_ASSOC);

if (!$category) {
  header('Location: index.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>カテゴリ編集</title>
</head>
<body>
  <?php if (!empty($_SESSION['errors'])): ?>
    <ul>
      <?php foreach ($_SESSION['errors'] as $error): ?>
        <li><?php echo $error; ?></li>
      <?php endforeach; ?>
    </ul>
    <?php unset($_SESSION['errors']); ?>
  <?php endif; ?>

  <form action="./update.php?id=<?php echo $id; ?>" method="post">
    <input type="text" name="category_name" value="<?php echo $category['name']; ?>">
    <button type="submit">更新</button>
  </form>
  <a href="index.php">戻る</a>
</body>
</html>