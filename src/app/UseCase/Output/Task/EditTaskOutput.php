<?php
namespace App\UseCase\Output\Task;

use App\Domain\Entity\Task;

class EditTaskOutput
{
    private ?Task $task;
    private array $errors;

    public function __construct(?Task $task = null, array $errors = [])
    {
        $this->task = $task;
        $this->errors = $errors;
    }

    public function getTask(): ?Task
    {
        return $this->task;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
?>
