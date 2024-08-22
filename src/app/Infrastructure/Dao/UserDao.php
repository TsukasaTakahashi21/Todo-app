<?php
namespace App\Infrastructure\Dao;

use PDO;
use App\Domain\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\ValueObject\User\UserId;
use App\Domain\ValueObject\User\PassWordHash;
use App\Domain\ValueObject\User\UnregisteredUser;

class UserDao implements UserRepositoryInterface
{
  private $pdo;

  public function __construct(PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  public function findByEmail(string $email): ?User
  {
    $sql = 'SELECT * FROM users WHERE email = :email';
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$userData) {
      return null;
    }

    $userId = isset($userData['id']) ? new UserId($userData['id']) : null;

    return new User(
      $userId,
      $userData['name'],
      $userData['email'],
      new PasswordHash($userData['password'])
    );
  }

  

  public function save(UnregisteredUser $user): void
  {
    $sql = 'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)';
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
      'name' => $user->getName(),
      'email' => $user->getEmail(),
      'password' => $user->getInputPassword()->hash()
    ]);
  }
}