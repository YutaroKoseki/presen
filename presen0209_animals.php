<?php

$obj = '';


// 血液型用オブジェクト
class Animal{

    //  プロパティ
    protected $name;
    protected $type;
    protected $level;
    protected $image;

    // コンストラクタ
    public function __construct($name, $type, $level,$image){
        $this->name = $name;
        $this->type = $type;
        $this->level = $level;
        $this->image = $image;
    }

    // ゲッター
    public function getName(){
        return $this->name;
    }

    public function getType(){
        return $this->type;
    }

    public function getlevel(){
        return $this->level;
    }

    public  function getImage(){
        return $this->image;
    }

}

// インスタンスの生成
$animals[] = new Animal('ねこ', 'ぬこ', 'かわいい', './images/cat.jpeg');
$animals[] = new Animal('いぬ', 'いっぬ', 'もふ。', './images/dog.jpeg');
$animals[] = new Animal('ペンギン', 'とり', 'かわいい', './images/penguin.jpeg');
$animals[] = new Animal('ライオン', 'ぬこ', 'まぁ。', './images/rion.jpeg');
$animals[] = new Animal('トラ', 'ぬこ', 'かっこいい', './images/tiger.jpeg');
$animals[] = new Animal('オオカミ', 'いっぬ', 'かっこいい', './images/wolf.jpeg');
$animals[] = new Animal('カラス', 'とり', 'まぁ。', './images/crow.jpeg');


// 処理

if(isset($_POST['randomAnimals'])){
    global $animals;

    $rand = mt_rand(0,6);
    $obj = $animals[$rand];

    //print_r($obj);
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
    <title>animals</title>
</head>
<body>



<h2 class="c-title">
    <?php if($obj == ''):?>
        トラを当てるまで帰れません。
    <?php elseif($obj->getName() !== 'トラ'):?>
        違います。もう一回やりましょう。
    <?php else:?>
        おめでとう！優勝です！
    <?php endif; ?>

</h2>

<?php if(isset($_POST['randomAnimals'])):?>
<div class="p-animal">
    <div class="p-animal__image">
        <img src="<?php echo $obj->getImage()?>" class="p-animal__image--item">
    </div>
    <p class="p-animal__name">名前：<?php echo $obj->getName(); ?></p>
    <p class="p-animal__type">タイプ：<?php echo $obj->getType(); ?></p>
    <p class="p-animal__level">評価：<?php echo $obj->getlevel(); ?></p>
</div>
<?php endif;?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <input type="hidden" name="randomAnimals">
    <input type="submit" value="ランダム生成" class="p-animal__submit c-submit">
</form>
</body>
</html>
