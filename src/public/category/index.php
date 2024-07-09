<?php
session_start();

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config/database.php';

use App\Infrastructure\Persistence\CategoryRepository;
use App\Presentation\Presenter\Category\AddCategoryPresenter;
use App\Infrastructure\Dao\CategoryDao;
use App\Presentation\Controller\Category\AddCategoryController;

$pdo = getPdo();
$categoryDao = new CategoryDao($pdo);
$categoryRepository = new CategoryRepository($categoryDao);

$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : '';
unset($_SESSION['errors']);


$categories = $categoryRepository->findAll();
$addCategoryPresenter = new AddCategoryPresenter();
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <title>カテゴリ一覧</title>
</head>
<body>
  <h2>カテゴリ一覧</h2>

  <?php if(!empty($errors)): ?>
    <ul>
      <?php foreach($errors as $error): ?>
        <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

  <form action="store.php" method="post">
    <input type="text" name="category_name" placeholder="カテゴリを追加">
    <button type="submit">登録</button>
  </form>

  <?php foreach ($categories as $category): ?>
    <div class="category_type">
      <p><?php echo htmlspecialchars($category->getName(), ENT_QUOTES, 'UTF-8'); ?></p>
      <button onclick="location.href='edit.php?id=<?php echo $category->getId(); ?>'">編集</button>
      <button onclick="location.href='delete.php?id=<?php echo $category->getId(); ?>'">削除</button>
    </div>
  <?php endforeach; ?>
  
  <a href="../task/create.php">戻る</a>
</body>
</html>
