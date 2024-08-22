<?php
namespace App\Domain\Repository;

use App\Domain\Entity\User;
use App\Domain\ValueObject\User\UnregisteredUser;

interface UserRepositoryInterface
{
  public function findByEmail(string $email): ?User;
  public function save(UnregisteredUser $user):void;
}