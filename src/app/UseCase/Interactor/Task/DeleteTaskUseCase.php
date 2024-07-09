<?php
namespace App\UseCase\Interactor\Task;

use App\Domain\Repository\TaskRepositoryInterface;
use App\UseCase\Input\Task\DeleteTaskInput;
use App\UseCase\Output\Task\DeleteTaskOutput;

class DeleteTaskUseCase
{
  private TaskRepositoryInterface $taskRepository;

  public function __construct(TaskRepositoryInterface $taskRepository)
  {
    $this->taskRepository = $taskRepository;
  }

  public function execute(DeleteTaskInput $input): DeleteTaskOutput
  {
    $taskId = $input->getTaskId();
    $task = $this->taskRepository->findById($taskId);

    $errors = [];

    if (!$task) {
      $errors[] = 'タスクが見つかりませんでした。';
      return new DeleteTaskOutput(null, $errors);
    }

    $success = $this->taskRepository->delete($taskId);

    if ($success) {
      return new DeleteTaskOutput($task);
    } else {
      $errors[] = 'タスクの削除に失敗しました。';
      return new DeleteTaskOutput(null, $errors);
    }
  }
}