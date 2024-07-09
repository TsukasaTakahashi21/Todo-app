<?php
namespace App\UseCase\Output\Task;

class UpdateTaskOutput
{
  private array $errors;

  public function __construct(array $errors = [])
  {
    $this->errors = $errors;
  }

  public function getErrors(): array
  {
    return $this->errors;
  }
}