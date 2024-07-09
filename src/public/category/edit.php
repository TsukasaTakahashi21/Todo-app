<?php 
session_start(); 
require_once '../../vendor/autoload.php';
require_once '../../config/database.php';

use App\Infrastructure\Persistence\CategoryRepository;
use App\Infrastructure\Dao\CategoryDao;
use App\Presentation\Controller\Category\EditCategoryController;
use App\Presentation\Presenter\Category\EditCategoryPresenter;

$pdo = getPdo();
$categoryDao = new CategoryDao($pdo);
$categoryRepository = new CategoryRepository($categoryDao);
$editCategoryPresenter = new EditCategoryPresenter();
$editCategoryController = new EditCategoryController($categoryRepository, $editCategoryPresenter);

$category_id = isset($_GET['id']) ? (int)$_GET['id'] : null;

$category = $categoryRepository->findById($category_id);
$data = $editCategoryController->edit(['id' => $category_id]);
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
        <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
      <?php endforeach; ?>
    </ul>
    <?php unset($_SESSION['errors']); ?>
  <?php endif; ?>

  <form action="./update.php?id=<?php echo htmlspecialchars($category->getId(), ENT_QUOTES, 'UTF-8'); ?>" method="post">
    <input type="text" name="category_name" value="<?php echo htmlspecialchars($category->getName(), ENT_QUOTES, 'UTF-8'); ?>">
    <button type="submit">更新</button>
  </form>
  <a href="index.php">戻る</a>
</body>
</html>