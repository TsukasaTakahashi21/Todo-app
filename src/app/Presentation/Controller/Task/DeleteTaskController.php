<?php
namespace App\Presentation\Controller\Task;

use App\UseCase\Input\Task\DeleteTaskInput;
use App\UseCase\Interactor\Task\DeleteTaskUseCase;
use App\Presentation\Presenter\Task\DeleteTaskPresenter;

class DeleteTaskController
{
  private DeleteTaskUseCase  $deleteTaskUseCase;

  public function __construct(DeleteTaskUseCase $deleteTaskUseCase)
  {
    $this->deleteTaskUseCase = $deleteTaskUseCase;
  }

  public function delete($taskId): DeleteTaskPresenter
  {
    $input = new DeleteTaskInput($taskId);
    $output = $this->deleteTaskUseCase->execute($input);

    return new DeleteTaskPresenter($output);
  }
}
