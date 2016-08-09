<?php 

$text = isset($_POST['text']) ? ($_POST['text']) : ('Нет входящих данных');
echo $text.'<br>';
require_once 'php/phpmorphy-0.3.7/src/common.php';/*
$request = isset($_GET['event']) ? $_GET['event'] : exit;*/

// Подключите файл common.php. phpmorphy-0.3.2 - для версии 0.3.2,
// если используется иная версия исправьте код.
require_once( 'php/phpmorphy-0.3.7/src/common.php');
 
// Укажите путь к каталогу со словарями
$dir = 'php/phpmorphy-0.3.7/dicts';
 
// Укажите, для какого языка будем использовать словарь.
// Язык указывается как ISO3166 код страны и ISO639 код языка, 
// разделенные символом подчеркивания (ru_RU, uk_UA, en_EN, de_DE и т.п.)
 
$lang = 'ru_RU';
 
// Укажите опции
// Список поддерживаемых опций см. ниже
$opts = array(
    'storage' => PHPMORPHY_STORAGE_SHM,
);
 
// создаем экземпляр класса phpMorphy
// обратите внимание: все функции phpMorphy являются throwable т.е. 
// могут возбуждать исключения типа phpMorphy_Exception (конструктор тоже)

try {
    $morphy = new phpMorphy($dir, $lang, $opts);
} catch(phpMorphy_Exception $e) {
    die('Error occured while creating phpMorphy instance: ' . $e->getMessage());
}

$word = 'ДУША';
if(false === ($paradigms = $morphy->findWord($word))) {
    die('Can`t find word');
}
 
// получить только существительные можно при помощи
foreach($paradigms->getByPartOfSpeech('С') as $paradigm) {
    echo 'Существительное ', $paradigm->getBaseForm(), PHP_EOL;
}

?>