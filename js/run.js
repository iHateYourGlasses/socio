var worsArray = [];
$(document).ready(function() {

	countWords();

  $("#textMainArea").on('keyup', function() {

  	countWords();

  });
 
}); 

function countWords() {

  	wordsArray =  $("#textMainArea").val().match(/\S+/g);

    if(wordsArray){

   		var wordsLength = wordsArray.length;
   		$('.wordCount').text(wordsLength);

  	}

  	else $('.wordCount').text('0');

}