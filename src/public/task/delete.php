<?php
session_start();
require_once '../../vendor/autoload.php';
require_once '../../config/database.php';

use App\Infrastructure\Persistence\TaskRepository;
use App\UseCase\Interactor\Task\DeleteTaskUseCase;
use App\Presentation\Controller\Task\DeleteTaskController;
use App\Infrastructure\Dao\TaskDao;


$pdo = getPdo();
$taskDao = new TaskDao($pdo); 
$taskRepository = new TaskRepository($taskDao);

$errors = [];

$taskId = isset($_GET['id']) ? ($_GET['id']) : null;

$deleteTaskUseCase = new DeleteTaskUseCase($taskRepository);
$controller = new DeleteTaskController($deleteTaskUseCase);
$presenter = $controller->delete($taskId);

$errors = $presenter->present()['errors'];

if (!empty($errors)) {
  $_SESSION['errors'] = $errors;
}

header('Location: ../index.php');
exit();

