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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = isset($_POST['user_name']) ? $_POST['user_name'] : '';
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $password = isset($_POST['password']) ? $_POST['password'] : '';
  $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

  if (empty($email) || empty($password)) {
    $errors[] = 'EmailかPasswordの入力がありません';
  }

  if ($password !== $confirm_password) {
    $errors[] = 'パスワードが一致しません';
  }

  $sql = 'SELECT count(*) as count FROM users WHERE email = :email';
  $statement = $pdo->prepare($sql);
  $statement->bindValue(':email', $email, PDO::PARAM_STR);
  $statement->execute();
  $result = $statement->fetch(PDO::FETCH_ASSOC);

  if ($result['count'] > 0) {
    $errors[] = 'すでに保存されているメールアドレスです';
  }

  if (empty($errors)) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = 'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':name', $username, PDO::PARAM_STR);
    $statement->bindValue(':email', $email, PDO::PARAM_STR);
    $statement->bindValue(':password', $hashed_password, PDO::PARAM_STR);
    $statement->execute();
    header('Location: signin.php');
    exit();
  } else {
    $_SESSION['errors'] = $errors;
    header('Location: signup.php');
    exit();
  }
}
?>