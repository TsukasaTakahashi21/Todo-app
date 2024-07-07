<?php
namespace App\UseCase\Input\User;

class SignUpInput
{
  public $name;
  public $email;
  public $password;
  public $confirmPassword;

  public function __construct($name, $email, $password, $confirmPassword)
  {
    $this->name = $name;
    $this->email = $email;
    $this->password = $password;
    $this->confirmPassword = $confirmPassword;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function getPassword()
  {
    return $this->password;
  }

  public function getConfirmPassword()
  {
    return $this->confirmPassword;
  }
}