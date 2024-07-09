<?php
namespace App\Presentation\Controller\Category;

use App\UseCase\Interactor\Category\AddCategoryUseCase;
use App\UseCase\Input\Category\AddCategoryInput;
use App\Presentation\Presenter\Category\AddCategoryPresenter;

class AddCategoryController
{
  private AddCategoryUseCase $addCategoryUseCase;

  public function __construct(AddCategoryUseCase $addCategoryUseCase)
  {
    $this->addCategoryUseCase = $addCategoryUseCase;
  }

  public function store(array $request): void
  {
    $input = new AddCategoryInput(
      $request['name'],
      $request['user_id']
    );

    $output = $this->addCategoryUseCase->execute($input);
    $presenter = new AddCategoryPresenter();
    $presenter->present($output);
  }
}