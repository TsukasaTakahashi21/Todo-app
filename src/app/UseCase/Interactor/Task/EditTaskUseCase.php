<?php
namespace App\UseCase\Interactor\Task;

use App\Domain\Repository\TaskRepositoryInterface;
use App\UseCase\Input\Task\EditTaskInput;
use App\UseCase\Output\Task\EditTaskOutput;

class EditTaskUseCase
{
  private TaskRepositoryInterface $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function execute(EditTaskInput $input): EditTaskOutput
    {
      $taskId = $input->getTaskId();
      $task = $this->taskRepository->findById($taskId);
      if (!$task) {
        return new EditTaskOutput(null, ['タスクが見つかりませんでした']);
      }
      $this->taskRepository->update($task);
      
      return new EditTaskOutput($task);
    }
}