<?php
namespace App\UseCase\Input\Task;

class DeleteTaskInput
{
  private $taskId;

  public function __construct($taskId)
  {
    $this->taskId = $taskId;
  }

  public function getTaskId(): int
  {
    return $this->taskId;
  }
}

