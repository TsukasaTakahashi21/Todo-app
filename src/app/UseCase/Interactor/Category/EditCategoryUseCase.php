<?php
namespace App\UseCase\Interactor\Category;

use App\Domain\Repository\CategoryRepositoryInterface;
use App\UseCase\Input\Category\EditCategoryInput;
use App\UseCase\Output\Category\EditCategoryOutput;

class EditCategoryUseCase
{
  private $categoryRepository;

  public function __construct(CategoryRepositoryInterface $categoryRepository)
  {
    $this->categoryRepository = $categoryRepository;
  }

  public function execute(EditCategoryInput $input): EditCategoryOutput
  {
    $errors = [];
    if (empty($input->getName())) {
      $errors[] = 'カテゴリー名が入力されていません';
    }

    if (!empty($errors)) {
      return new EditCategoryOutput($errors);
    }

    $category = $this->categoryRepository->findById($input->id);
    $category->setName($input->name);
    $this->categoryRepository->save($category);

    return new EditCategoryOutput();
  }
}