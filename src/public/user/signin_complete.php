<?php
session_start();
require_once '../../config/database.php';
require_once '../../vendor/autoload.php';


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\Presentation\Controller\User\SignInController;
use App\Presentation\Presenter\User\SignInPresenter;
use App\Infrastructure\Persistence\UserRepository;
use App\UseCase\Interactor\User\SignInUseCase;
use App\UseCase\Input\User\SignInInput;
use App\Infrastructure\Dao\UserDao;


$pdo = getPdo();

$userDao = new UserDao($pdo);
$userRepository = new UserRepository($userDao);

$signInUseCase = new SignInUseCase($userRepository);

$signInController = new SignInController($signInUseCase);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = new SignInInput($_POST['email'], $_POST['password']);
    $output = $signInController->signIn($input);
    $presenter = new SignInPresenter();
    $presenter->present($output->getErrors());
}

