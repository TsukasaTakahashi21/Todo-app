<?php
namespace App\UseCase\Interactor\Task;

use App\Domain\Entity\Task;
use App\Domain\Repository\TaskRepositoryInterface;
use App\UseCase\Input\Task\CreateTaskInput;
use App\UseCase\Output\Task\CreateTaskOutput;

class CreateTaskUseCase
{
  private TaskRepositoryInterface $taskRepository;

  public function __construct(TaskRepositoryInterface $taskRepository)
  {
    $this->taskRepository = $taskRepository;
  }

  public function execute(CreateTaskInput $input): CreateTaskOutput
  {
    $task = new Task(
      $input->getCategoryId(), 
      $input->getContents(),
      $input->getDeadline(),
      $input->getUserId(),
      null
    );

    $this->taskRepository->save($task);
    return new CreateTaskOutput($task);
  }
}