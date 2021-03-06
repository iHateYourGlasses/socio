﻿<DOCTYPE HTML>
<HTML>
<head>

  <meta charset="utf-8">

	<link href="css/main.css" rel="stylesheet" type="text/css"/>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

</head>
<body>
	<div class='container'>
		<div class="row">
			<h3 class='text-center'>Введите ваш текст</h3>
			<form>
			  <div class="form-group">
			    <label for="textMainArea">Текст:</label>
 				 	<textarea class="form-control" rows="10" id="textMainArea">"Я клоп и признаю со всем принижением, что ничего не могу понять, для чего все так устроено. Люди сами, значит, виноваты: им дан был рай, они захотели свободы и похитили огонь с небеси, сами зная, что станут несчастны, значит нечего их жалеть. О, по моему, по жалкому, земному эвклидовскому уму моему, я знаю лишь то, что страдание есть, что виновных нет, что все одно из другого выходит прямо и просто, что все течет и уравновешивается, - но ведь это лишь эвклидовская дичь, ведь я знаю же это, ведь жить по ней я не могу же согласиться! Что мне в том, что виновных нет и что все прямо и просто одно из другого выходит, и что я это знаю - мне надо возмездие, иначе ведь я истреблю себя. И возмездие не в бесконечности где-нибудь и когда-нибудь, а здесь уже на земле, и чтоб я его сам увидал. Я веровал, я хочу сам и видеть, а если к тому часу буду уже мертв, то пусть воскресят меня, ибо если все без меня произойдет, то будет слишком обидно. Не для того же я страдал, чтобы собой, злодействами и страданиями моими унавозить кому-то будущую гармонию. Я хочу видеть своими глазами, как лань ляжет подле льва и как зарезанный встанет и обнимется с убившим его. Я хочу быть тут, когда все вдруг узнают, для чего все так было."
Федор Михайлович Достоевский
 				 	</textarea>
			  </div>
				<button type="submit" class="btn btn-default">Submit</button>
			</form>
		</div>
		<div class='row'>
		<span>Количество слов: <span class='wordCount'></span></span><br>
		<span>Количество отрицаний: <span class='negCount'></span></span><span>, процент отрицаний: <span class='negPercents'></span></span><br>
		<span>Пойманные слова - отрицания: <span class='catchedNeg'></span></span><br>
		<span>Количество глаголов: <span class="verbsCount"></span>, процент: <span class="verbsPercent"></span>, процент усредненный: <span class="verbsAvgPercent"></span></span>
		</div>
	</div>
</body>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"  crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/run.js"></script>

</HTML>