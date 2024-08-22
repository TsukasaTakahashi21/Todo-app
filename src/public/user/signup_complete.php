<?php 
session_start();
require_once '../../vendor/autoload.php';
require_once '../../config/database.php';

use App\Presentation\Controller\User\SignUpController;
use App\Presentation\Presenter\User\SignUpPresenter;
use App\Infrastructure\Persistence\UserRepository;
use App\UseCase\Interactor\User\SignUpUseCase;
use App\Infrastructure\Dao\UserDao;

$pdo = getPdo(); 
$userDao = new UserDao($pdo);
$userRepository = new UserRepository($userDao);
$signUpUseCase = new SignUpUseCase($userRepository);
$signUpController = new SignUpController($signUpUseCase);
$signUpPresenter = new SignUpPresenter();

$errors = $signUpController->signUp($_POST);
$signUpPresenter->present($input);
