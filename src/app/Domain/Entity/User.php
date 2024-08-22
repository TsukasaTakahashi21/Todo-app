<?php
namespace App\Domain\Entity;

use App\Domain\ValueObject\User\PassWordHash;
use App\Domain\ValueObject\User\UserId;

class User
{
    private ?UserId $id;
    private $name;
    private $email;
    private PasswordHash $passwordHash;

    public function __construct(
        ?UserId $id,
        $name,
        $email,
        PasswordHash $passwordHash
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
    }

    public function getId(): ?UserId
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPasswordHash(): PasswordHash
    {
        return $this->passwordHash;
    }
}
