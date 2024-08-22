<?php
session_start();
require_once '../../vendor/autoload.php';
require_once '../../config/database.php';

use App\Infrastructure\Dao\CategoryDao;
use App\Infrastructure\Persistence\CategoryRepository;
use App\UseCase\Interactor\Category\DeleteCategoryUseCase;
use App\Presentation\Controller\Category\DeleteCategoryController;

$pdo = getPdo();
$categoryDao = new CategoryDao($pdo);
$categoryRepository = new CategoryRepository($categoryDao);

$deleteCategoryUseCase = new DeleteCategoryUseCase($categoryRepository);
$deleteCategoryController = new DeleteCategoryController($deleteCategoryUseCase);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
  $deleteCategoryController->delete(['id' => (int)$_GET['id']]);
}
?>
