<?php
namespace App\UseCase\Interactor\Category;

use App\Domain\Entity\Category;
use App\Domain\Repository\CategoryRepositoryInterface;
use App\Infrastructure\Persistence\CategoryRepository;
use App\UseCase\Input\Category\AddCategoryInput;
use App\UseCase\Output\Category\AddCategoryOutput;

class AddCategoryUseCase
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function execute(AddCategoryInput $input): AddCategoryOutput
    {
        if (empty($input->getName())) {
            return new AddCategoryOutput(null, ['カテゴリ名は必須です。']);
        }

        $category = new Category($input->getName(), $input->getUserId());
        $this->categoryRepository->save($category);

        return new AddCategoryOutput($category->getId());
    }
}
