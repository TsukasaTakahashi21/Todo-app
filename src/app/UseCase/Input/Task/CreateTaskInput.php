<?php
namespace App\UseCase\Input\Task;

class CreateTaskInput
{
  public int $categoryId;
  public string $contents;
  public string $deadline;
  public int $userId;

  public function __construct(int $categoryId, string $contents, string $deadline,  int $userId)
  {
    $this->categoryId = $categoryId;
    $this->contents = $contents;
    $this->deadline = $deadline;
    $this->userId = $userId;
    
    
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

