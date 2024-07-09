<?php
namespace App\UseCase\Interactor\Category;

use App\Domain\Repository\CategoryRepositoryInterface;
use App\UseCase\Input\Category\UpdateCategoryInput;
use App\UseCase\Output\Category\UpdateCategoryOutput;

class UpdateCategoryUseCase
{
  private CategoryRepositoryInterface $categoryRepository;

  public function __construct(CategoryRepositoryInterface $categoryRepository)
  {
    $this->categoryRepository = $categoryRepository;
  }

  public function execute(UpdateCategoryInput $input): UpdateCategoryOutput
  {
    $errors = [];
    $category = $this->categoryRepository->findById($input->id);

    if (!$category) {
      $errors[] = 'カテゴリーが見つかりません';
      return new UpdateCategoryOutput($errors);
    }

    if (empty($errors)) {
      $category->setName($input->categoryName);
      $this->categoryRepository->save($category);
    }

    return new UpdateCategoryOutput($errors);
  }
}