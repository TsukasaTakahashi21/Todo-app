<?php 
session_start(); 
require_once '../../vendor/autoload.php';
require_once '../../config/database.php';

use App\Infrastructure\Persistence\CategoryRepository;
use App\UseCase\Interactor\Category\UpdateCategoryUseCase;
use App\Presentation\Controller\Category\UpdateCategoryController;
use App\Presentation\Presenter\Category\UpdateCategoryPresenter;
use App\Infrastructure\Dao\CategoryDao;
use App\UseCase\Input\Category\UpdateCategoryInput;

$pdo = getPdo();
$categoryDao = new CategoryDao($pdo);
$categoryRepository = new CategoryRepository($categoryDao);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_id = isset($_GET['id']) ? $_GET['id'] : null;
    $category_name = isset($_POST['category_name']) ? $_POST['category_name'] : '';

    $updateCategoryUseCase = new UpdateCategoryUseCase($categoryRepository);
    $input = new UpdateCategoryInput($category_id, $category_name);
    $output = $updateCategoryUseCase->execute($input);

    $errors = $output->errors;

    if (empty($errors)) {
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['errors'] = $errors;
        header("Location: edit.php?id={$category_id}");
        exit();
    }
} else {
    $_SESSION['errors'] = ['不正なリクエストです'];
    header('Location: index.php');
    exit();
}

