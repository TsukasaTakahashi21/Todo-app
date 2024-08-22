<?php
namespace App\UseCase\Interactor\User;

use App\Domain\Repository\UserRepositoryInterface;
use App\UseCase\Input\User\SignInInput;
use App\UseCase\Output\User\SignInOutput;

class SignInUseCase
{
  private UserRepositoryInterface $userRepository;

  public function __construct(UserRepositoryInterface $userRepository)
  {
    $this->userRepository = $userRepository;
  }

  public function execute(SignInInput $input): SignInOutput
  {
    $errors = [];
    
    if (empty($input->email) || empty($input->password)) {
      $errors[] = 'パスワードとメールアドレスを入力してください';
      return new SignInOutput($errors);
    }

    $user = $this->userRepository->findByEmail($input->email);

    if (!$user) {

      $errors[] = 'ユーザーが見つかりません';
      return new SignInOutput($errors);
    }


    if ($user->getPasswordHash()->verify($input->password)) {
      return new SignInOutput($errors); 
    } else {
      $errors[] = 'メールアドレスまたはパスワードが違います';
      return new SignInOutput($errors);
    }
  }
}