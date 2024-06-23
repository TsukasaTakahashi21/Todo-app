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
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $password = isset($_POST['password']) ? $_POST['password'] : '';

  if (empty($email) || empty($password)) {
    $errors[] = 'パスワードとメールアドレスを入力してください';
  }

  $sql = 'SELECT * FROM users WHERE email = :email';
  $statement = $pdo->prepare($sql);
  $statement->bindValue(':email', $email, PDO::PARAM_STR);
  $statement->execute();
  $user = $statement->fetch(PDO::FETCH_ASSOC);

  if (!$user || !password_verify($password, $user['password'])) {
    $errors[] = 'メールアドレスまたはパスワードが違います';
    $_SESSION['errors'] = $errors;
    header('Location: ./signin.php');
    exit();
  } else {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['name'];
      header('Location: ../index.php');
      exit();
  }
}
?>