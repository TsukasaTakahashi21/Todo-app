<?php
namespace App\UseCase\Output\Category;

class EditCategoryOutput
{
  public $errors;

  public function __construct(array $errors = [])
  {
    $this->errors = $errors;
  }
}