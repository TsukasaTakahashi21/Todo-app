<?php
namespace App\Infrastructure\Persistence;

use App\Domain\Entity\User;
use App\Infrastructure\Dao\UserDao;
use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\ValueObject\User\UnregisteredUser;

class UserRepository implements UserRepositoryInterface
{
  private $userDao;

  public function __construct(UserDao $userDao)
  {
    $this->userDao = $userDao;
  }

  public function findByEmail(string $email): ?User
  {
    return $this->userDao->findByEmail($email);
  }

  public function save(UnregisteredUser $user): void
    {
      $this->userDao->save($user);
    }
}