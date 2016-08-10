<?php 

require_once 'php/phpmorphy-0.3.7/src/common.php';/*
$request = isset($_GET['event']) ? $_GET['event'] : exit;*/

require_once( 'php/phpmorphy-0.3.7/src/common.php');
 
$dir = 'php/phpmorphy-0.3.7/dicts';
 
$lang = 'ru_RU';
 
$opts = array(
    'storage' => PHPMORPHY_STORAGE_FILE ,
    'graminfo_as_text' => TRUE
);
 
try {
    $morphy = new phpMorphy($dir, $lang, $opts);
} catch(phpMorphy_Exception $e) {
    die('Error occured while creating phpMorphy instance: ' . $e->getMessage());
}

if(isset($_POST['text'])){
	$textArray = $_POST['text'];
}else die('noData');

$speechPartArray = [];

foreach ($textArray as $word) {

	$word = mb_strtoupper($word, "UTF-8");
	$paradigms = $morphy->findWord($word);
	
	$speechPartArray[] =  ($morphy->getPartOfSpeech($word)[0]);
}

$resultPartArray = [];
$verbsCount = 0 ;

foreach ($speechPartArray as $speechType) {
	if(is_null($speechType)){
		break;
	}
	if($speechType === 'Г' || $speechType === 'ИНФИНИТИВ'){
		$verbsCount++;
	}
	$found = false;

	foreach ($resultPartArray as $obj) {
		$curIteration = isset($obj->type)? $obj->type : false;
		if($curIteration && $curIteration === $speechType){
			$obj->count = $obj->count + 1;
			$found = true;
			break;
		}
	}
	if(!$found){
		$newObj = new stdClass();
		$newObj->type = $speechType;
		$newObj->count = 1;
		$resultPartArray[]  = $newObj;
	}
}

$newObj = new stdClass();
$newObj->type = 'Глаголы';
$newObj->count = $verbsCount;
$resultPartArray[]  = $newObj;

echo json_encode($resultPartArray);
?>