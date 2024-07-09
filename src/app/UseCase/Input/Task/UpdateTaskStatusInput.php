
<?php
namespace App\UseCase\Input\Task;

use App\Domain\ValueObject\Task\TaskId;
use App\Domain\ValueObject\Category\TaskCategory;
use App\Domain\ValueObject\Task\TaskContents;
use App\Domain\ValueObject\Task\TaskDeadline;

class UpdateStatusTaskInput
{
    private TaskId $taskId;
    private TaskCategory $categoryId;
    private TaskContents $contents;
    private TaskDeadline $deadline;

    public function __construct(TaskId $taskId, TaskCategory $CategoryId, TaskContents $contents, TaskDeadline $deadline)
    {
        $this->taskId = $taskId;
        $this->TaskCategory = $CategoryId;
        $this->TaskContents = $contents;
        $this->deadline = $deadline;
    }

    public function getTaskId(): TaskId
    {
        return $this->id;
    }

    public function getCategoryId(): TaskCategory
    {
        return $this->CategoryId;
    }

    public function getTaskName(): TaskName
    {
        return $this->taskName;
    }

    public function getDueDate(): TaskDueDate
    {
        return $this->dueDate;
    }
}
