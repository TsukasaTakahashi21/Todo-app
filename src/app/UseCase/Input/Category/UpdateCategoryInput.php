<?php
namespace App\UseCase\Input\Category;

class UpdateCategoryInput
{
  public int $id;
  public string $categoryName;

  public function __construct(int $id, string $categoryName)
  {
    $this->id = $id;
    $this->categoryName = $categoryName;
  }
}