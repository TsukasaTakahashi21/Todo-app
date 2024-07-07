<?php
namespace App\UseCase\Output\User;

use App\Domain\ValueObject\User\UnregisteredUser;

class SignUpOutput
{
  public $user;
  private array $errors;

  public function __construct(?UnregisteredUser $user, array $errors = [])
  {
    $this->user = $user;
    $this->errors = $errors ?? [];
  }

  public function getUser(): ?UnregisteredUser
  {
    return $this->user;
  }

  public function getErrors(): array
    {
        return $this->errors;
    }
}
