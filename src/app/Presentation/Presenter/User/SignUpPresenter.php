<?php
namespace App\Presentation\Presenter\User;

class SignUpPresenter
{
  public function present(array $errors): void
  {
    if (!empty($errors)) {
      $_SESSION['errors'] = $errors;
      header('Location: signup.php');
      exit();
    } else {
      header('Location: signin.php');
      exit();
    }
  }
}