<?php
session_start();
require_once '../../vendor/autoload.php';
require_once '../../config/database.php';

use App\Infrastructure\Dao\TaskDao;
use App\Infrastructure\Persistence\TaskRepository;
use App\Presentation\Presenter\Task\CreateTaskPresenter;
use App\Presentation\Controller\Task\CreateTaskController;
use App\UseCase\Interactor\Task\CreateTaskUseCase;
use App\UseCase\Input\Task\CreateTaskInput;

$categoryId = isset($_POST['category_id']) ? intval($_POST['category_id']) : 0;
$contents = isset($_POST['contents']) ? $_POST['contents'] : '';
$deadline = isset($_POST['deadline']) ? $_POST['deadline'] : '';
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

$errors = [];
if (empty($categoryId)) {
  $errors[] = 'カテゴリが選択されていません';
}
if (empty($contents)) {
  $errors[] = 'タスク名が入力されていません';
}
if (empty($deadline)) {
  $errors[] = '締切日が入力されていません';
}
if (is_null($userId)) {
  $errors[] = 'ユーザーIDが取得できませんでした。ログインしてください。';
}

if (empty($errors)) {
  $pdo = getPdo(); 
  $taskDao = new TaskDao($pdo);
  $taskRepository = new TaskRepository($taskDao);
  $createTaskUseCase = new CreateTaskUseCase($taskRepository);
  $presenter = new CreateTaskPresenter();
  $controller = new CreateTaskController($createTaskUseCase, $presenter);

  $input = new CreateTaskInput($categoryId, $contents, $deadline, $userId);
  $controller->handle([
    'category_id' => $categoryId,
    'contents' => $contents,
    'deadline' => $deadline,
    'user_id' => $userId
  ]);
  $output = $createTaskUseCase->execute($input);
} else {
  $_SESSION['errors'] = $errors;
  header('Location: create.php'); 
  exit();
}
?>
