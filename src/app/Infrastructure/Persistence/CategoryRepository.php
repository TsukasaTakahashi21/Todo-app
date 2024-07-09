<?php
namespace App\Infrastructure\Persistence;

use App\Domain\Entity\Category;
use App\Domain\Repository\CategoryRepositoryInterface;
use App\Infrastructure\Dao\CategoryDao;

class CategoryRepository implements CategoryRepositoryInterface
{
    private CategoryDao $categoryDao;

    public function __construct(CategoryDao $categoryDao)
    {
        $this->categoryDao = $categoryDao;
    }

    public function findById(int $id): ?Category
    {
        return $this->categoryDao->findById($id);
    }

    public function findAll(): array
    {
        return $this->categoryDao->findAll();
    }

    public function save(Category $category): void
    {
        $this->categoryDao->save($category);
    }

    public function delete(int $id): void
    {
        $this->categoryDao->delete($id);
    }

    public function update(Category $category): void
    {
        $this->categoryDao->update($category);
    }
}
