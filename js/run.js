var worsArray = [];
$(document).ready(function() {

  $("#textMainArea").on('keyup', function() {

  	wordsArray = this.value.match(/\S+/g);

  	console.log();

    if(wordsArray){

   		var wordsLength = wordsArray.length;
   		$('.wordCount').text(wordsLength);

  	}

  	else $('.wordCount').text('0');

  });
 
}); 