<?php
namespace App\Domain\Repository;

use App\Domain\Entity\Category;

interface CategoryRepositoryInterface
{
  public function findById(int $id): ?Category;

  public function findAll(): array;

  public function save(Category $category): void;

  public function delete(int $id): void;

  public function update(Category $category): void;

}

