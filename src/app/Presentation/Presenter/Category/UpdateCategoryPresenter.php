<?php
namespace App\Presentation\Presenter;

class UpdateCategoryPresenter
{
  public function present(array $errors): void
  {
    if (!empty($errors)) {
      $_SESSION['errors'] = $errors;
    }
    header('Location: index.php');
    exit();
  }
}