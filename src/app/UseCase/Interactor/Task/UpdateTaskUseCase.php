<?php
namespace App\UseCase\Interactor\Task;

use App\Domain\Repository\TaskRepositoryInterface;
use App\Domain\Entity\Task;
use App\UseCase\Input\Task\UpdateTaskInput;
use App\UseCase\Output\Task\UpdateTaskOutput;

class UpdateTaskUseCase {
    private TaskRepositoryInterface $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository) {
        $this->taskRepository = $taskRepository;
    }

    public function execute(UpdateTaskInput $input): UpdateTaskOutput {
      try {
          $task = new Task(
              $input->getCategoryId(),
              $input->getContents(),
              $input->getDeadline(),
              $input->getUserId(),
              $input->getId()
          );
  
          $this->taskRepository->update($task);
  
          return new UpdateTaskOutput([]);
      } catch (\Exception $e) {
          return new UpdateTaskOutput(['エラーが発生しました：' . $e->getMessage()]);
      }
  }
}
