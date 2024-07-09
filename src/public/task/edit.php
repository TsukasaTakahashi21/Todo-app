<?php
session_start();
require_once '../../vendor/autoload.php';
require_once '../../config/database.php';

use App\UseCase\Input\Task\EditTaskInput;
use App\UseCase\Interactor\Task\EditTaskUseCase;
use App\Infrastructure\Dao\TaskDao;

$pdo = getPdo();
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
unset($_SESSION['errors']);

$id = isset($_GET['id']) ? $_GET['id'] : null;
if (!$id) {
    $_SESSION['errors'] = ['IDが不正です。'];
    header('Location: ../index.php');
    exit();
}

$taskId = intval($id); // ID を整数型に変換して代入する
$categoryId = 0; // 初期化
$contents = ''; // 初期化
$deadline = ''; // 初期化

$taskDao = new TaskDao($pdo);
$editTaskUseCase = new EditTaskUseCase($taskDao);
$input = new EditTaskInput($taskId, $categoryId, $contents, $deadline); // EditTaskInput のインスタンス化
$output = $editTaskUseCase->execute($input);
$task = $output->getTask();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>タスク編集</title>

  <?php if (!empty($errors)): ?>
    <ul>
      <?php foreach($errors as $error): ?>
        <li><?php echo $error; ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</head>
<body>
  <form action="./update.php" method="post">
    <input type="hidden" name="id" value="<?php echo $taskId; ?>">
    <select name="category_id" id="category">
      <option value="">カテゴリを選んでください</option>
      <?php
      $dbUserName = 'root';
      $dbPassword = 'password';
      $pdo = new PDO('mysql:host=mysql; dbname=todo; charset=utf8', $dbUserName, $dbPassword);
      $sql = 'SELECT id, name FROM categories';
      $statement = $pdo->query($sql);
      while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="' .$row['id'] . '">' . $row['name'] . '</option>';
      }
      ?>
    </select>
    <input type="text" name="contents" id="contents" value="<?php echo $task->getContents(); ?>">
    <input type="date" name="deadline" id="deadline" value="<?php echo $task->getDeadline(); ?>">
    <button type="submit">更新</button>
  </form>
  <a href="../index.php">戻る</a>
</body>
</html>
