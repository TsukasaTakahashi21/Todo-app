<?php
namespace App\Presentation\Presenter\Category;

use App\UseCase\Output\Category\DeleteCategoryOutput;

class DeleteCategoryPresenter
{
  public function present(DeleteCategoryOutput $output): void
  {
    if (!empty($output->errors)) {
      $_SESSION['errors'] = $output->errors;
    }
    header('Location: /index.php');
    exit();
  }
}