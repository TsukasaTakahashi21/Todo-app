<?php
namespace App\UseCase\Input\Category;

class DeleteCategoryInput
{
  public int $categoryId;
  
  public function __construct(int $categoryId)
  {
    $this->categoryId = $categoryId;
  }
}