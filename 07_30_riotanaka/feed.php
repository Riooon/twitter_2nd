<?php

session_start();

$_SESSION['email'] = $_POST["email"];
$email = $_SESSION['email'];

$_SESSION['password'] = $_POST["password"];
$password = $_SESSION['password'];

$email_updated = $_SESSION['email_updated'];

// session を使った認証処理をしたい（あとでできたら）
// if($email != ""){
//     $_SESSION["ssid"] = session_id();
// } else {
//     header("Location: index.php");
// }


//2. DB接続します（11行目以外は基本同じなので、使用する時はコピペでOK）
try {
  $pdo = new PDO('mysql:dbname=twitter_db;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO twitter_account (id,email,password)VALUES (NULL,:a1,:a2)");

$stmt->bindValue(':a1', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $password, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();


//ツイート内容を取得するPDOの記述
$stmt = $pdo->prepare("SELECT * FROM tweet_contents ORDER BY id DESC"); //MySQL内の全部のデータを取得
$status = $stmt->execute();

//データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .= "<div class='tweet-card'>";
        $view .= "<div class='picture'>";
            $view .= "<img src='img/profile.jpg'>";
        $view .= "</div>";
        $view .= "<div class='text'>";
            $view .= "<div class='info'>";
                $view .= "<h4>Rio</h4>";
                $view .= "<p>@riodelion</p>";
            $view .= "</div>";
            $view .= "<div class='description'>";
            $view .= $result['tweet'];
            $view .= "</div>";
            $view .= "<div class='reaction'>";
                $view .= "<i class='far fa-comment'></i>";
                $view .= "<i class='fas fa-retweet'></i>";
                $view .= "<i class='far fa-heart'></i>";
                $view .= "<i class='fas fa-external-link-alt'></i>";
                $view .= "<i class='far fa-chart-bar'></i>";
            $view .= "</div>";
        $view .= "</div>";
    $view .= "</div>";
  }
}

//ユーザー情報内容を取得するPDOの記述
$stmt = $pdo->prepare("SELECT * from twitter_account WHERE email = :a12"); //MySQL内の全部のデータを取得
$stmt->bindValue(':a12', $_POST["email"], PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//データ表示
$review="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $review .= $result['email'];
}
}

// ログイン処理、ユーザー情報の登録・表示をしたかったのですが上手くできず、この部分を来週行います。

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitter</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/feed.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>
    <div class="left">
        <div class="icon"><i class="fab fa-twitter"></i></div>
        <ul class="list-entire">
            <li><i class="fas fa-home"></i>Home</li>
            <li><i class="fas fa-hashtag"></i>Explore</li>
            <li><i class="far fa-bell"></i>Notifications</li>
            <li><i class="far fa-envelope"></i>Messages</li>
            <li><i class="far fa-bookmark"></i>Bookmarks</li>
            <li><i class="far fa-list-alt"></i>Lists</li>
            <li><i class="fas fa-user-alt"></i>Profile</li>
            <li class="settings-action"><i class="fas fa-sliders-h"></i>Settings</li>
        </ul>

        <div class="tweet">
            <a href="#">Tweet</a>
        </div>
    </div>

    <div class="center">
        <div class="center-fixed">
            <div class="arrow">
                <i class="fas fa-arrow-left"></i>
            </div>
            <div class="names">
                <h4>Rio</h4>
                <p>0 tweets</p>
            </div>
        </div>
        <div class="center-profile">
            <div class="center-pic">
                <img src="img/profile.jpg" alt="">
            </div>
            <div class="profile-box">
                <div class="edit-profile">
                    <a href="#" class="settings-action">Edit profile</a>
                </div>
                <div class="profile-name">
                    <h3>Rio</h3>
                    <p>@riodelion</p>
                </div>
                <div class="profile-tagline">
                    <p>すもももももももものうち。</p>
                </div>
                <div class="profile-info">
                    <ul>
                        <li><i class="fas fa-map-marker-alt"></i>Tokyo-to, Japan</li>
                        <li><i class="fas fa-link"></i>rio.tanaka.jp</li>
                        <li><i class="fas fa-golf-ball"></i>Born December 30, 1997</li>
                        <li><i class="far fa-calendar-alt"></i>Joined March 2020</li>
                    </ul>
                </div>
                <div class="profile-follows">
                    <h4><span>0</span> following</h4>
                    <h4><span>0</span> followers</h4>
                </div>
            </div>
            
            <div class="tweet-list">
                <ul>
                    <li>Tweets</li>
                    <li>Tweets & replies</li>
                    <li>Media</li>
                    <li>Likes</li>
                </ul>
            </div>
        </div>

            <div><?php echo $view ?></div>


        <div class="popup">
            <div class="popup-form">
                <form method="get" action="tweet.php">
                    <div class="popup-top">
                        <i class="fas fa-times"></i>
                    </div>
                    <div class="popup-middle">
                        <img src="img/profile.jpg" alt="">
                        <textarea name="tweet" id="" cols="30" rows="7" placeholder="What's happening?"></textarea>
                    </div>
                    <div class="popup-bottom">
                        <div class="logo">
                            <i class="far fa-image"></i>
                            <i class="fab fa-github"></i>
                            <i class="fas fa-poll"></i>
                            <i class="far fa-smile"></i>
                            <i class="fas fa-business-time"></i>
                        </div>
                        <input type="submit" value="Tweet">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="right">
         <div class="settings">
             <div class="title">
                <i class="fas fa-times settings-end"></i>
                <p>Settings</p>
             </div>

            <form method="post" action="update.php">
                <details>
                    <summary>Email</summary>
                    <input type="text" name="email_updated">

                </details>
                <details>
                    <summary>Password</summary>
                    <input type="password" name="password_updated">
                </details>
                <details>
                    <summary>Name</summary>
                    <input type="text" name="name">
                </details>
                <details>
                    <summary>Username</summary>
                    <input type="text" name="username">
                </details>
                <input type="submit" value="変更する" class="submit">
            </form>

        </div>
    </div>

<!-- ここからJavascript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(".tweet").on("click", function(){
    $(".popup").fadeIn();
});

$(".popup-top i").on("click", function(){
    $(".popup").fadeOut();
});

// $(".popup-middle textarea").focus();

$(".settings-action").on("click", function(){
    $(".settings").css("display", "block");
});
$(".settings-end").on("click", function(){
    $(".settings").css("display", "none");
});


</script>
</body>
</html>