$(document).ready(function() {

	countWords();

  $("#textMainArea").on('keyup', function() {

  	countWords();

  });
 
}); 

function countWords() {

    wordsArray =  ($("#textMainArea").val().match(/\S+/g)) || [];

    negativeArray = [];

    wordsArray.forEach(function(item, i, wordsArray) {

      item = item.replace(/[.,\/#!$%\^&\*;:{}=\-_`~()"']/g,"");
      wordsArray[i] = item;

    });
      console.log(wordsArray);

   		var wordsLength = wordsArray.length;
   		$('.wordCount').text(wordsLength);

    $.ajax({
      url: 'json.php?event=getTextData',
      type: "POST",
      dataType: "json",
      data:{
      text: wordsArray
      },
      success: function (response) {
        console.log(response);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(jqXHR);
      }
    })
}