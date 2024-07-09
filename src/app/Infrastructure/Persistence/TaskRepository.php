<?php
namespace App\Infrastructure\Persistence;

use App\Domain\Entity\Task;
use App\Domain\Repository\TaskRepositoryInterface;
use App\Infrastructure\Dao\TaskDao;

class TaskRepository implements TaskRepositoryInterface 
{

  private $taskDao;
  
  public function __construct(TaskDao $taskDao)
  {
    $this->taskDao = $taskDao;
  }

  public function findTasks(?string $search, ?string $order, ?string $status, ?int $categoryId): array
  {
      $taskData = $this->taskDao->findTasks($search, $order, $status, $categoryId);
      $tasks = [];

      foreach ($taskData as $data) {
          $tasks[] = new Task(
              $data['id'],
              $data['contents'],
              $data['deadline'],
              $data['status'],
              $data['category_id'],
              $data['category_name']
          );
      }

      return $tasks;
  }

  public function findById(int $id): ?Task
  {
    return $this->taskDao->findById($id);
  }

  public function findAll(): array
  {
      return $this->taskDao->findAll();
  }

  public function save(Task $task): void
  {
    $this->taskDao->save($task);
  }

  public function delete(int $id): void
  {
    $this->taskDao->delete($id);
  }

  public function update(Task $task): void
  {
    $this->taskDao->update($task);
  }
}