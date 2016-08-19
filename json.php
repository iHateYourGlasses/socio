<?php 

mb_internal_encoding("UTF-8");

if(isset($_POST['text'])){
	$textArray = $_POST['text'];
}else /*die('noData');*/ $textArray = ["Я","клоп","и","признаю","со","всем","принижением","что","ничего","не","могу","понять","для","чего","все","так","устроено","Люди","сами","значит","виноваты","им","дан","был","рай","они","захотели","свободы","и","похитили","огонь","с","небеси","сами","зная","что","станут","несчастны","значит","нечего","их","жалеть","О","по","моему","по","жалкому","земному","эвклидовскому","уму","моему","я","знаю","лишь","то","что","страдание","есть","что","виновных","нет","что","все","одно","из","другого","выходит","прямо","и","просто","что","все","течет","и","уравновешивается","","но","ведь","это","лишь","эвклидовская","дичь","ведь","я","знаю","же","это","ведь","жить","по","ней","я","не","могу","же","согласиться","Что","мне","в","том","что","виновных","нет","и","что","все","прямо","и","просто","одно","из","другого","выходит","и","что","я","это","знаю","","мне","надо","возмездие","иначе","ведь","я","истреблю","себя","И","возмездие","не","в","бесконечности","гденибудь","и","когданибудь","а","здесь","уже","на","земле","и","чтоб","я","его","сам","увидал","Я","веровал","я","хочу","сам","и","видеть","а","если","к","тому","часу","буду","уже","мертв","то","пусть","воскресят","меня","ибо","если","все","без","меня","произойдет","то","будет","слишком","обидно","Не","для","того","же","я","страдал","чтобы","собой","злодействами","и","страданиями","моими","унавозить","комуто","будущую","гармонию","Я","хочу","видеть","своими","глазами","как","лань","ляжет","подле","льва","и","как","зарезанный","встанет","и","обнимется","с","убившим","его","Я","хочу","быть","тут","когда","все","в","друг","узнают","для","чего","все","так","было","Федор","Михайлович","Достоевский","убить","кричать","знать"];

require_once('php/phpmorphy-0.3.7/src/common.php');
 
require_once 'php/phpmorphy-0.3.7/src/common.php';

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

$speechPartArray = [];
$onlyParts = [];

foreach ($textArray as $word) {

	$word = mb_strtoupper($word, "UTF-8");
	$paradigms = $morphy->findWord($word);
	
	$speechPart = ($morphy->getPartOfSpeech($word));

	$newObj = new stdClass();
	$newObj->word = $word;

	if(is_array($speechPart)){

		$newObj->speechPart = $speechPart;
		foreach ($speechPart as $value) {
			$onlyParts[] = $value;
		}
	}
	else $newObj->speechPart = ['false'];
	$speechPartArray[] = $newObj;
}

$resultPartArray = [];
$verbsCount = 0;
//выделение глаголов и общих данны
foreach ($onlyParts as $speechType) {

	if(is_null($speechType)){
		continue;
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
			continue;
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

//выделение личных местоимений 1 лица
$selfWordsCount = 0;
foreach ($textArray as $word) {

	$word = mb_strtoupper($word, "UTF-8");

	if (in_array($word, array("Я", "МЕНЯ", "МНЕ", "МНОЙ", "МНОЮ"))){
		$selfWordsCount++;
	}
}

$newObj = new stdClass();
$newObj->type = 'Местоимения_1_лица';
$newObj->count = $selfWordsCount;
$resultPartArray[]  = $newObj;

//выделение отрицаний

$rawNegatives = [];
$trueNegatives = [];
foreach ($textArray as $word) {
	$word = mb_strtolower($word, "UTF-8");

	if (in_array($word, array("не", "нет", "ни"))){
		$trueNegatives[] = $word;
		continue;
	}
	
	$pattern = '/^н[еи]/u' ;
	$try = preg_match($pattern, $word);
	if($try){
		$rawNegatives[] = $word;
	}

}
$test = [];
foreach ($rawNegatives as $value) {
	$word = $value;
	$word[0] = '';
	$word[0] = '';
	$test[] = $word;
	//$speechPart = ($morphy->getPartOfSpeech($word));
}

echo json_encode($test);
?>