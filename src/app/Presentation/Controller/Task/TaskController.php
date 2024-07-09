<?php
namespace App\Presentation\Controller\Task;

use App\UseCase\Input\Task\GetTaskInput;
use App\UseCase\Interactor\Task\GetTaskUseCase;
use App\Presentation\Presenter\Task\TaskPresenter;

class TaskController
{
    private GetTaskUseCase $getTasksUseCase;
    private TaskPresenter $taskPresenter;

    public function __construct(GetTaskUseCase $getTasksUseCase, TaskPresenter $taskPresenter)
    {
        $this->getTasksUseCase = $getTasksUseCase;
        $this->taskPresenter = $taskPresenter;
    }

    public function index(array $queryParams): array
    {
      $status = isset($queryParams['status']) ? (int)$queryParams['status'] : null;
        $input = new GetTaskInput(
            $queryParams['search'] ?? null,
            $queryParams['order'] ?? null,
            $status,
            isset($queryParams['category_id']) ? (int)$queryParams['category_id'] : null
        );

        $output = $this->getTasksUseCase->execute($input);
        return $this->taskPresenter->present($output);
    }
}
?>
