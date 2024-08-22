<?php
namespace App\Presentation\Controller\Category;

use App\UseCase\Interactor\Category\DeleteCategoryUseCase;
use App\UseCase\Input\Category\DeleteCategoryInput;
use App\Presentation\Presenter\Category\DeleteCategoryPresenter;

class DeleteCategoryController
{
  private DeleteCategoryUseCase $deleteCategoryUseCase;

  public function __construct(DeleteCategoryUseCase $deleteCategoryUseCase)
  {
    $this->deleteCategoryUseCase = $deleteCategoryUseCase;
  }

  public function delete(array $requestData): void
  {
    $input = new DeleteCategoryInput($requestData['id']);
    $output = $this->deleteCategoryUseCase->execute($input);
    $presenter = new DeleteCategoryPresenter();
    $presenter->present($output);
  }
}