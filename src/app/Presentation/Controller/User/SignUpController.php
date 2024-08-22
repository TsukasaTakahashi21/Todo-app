<?php
namespace App\Presentation\Controller\User;

use App\UseCase\Interactor\User\SignUpUseCase;
use App\UseCase\Input\User\SignUpInput;
use App\Presentation\Presenter\User\SignUpPresenter;

class SignUpController
{
  private SignUpUseCase $signUpUseCase;

  public function __construct(SignUpUseCase $signUpUseCase)
  {
    $this->signUpUseCase = $signUpUseCase;
  }

  public function signUp(array $InputData)
  {
    $input = new SignUpInput(
      $InputData['user_name'],
      $InputData['email'],
      $InputData['password'],
      $InputData['confirm_password']
    );

    $output = $this->signUpUseCase->execute($input);
    $presenter = new SignUpPresenter();
    $presenter->present($output->getErrors());
  }
}