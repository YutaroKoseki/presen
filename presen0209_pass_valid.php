<?php

// 変数
$msg = '';
$errMsg = [];

// 定数
define('ERR01', '入力必須です');
define('ERR02', '半角英数字で8文字以上必要です');
define('ERR03', '最低でも1つ以上の大文字が必要です');
define('ERR04', '半角英数字のみご利用いただけます');



// 関数

function validPass($str){

    // 空かどうか
    if($str == ''){
        return ERR01;
    }

    // 文字数チェック
    if(mb_strlen($str) < 8){
        return ERR02;
    }

    // 大文字を含むか
    if(!preg_match('@[A-Z]@', $str)){
        return ERR03;
    }

    // 半角英数字のみ
    if(!preg_match('@^[a-zA-Z0-9]+$@', $str)){
        return ERR04;
    }

    return '';
}


// 処理

// POST送信された場合
if(isset($_POST['password'])){
    $pass = $_POST['password'];

    // バリデーション
    $error = validPass($pass);

    if ($error !== '') {
        $errMsg['password'] = $error;
    } else {
        // エラーがない場合、パスワードをハッシュ化して保存（デモのため保存処理は省略）
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
  <h1 class="p-message<?php echo ($msg == '')? '' : '__success'?>"><?php echo ($msg == '')? '': $msg; ?></h1>

  <div class="p-wrapper">


      <!--   パスワードハッシュ   -->
      <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" class="p-pass c-form">
          <h3 class="p-pass__title c-title">パスワードをバリデーション後ハッシュ化して保存します。</h3>

          <p class="c-text">パスワードを入力してください</p>
          <input type="password" name="password" value="" placeholder="半角英数字8文字以上で入力してください" class="p-pass__input c-input">
          <p class="p-error"><?php echo (!empty($errMsg['password']))? $errMsg['password']: ''; ?></p>

          <input type="submit" class="p-pass__submit c-submit" value="登録する！">
      </form>

  </div>


</body>
</html>
