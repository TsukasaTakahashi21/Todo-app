<?php
namespace App\UseCase\Interactor\User;

use App\Domain\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\ValueObject\User\InputPassword;
use App\UseCase\Input\User\SignUpInput;
use App\UseCase\Output\User\SignUpOutput;
use App\Domain\ValueObject\User\PasswordHash;
use App\Domain\ValueObject\User\UnregisteredUser;

class SignUpUseCase
{
  private UserRepositoryInterface $userRepository;

  public function __construct(UserRepositoryInterface $userRepository)
  {
    $this->userRepository = $userRepository;
  }

  public function execute(SignUpInput $input): SignUpOutput
  {
    $errors = [];

    if (empty($input->email) || empty($input->getPassword())) {
        $errors[] = 'EmailかPasswordの入力がありません';
    }

    if ($input->password !== $input->getConfirmPassword()) {
        $errors[] = 'パスワードが一致しません';
    }

    $existingUser = $this->userRepository->findByEmail($input->getEmail());
    if ($existingUser) {
        $errors[] = 'すでに保存されているメールアドレスです';
    }

    if (empty($errors)) {
        $inputPassword = new InputPassword($input->getPassword());


        $user = new UnregisteredUser(
          $input->getName(),
          $input->getEmail(),
          $inputPassword
      );

        $this->userRepository->save($user);
        return new SignUpOutput($user);
    }
    return new SignUpOutput(null, $errors);
  }
}