
<?php
//やること

//　・電卓風にするか。jsが必要かな
//　・getDateはやめてビンゴを作る
//　・パスワードはバリデーションしてエラーメッセージを表示する


// 変数定義
$msg = '';
$test = '';

// 定数定義
const PROGRAM01 = 'breakEvenPoint';
const PROGRAM02 = 'getDate';
const PROGRAM03 = 'getLength';
const PROGRAM04 = 'passHash';




// 関数定義


// ① 計算用（標準関数：isset()）
function breakEvenPoint(){

    $profit = isset($_POST['profit'])? $_POST['profit'] : 0; // 入力されていればそれ、なければ０
    $cost = isset($_POST['cost'])? $_POST['cost'] : 0; //　同上
    $result = $profit - $cost;

    if($result < 0){
        return '赤字です。何が悪いか見直しましょう';
    }elseif($result === 0){
        return 'トントンですけど。そんなことある？';
    }else{
        return '黒字です。これからも頑張りましょう！';
    }
}

// ② 日付取得（標準関数：date()）
function getNowDate(){

    // 現在の日付を返すだけの単純な処理
    return date("Y年m月d日 H時i分s秒"); // date()のフォーマットは「Y-m-d H:i:s」
}




// ④ 文字数（標準関数：mb_strlen()）
function getLength(){

    $strLength = mb_strlen($_POST['length']); // mb_strlen()で中身の長さを取得し返す

    return "あなたが入力した文字数は".$strLength."文字です。";
}


// ⑤ パスワードハッシュ（標準関数：password_hash(),password_verify()）
function passwordHash(){

    $pass = $_POST['pass']; // $_POST[]はPOST送信されたもの、'pass'とすることで$_POSTのvalue = 'pass'のものという意味に

    $hashedPass = password_hash($pass, PASSWORD_DEFAULT); // password_hash(引数1、引数2)で引数1を引数2の方法を用いてハッシュ化



    // hash化後のパスワードとパスワードが合っているか確認
    if(password_verify($pass, $hashedPass)){ // password_verify(引数1、引数2)でハッシュ化されたものと自動で比較できる

        return "パスワードは一致しています(そりゃ合うんですけどね。)". '</br>' ."ハッシュ化されたパス：". $hashedPass;

    }else{

        return "エラーが発生しました。";
    }
}



// ============= 実際の処理 ==============

// POSTかどうか判別
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // 何をリクエストされたか判別
    if(isset($_POST['action'])){
        // switch文用の変数を定義
        $select = $_POST['action'];

        switch ($select){

            // 損益分岐点計算の場合
            case PROGRAM01:
                $msg = breakEvenPoint();
            break;

            // 日付取得処理の場合
            case PROGRAM02:
                $msg = getNowDate();
            break;

            // 文字数
            case PROGRAM03:
                $msg = getLength();
            break;

            // パスワードハッシュ
            case PROGRAM04:
                $msg = passwordHash();
            break;

        }
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
  <h1 class="p-messlevel"><?php echo ($msg == '')? "ここが変わります": $msg; ?></h1>

  <div class="p-wrapper">
      <!--   計算用   -->
      <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" class="p-break c-form">
          <h3 class="p-date__title c-title">損益から赤字/黒字を計算します</h3>
          <!--   隠してactionを取得するだけ   -->
          <input type="hidden" name="action" value="breakEvenPoint">
          <label for="profit" class="c-label">収入</label>
          <input name="profit" id="profit" type="text" class="p-break__input p-break__input--profit c-input" placeholder="収入を入力してください" value="<?php echo isset($_POST['profit'])? $_POST['profit']: ''; ?>" required>

          <label for="cost" class="c-label">支出</label>
          <input name="cost" id="cost" type="text" class="p-break__input p-break__input--cost c-input" placeholder="支出を入力してください" value="<?php echo isset($_POST['cost'])? $_POST['cost']: ''; ?>" required>

          <input type="submit" class="p-break__submit c-submit" value="計算する">
      </form>

      <!--   日付表示用   -->
      <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" class="p-date c-form">
          <h3 class="p-date__title c-title">ボタンを押したタイミングの日時を表示します</h3>
          <!--   隠してactionを取得するだけ   -->
          <input type="hidden" name="action" value="getDate">
          <p class="c-text">現在の日時を表示します。</p>
          <input type="submit" class="p-date__submit c-submit" value="表示する">
      </form>


      <!--   文字の長さ判別   -->
      <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" class="p-length c-form">
          <h3 class="p-length__title c-title">文字列の長さを計算します</h3>
          <!--   隠してactionを取得するだけ   -->
          <input type="hidden" name="action" value="getLength">

          <p class="c-text">ここに入力した文字の長さを測ります。</p>
          <textarea name="length" id="" cols="30" rows="10" placeholder="ここに入力してね" class="p-length__input c-textarea" value="" required></textarea>
          <input type="submit" class="p-length__submit c-submit" value="文字数を計算する！">
      </form>


      <!--   パスワードハッシュ   -->
      <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" class="p-pass c-form">
          <h3 class="p-pass__title c-title">パスワードをハッシュ化します</h3>
          <!--   隠してactionを取得するだけ   -->
          <input type="hidden" name="action" value="passHash">

          <p class="c-text">パスワードを入力してください</p>
          <input type="password" name="pass" value="" placeholder="英数字8文字以上で入力してください" class="p-pass__input c-input" required>
          <input type="submit" class="p-pass__submit c-submit" value="ハッシュ化する">
      </form>

  </div>


</body>
</html>
