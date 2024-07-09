<?php
namespace App\Presentation\Presenter\Task;

use App\UseCase\Output\Task\CreateTaskOutput;

class CreateTaskPresenter {
  public function present(CreateTaskOutput $output) {
    if ($output->isSuccess()) {
      header('Location: ../../../index.php');
      exit();
    } else {
      $_SESSION['errors'] = $output->getErrors();
      header('Location: create.php');
      exit();
    }
  }
}