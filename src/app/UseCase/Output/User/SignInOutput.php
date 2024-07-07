<?php
namespace App\UseCase\Output\User;

use App\Domain\Entity\User;

class SignInOutput
{
  public array $errors;
  public ?User $user;

  public function __construct(array $errors, ?User $user = null)
  {
    $this->errors = $errors;
    $this->user = $user;
  }

  public function getErrors(): array
  {
      return $this->errors;
  }
}