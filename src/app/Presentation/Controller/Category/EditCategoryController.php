<?php
namespace App\Presentation\Controller\Category;

use App\Infrastructure\Persistence\CategoryRepository;
use App\Presentation\Presenter\Category\EditCategoryPresenter;
use App\UseCase\Input\Category\EditCategoryInput;
use App\UseCase\Interactor\Category\EditCategoryUseCase;
use App\Domain\Entity\Category;

class EditCategoryController
{
  private $categoryRepository;
  private $editCategoryPresenter;

  public function __construct(CategoryRepository $categoryRepository, EditCategoryPresenter $editCategoryPresenter)
  {
    $this->categoryRepository = $categoryRepository;
    $this->editCategoryPresenter = $editCategoryPresenter;
  }

  public function edit(array $request)
  {
    $category = $this->categoryRepository->findById($request['id']);

    return $this->editCategoryPresenter->present($category);
  }
}