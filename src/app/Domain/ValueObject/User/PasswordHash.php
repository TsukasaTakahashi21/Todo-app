<?php
namespace App\Domain\ValueObject\User;

class PasswordHash
{
  private $hashedPassword;


  public function __construct($password)
  {
    $this->hashedPassword = $password;
  }

  public function verify($password)
  {
    return password_verify($password, $this->hashedPassword);
  }

  public function getHashedPassword(): string
  {
    return $this->hashedPassword;
  }

  public function __toString()
  {
    return $this->hashedPassword;
  }
}