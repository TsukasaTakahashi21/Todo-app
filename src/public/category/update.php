<?php
session_start();
$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=todo; charset=utf8',
    $dbUserName,
    $dbPassword,
);

$errors = [];

if (!isset($_GET['id'])) {
  header('Location: index.php');
}
$id = $_GET['id'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $category_name = isset($_POST['category_name']) ? $_POST['category_name'] : '';

  if (empty($_POST['category_name'])) {
    $errors[] = 'カテゴリー名が入力されていません';
  }

  if (empty($errors)) {
    $sql = 'UPDATE categories SET name = :name WHERE id = :id';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':name', $category_name, PDO::PARAM_STR);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    header('Location: ./index.php');
    exit();
  } else {
    $_SESSION['errors'] = $errors;
    header('Location: edit.php?id='. $id);
    exit();
  }
} 
?>