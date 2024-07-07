<?php
namespace App\Domain\ValueObject\User;

use App\Domain\ValueObject\User\InputPassword;

class UnregisteredUser
{
  private $name;
  private $email;
  private InputPassword $inputPassword;

  public function __construct(

      $name,
      $email,
      InputPassword $inputPassword
  ) {
  
      $this->name = $name;
      $this->email = $email;
      $this->inputPassword = $inputPassword;
  }

  public function getName(): string
  {
      return $this->name;
  }

  public function getEmail(): string
  {
      return $this->email;
  }

  public function getInputPassword(): InputPassword
  {
    return $this->inputPassword;
  }
}