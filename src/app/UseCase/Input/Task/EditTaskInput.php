<?php
namespace App\UseCase\Input\Task;

class EditTaskInput
{
    private int $taskId;
    private int $categoryId;
    private string $contents;
    private string $deadline;

    public function __construct(int $taskId, int $categoryId, string $contents, string $deadline)
    {
        $this->taskId = $taskId;
        $this->categoryId = $categoryId;
        $this->contents = $contents;
        $this->deadline = $deadline;
    }

    public function getTaskId(): int
    {
        return $this->taskId;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getContents(): string
    {
        return $this->contents;
    }

    public function getDeadline(): string
    {
        return $this->deadline;
    }
}
?>
