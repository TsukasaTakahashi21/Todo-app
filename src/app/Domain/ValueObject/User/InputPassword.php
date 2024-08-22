<?php
namespace App\Domain\ValueObject\User;

class InputPassword
{
  private string $value;

  public function __construct(string $value)
  {
    $this->value = $value;
  }

  public function hash(): string
  {
    return password_hash($this->value, PASSWORD_DEFAULT);
  }
}