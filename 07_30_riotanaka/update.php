<?php
session_start();

$email = $_SESSION['email'];
echo $email;

$email_updated = $_POST["email_updated"];
$password_updated = $_POST["password_updated"];
$username = $_POST["username"];
$name = $_POST["name"];

$_SESSION['email_updated'] = $POST['email_updated'];


//2. DB接続します（11行目以外は基本同じなので、使用する時はコピペでOK）
try {
    $pdo = new PDO('mysql:dbname=twitter_db;charset=utf8;host=localhost','root','root');
  } catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());
  }

$stmt = $pdo->prepare("UPDATE twitter_account SET email=:a3, password=:a4, username=:a6, name=:a7 where email=:a5");
$stmt->bindValue(':a3', $email_updated, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a4', $password_updated, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a6', $username, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a7', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a5', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

header('Location: feed.php');

?>