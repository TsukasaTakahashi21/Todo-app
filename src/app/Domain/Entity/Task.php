<?php
namespace App\Domain\Entity;

class Task {
    private ?int $id;
    private int $categoryId;
    private string $contents;
    private string $deadline;
    private int $userId;
    private int $status;

    public function __construct(int $categoryId, string $contents, string $deadline, int $userId, ?int $id = null) {
        $this->id = $id;
        $this->categoryId = $categoryId;
        $this->contents = $contents;
        $this->deadline = $deadline;
        $this->userId = $userId;
    }

    public function getId(): ?int 
    {
        return $this->id;
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

    public function getUserId(): int {
        return $this->userId;
    }

    public function getStatus(): int
    {
        return $this->status;
    }


}
