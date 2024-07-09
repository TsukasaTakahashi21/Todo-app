<?php
session_start();
require_once '../../vendor/autoload.php';
require_once '../../config/database.php';

use App\Infrastructure\Dao\TaskDao;
use App\Infrastructure\Persistence\TaskRepository;
use App\UseCase\Interactor\Task\UpdateTaskUseCase;
use App\UseCase\Input\Task\UpdateTaskInput;
use App\Presentation\Presenter\Task\UpdateTaskPresenter;
use App\Presentation\Controller\Task\UpdateTaskController;

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$categoryId = isset($_POST['category_id']) ? intval($_POST['category_id']) : 0;
$contents = isset($_POST['contents']) ? $_POST['contents'] : '';
$deadline = isset($_POST['deadline']) ? $_POST['deadline'] : '';
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

$errors = [];
if (empty($id)) {
    $errors[] = 'IDが不正です。';
}
if (empty($categoryId)) {
    $errors[] = 'カテゴリが選択されていません。';
}
if (empty($contents)) {
    $errors[] = 'タスク名が入力されていません。';
}
if (empty($deadline)) {
    $errors[] = '締切日が入力されていません。';
}
if (is_null($userId)) {
    $errors[] = 'ユーザーIDが取得できませんでした。ログインしてください。';
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header('Location: edit.php?id=' . $id); // エラー時は編集画面に戻る
    exit();
}

$pdo = getPdo();
$taskDao = new TaskDao($pdo);
$taskRepository = new TaskRepository($taskDao);
$updateTaskUseCase = new UpdateTaskUseCase($taskRepository); 

$updateTaskInput = new UpdateTaskInput($id, $categoryId, $contents, $deadline, $userId);
$output = $updateTaskUseCase->execute($updateTaskInput);

$presenter = new UpdateTaskPresenter($output);

$controller = new UpdateTaskController($updateTaskUseCase, $presenter);
$controller->handle([
    'id' => $id,
    'category_id' => $categoryId,
    'contents' => $contents,
    'deadline' => $deadline,
    'user_id' => $userId
]);



