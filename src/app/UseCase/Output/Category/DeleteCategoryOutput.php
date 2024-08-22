<?php
namespace App\UseCase\Output\Category;

class DeleteCategoryOutput
{
  public array $errors = [];

  public function __construct(array $errors = [])
  {
    $this->errors = $errors;
  }
}