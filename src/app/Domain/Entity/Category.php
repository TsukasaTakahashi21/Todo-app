<?php
namespace App\Domain\Entity;

class Category
{
    private ?int $id;
    private string $name;
    private int $userId;

    public function __construct(string $name, int $userId, ?int $id = null)
    {
        $this->name = $name;
        $this->userId = $userId;
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}
