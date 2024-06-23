<?php
session_start();

$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO('mysql:host=mysql; dbname=todo; charset=utf8', $dbUserName, $dbPassword);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : null;
    $contents = isset($_POST['contents']) ? $_POST['contents'] : '';
    $deadline = isset($_POST['deadline']) ? $_POST['deadline'] : '';

    if (empty($id)) {
        $errors[] = 'IDが不正です。';
    }
    if (empty($category_id)) {
        $errors[] = 'カテゴリを選択してください。';
    }
    if (empty($contents)) {
        $errors[] = '内容を入力してください。';
    }
    if (empty($deadline)) {
        $errors[] = '期限を入力してください。';
    }

    if (empty($errors)) {
        $sql = 'UPDATE tasks SET category_id = :category_id, contents = :contents, deadline = :deadline WHERE id = :id';
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':category_id', $category_id, PDO::PARAM_INT);
        $statement->bindValue(':contents', $contents, PDO::PARAM_STR);
        $statement->bindValue(':deadline', $deadline, PDO::PARAM_STR);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        
        header('Location: ../index.php');
        exit();
    } else {
        $_SESSION['errors'] = $errors;
        header('Location: edit.php?id=' . $id);
        exit();
    }
}
?>
