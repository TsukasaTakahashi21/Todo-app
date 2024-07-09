<?php
namespace App\Presentation\Controller;

use App\UseCase\Input\Category\UpdateCategoryInput;
use App\UseCase\Interactor\Category\UpdateCategoryUseCase;

class UpdateCategoryController
{
  private UpdateCategoryUseCase $updateCategoryUseCase;

  public function __construct(UpdateCategoryUseCase $updateCategoryUseCase)
  {
    $this->updateCategoryUseCase = $updateCategoryUseCase;
  }

  public function updateCategory(array $request, int $id): array
  {
    $input = new UpdateCategoryInput(
      $id,
      $request['category_name']
    );

    $output = $this->updateCategoryUseCase->execute($input);

    return $output->errors;
  }
}
