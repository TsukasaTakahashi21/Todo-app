<?php
namespace App\Infrastructure\Dao;

use PDO;
use App\Domain\Entity\Task;
use App\Domain\Repository\TaskRepositoryInterface;

class TaskDao implements TaskRepositoryInterface
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findTasks(?string $search, ?string $order, ?string $status, ?int $categoryId): array
    {
        $sql = 'SELECT tasks.id, tasks.contents, tasks.deadline, tasks.status, tasks.category_id, categories.name as category_name FROM tasks LEFT JOIN categories ON tasks.category_id = categories.id WHERE tasks.contents LIKE :search OR categories.name LIKE :search';

        if ($status === 'done') {
            $sql .= ' AND tasks.status = 1';
        } elseif ($status === 'yet') {
            $sql .= ' AND tasks.status = 0';
        }

        $sql .= ($order === 'asc') ? ' ORDER BY tasks.created_at ASC' : ' ORDER BY tasks.created_at DESC';

        if (!empty($categoryId)) {
            $sql .= ' AND tasks.category_id = :category_id';
        }

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':search', $search, PDO::PARAM_STR);

        if (!empty($categoryId)) {
            $statement->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
        }

        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id): ?Task
    {
        $sql = 'SELECT * FROM tasks WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $taskData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($taskData === false) {
            return null;
        }

        return new Task(
            $taskData['id'],
            $taskData['contents'],
            $taskData['deadline'],
            $taskData['category_id'],
            $taskData['user_id'],
        );
    }

    public function findAll(): array
    {
        $sql = 'SELECT * FROM tasks';
        $stmt = $this->pdo->query($sql);
        $tasks = [];

        while ($taskData = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $tasks[] = new Task(
                $taskData['id'],
                $taskData['contents'],
                $taskData['deadline'],
                $taskData['category_id'],
                $taskData['user_id'],
                $taskData['status']
            );
        }
        return $tasks;
    }

    public function save(Task $task): void
    {
        $sql =
            'INSERT INTO tasks ( category_id, contents, deadline, user_id) VALUES (:category_id, :contents, :deadline, :user_id)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':category_id', $task->getCategoryId(), PDO::PARAM_INT);
        $stmt->bindValue(':contents', $task->getContents(), PDO::PARAM_STR);
        $stmt->bindValue(':deadline', $task->getDeadline(), PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $task->getUserId(), PDO::PARAM_INT);
        $stmt->execute();
    }

    public function delete(int $taskId): void
    {
        $sql = 'DELETE FROM tasks WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $taskId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function update(Task $task): void
    {
      $sql =
        'UPDATE tasks SET contents = :contents, deadline = :deadline,   category_id = :category_id WHERE id = :id';
  
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':contents', $task->getContents(), PDO::PARAM_STR);
        $stmt->bindValue(':deadline', $task->getDeadline(), PDO::PARAM_STR);
        $stmt->bindValue(
            ':category_id',
            $task->getCategoryId(),
            PDO::PARAM_INT
        );
        $stmt->bindValue(':id', $task->getId(), PDO::PARAM_INT);
        $stmt->execute();
    }
}
