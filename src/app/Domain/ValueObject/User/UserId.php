<?php
namespace App\Domain\ValueObject\User;

class UserId
{
  private $value;

  public function __construct($value)
  {
    $this->value = $value;
  }

  public function getValue()
  {
    return $this->value;
  }
}