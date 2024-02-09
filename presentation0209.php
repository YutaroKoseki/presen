<?php

// プログラム1

$fruits = ['apple', 'banana', 'cherry'];
$uppercaseFruits = array_map('strtoupper', $fruits);

echo 'プログラム1の結果：<br />';

print_r($uppercaseFruits);

echo '<br /><br />';

// プログラム2

$text = "私は犬が好きです";
$replacedText = str_replace("犬", "ネコ", $text);

echo 'プログラム2の結果：<br />'. $replacedText;



