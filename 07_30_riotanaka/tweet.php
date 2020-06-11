<?php

// email情報と結び付けて、tweet_contentsのSQLテーブルの中からアカウントに紐づくツイートだけを引っ張りたい。（あとでできたら）
// $latest_email = $_SESSION['email'] || $_SESSION['email_updated'];
// echo $latest_email;

$tweet = $_GET["tweet"];

//2. DB接続します（11行目以外は基本同じなので、使用する時はコピペでOK）
try {
  $pdo = new PDO('mysql:dbname=twitter_db;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO tweet_contents (tweet,id,indate)VALUES (:tweet,id,now())");

$stmt->bindValue(':tweet', $tweet, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

header("Location: feed.php");
?>