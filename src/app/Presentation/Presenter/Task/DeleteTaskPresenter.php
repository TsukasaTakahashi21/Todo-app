<?php
namespace App\Presentation\Presenter\Task;

use App\UseCase\Output\Task\DeleteTaskOutput;

class DeleteTaskPresenter
{
  private DeleteTaskOutput $output;

  public function __construct(DeleteTaskOutput $output)
  {
    $this->output = $output;
  }

  public function present(): array
  {
    return [
      'success' => $this->output->getTask() !== null,
      'errors' => $this->output->getErrors(),
    ];
  }
}