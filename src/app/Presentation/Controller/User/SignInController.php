<?PHP
namespace App\Presentation\Controller\User;

use App\UseCase\Input\User\SignInInput;
use App\UseCase\Interactor\User\SignInUseCase;
use App\Presentation\Presenter\User\SignInPresenter;

class SignInController
{
  private SignInUseCase $signInUseCase;

  public function __construct(SignInUseCase $signInUseCase)
  {
    $this->signInUseCase = $signInUseCase;
  }

  public function SignIn(SignInInput $input)
  {
    $output = $this->signInUseCase->execute($input);
    return $output;
  }
}