<?php
namespace App\UseCase\Output\Category;

class UpdateCategoryOutput
{
  public array $errors;

  public function __construct(array $errors)
  {
    $this->errors = $errors;
  }
}