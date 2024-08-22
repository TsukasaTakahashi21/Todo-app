<?php
namespace App\UseCase\Interactor\Category;

use App\Domain\Repository\CategoryRepositoryInterface;
use App\UseCase\Input\Category\DeleteCategoryInput;
use App\UseCase\Output\Category\DeleteCategoryOutput;

class DeleteCategoryUseCase
{
  private CategoryRepositoryInterface $categoryRepository;

  public function __construct(CategoryRepositoryInterface $categoryRepository)
  {
    $this->categoryRepository = $categoryRepository;
  }

  public function execute(DeleteCategoryInput $input): DeleteCategoryOutput
  {
    $category = $this->categoryRepository->findById($input->categoryId);

    if (!$category) {
      return new DeleteCategoryOutput(['カテゴリーが見つかりません']);
    }

    $this->categoryRepository->delete($input->categoryId);

    return new DeleteCategoryOutput();
  }
}
