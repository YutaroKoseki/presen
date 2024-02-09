<?php

// 変数
$msg = '';
$errMsg = [];

// 定数
define('ERR01', '入力必須です');
define('ERR02', '半角英数字で8文字以上必要です');
define('ERR03', '最低でも1つ以上の大文字が必要です');
define('ERR04', '半角英数字のみご利用いただけます');

($_POST['password']);

// 関数

function validPass($str, $key){
    global $errMsg;

    // 空かどうか
    if($str == ''){
        return ERR01;
    }
}

function validRequired($str, $key){
    global $errMsg;
    // 空だった場合
    if($str === ''){
        return $errMsg[$key] = ERR01;
    }
}

function validMinLength($str, $key, $min){
    global $errMsg;
    if(mb_strlen($str) < $min){
        return $errMsg[$key] = ERR02;
    }
}

function validUpper($str, $key){
    global $errMsg;
    if(!preg_match('@[A-Z]@', $str)){
        return $errMsg[$key] = ERR03;
    }
}

function validHalf($str, $key){
    global $errMsg;
    if(!preg_match('@^[a-zA-Z0-9]+$@', $str)){
        return $errMsg[$key] = ERR04;
    }
}


// 処理

// POST送信された場合
if(!empty($_POST['password'])){
    $password = $_POST['password'];
    
    validRequired($password, 'password');
    validMinLength($password, 'password', 8);
    validUpper($password, 'password');
    validHalf($password, 'password');

    // エラーがない場合
    if(empty($errMsg)){
        password_hash($password, PASSWORD_DEFAULT);
        // 保存したテイで。。。
        $msg = 'パスワードを保存しました！';
    }
}


?>

<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Presentation01</title>
</head>
<body>
  <h1 class="p-message"><?php echo ($msg == '')? "ここが変わります": $msg; ?></h1>

  <div class="p-wrapper">


      <!--   パスワードハッシュ   -->
      <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" class="p-pass c-form">
          <h3 class="p-pass__title c-title">パスワードをバリデーション後ハッシュ化して保存します。</h3>

          <p class="c-text">パスワードを入力してください</p>
          <input type="password" name="password" value="" placeholder="半角英数字8文字以上で入力してください" class="p-pass__input c-input">
          <input type="submit" class="p-pass__submit c-submit" value="登録する！">
          <p class=""><?php echo (!empty($errMsg['password']))? $errMsg['password']: ''; ?></p>
      </form>

  </div>


</body>
</html>
