<?php
namespace App\UseCase\Output\Category;

class AddCategoryOutput
{
  public array $errors;
  public ?int $categoryId;

  public function __construct(?int $categoryId = null, array $errors = [])
  {
    $this->categoryId = $categoryId;
    $this->errors = $errors;
  }

  public function hasErrors(): bool
  {
    return !empty($this->errors);
  }

  public function  getErrors(): array
  {
    return $this->errors;
  }
}