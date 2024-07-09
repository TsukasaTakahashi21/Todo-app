<?php
namespace App\Presentation\Presenter\Category;

use App\UseCase\Output\Category\AddCategoryOutput;

class AddCategoryPresenter
{
  public function present(AddCategoryOutput $output): void
  {
    if ($output->hasErrors()) {
      $_SESSION['errors'] = $output->getErrors();
    } else {
      $_SESSION['success'] = 'カテゴリが正常に追加されました。';
      header('Location: index.php');
      exit();
    }
  }
}