<?php
namespace App\Infrastructure\Dao;

use PDO;
use App\Domain\Entity\category;
use App\Domain\Repository\CategoryRepositoryInterface;

class CategoryDao implements CategoryRepositoryInterface
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findById(int $id): ?Category
    {
        $sql = 'SELECT * FROM categories WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $categoryData = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$categoryData) {
            return null;
        }

        return new Category(
            $categoryData['name'],
            (int) $categoryData['user_id'],
            $categoryData['id']
        );
    }

    public function findAll(): array
    {
        $sql = 'SELECT * FROM categories';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $categoryData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $categories = [];
        foreach ($categoryData as $data) {
            $categories[] = new Category(
                
                $data['name'],
                (int) $data['user_id'],
                $data['id']
            );
        }
        return $categories;
    }

    public function save(Category $category): void
    {
        if ($category->getId()) {
            $stmt = $this->pdo->prepare(
                'UPDATE categories SET name = :name WHERE id = :id'
            );
            $stmt->execute([
                'name' => $category->getName(),
                'id' => $category->getId(),
            ]);
        } else {
            $stmt = $this->pdo->prepare(
                'INSERT INTO categories (name, user_id) VALUES (:name, :user_id)'
            );
            $stmt->execute([
                'name' => $category->getName(),
                'user_id' => $category->getUserId(),
            ]);
        }
    }

    public function delete(int $id): void
    {
        $sql = 'DELETE FROM categories WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function update(Category $category): void
    {
        $sql = 'UPDATE categories SET name = :name WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $category->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':name', $category->getName(), PDO::PARAM_STR);
        $stmt->execute();
    }
}
