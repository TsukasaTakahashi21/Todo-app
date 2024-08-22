<?php
namespace App\Domain\Repository;

use App\Domain\Entity\Task;

interface TaskRepositoryInterface {
  public function findById(int $id): ?Task;
  public function findAll(): array;
  public function save(Task $task): void;
  public function update(Task $task): void;
  public function delete(int $taskId): void;
  public function findTasks(?string $search, ?string $order, ?string $status, ?int $categoryId): array;
}