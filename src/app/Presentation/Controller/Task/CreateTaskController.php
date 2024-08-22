<?php
namespace App\Presentation\Controller\Task;

use App\UseCase\Input\Task\CreateTaskInput;
use App\UseCase\Interactor\Task\CreateTaskUseCase;
use App\Presentation\Presenter\Task\CreateTaskPresenter;

class CreateTaskController {
  private $createTaskUseCase;
  private $createTaskPresenter;

  public function __construct(CreateTaskUseCase $createTaskUseCase, CreateTaskPresenter $createTaskPresenter)
  {
    $this->createTaskUseCase = $createTaskUseCase;
    $this->createTaskPresenter = $createTaskPresenter;
  }

  public function handle(array $data): void {

    $categoryId = isset($_POST['category_id']) ? $_POST['category_id'] : '';
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

    if (!empty($errors)) {
      $_SESSION['errors'] = $errors;
      header('Location: create.php');
      exit();
    }

    $input = new CreateTaskInput($data['category_id'], $data['contents'], $data['deadline'], $data['user_id']);
    $output = $this->createTaskUseCase->execute($input);
    $this->createTaskPresenter->present($output);
  }
}