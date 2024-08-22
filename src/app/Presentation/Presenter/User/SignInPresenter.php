<?php
namespace App\Presentation\Presenter\User;

class SignInPresenter
{
    public function present(array $errors = []): void
    {
        if (!empty($errors)) {
            foreach ($errors as $error) {
                if (is_string($error)) {
                    echo htmlspecialchars($error, ENT_HTML5 | ENT_QUOTES) . "<br>";
                }
            }
        } else {
            header('Location: /index.php');
            exit();
        }
    }
}
