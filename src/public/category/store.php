<?php
session_start();
require_once '../../vendor/autoload.php';
require_once '../../config/database.php';

use App\Infrastructure\Persistence\CategoryRepository;
use App\UseCase\Interactor\Category\AddCategoryUseCase;
use App\Presentation\Controller\Category\AddCategoryController;
use App\Presentation\Presenter\Category\AddCategoryPresenter;
use App\Infrastructure\Dao\CategoryDao;
use App\UseCase\Input\Category\AddCategoryInput;

$pdo = getPdo();
$categoryDao = new CategoryDao($pdo);
$categoryRepository = new CategoryRepository($categoryDao);
$addCategoryUseCase = new AddCategoryUseCase($categoryRepository);
$controller = new AddCategoryController($addCategoryUseCase);

$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
if ($userId === null) {
  $_SESSION['errors'] = ['ユーザーIDが取得できませんでした。ログインしてください。'];
  header('Location: index.php');
  exit();
}


$request = [
  'name' =>$_POST['category_name'], 
  'user_id' =>$userId
];

$controller->store($request);
header('Location: index.php');
exit();

?>
