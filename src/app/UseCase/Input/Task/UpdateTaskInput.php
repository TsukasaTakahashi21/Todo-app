<?php
namespace App\UseCase\Input\Task;

class UpdateTaskInput {
    private int $id;
    private int $categoryId;
    private string $contents;
    private string $deadline;
    private int $userId;

    public function __construct(int $id, int $categoryId, string $contents, string $deadline, int $userId) {
        $this->id = $id;
        $this->categoryId = $categoryId;
        $this->contents = $contents;
        $this->deadline = $deadline;
        $this->userId = $userId;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getCategoryId(): int {
        return $this->categoryId;
    }

    public function getContents(): string {
        return $this->contents;
    }

    public function getDeadline(): string {
        return $this->deadline;
    }

    public function getUserId(): int {
        return $this->userId;
    }
}
