var worsArray = [];
var exceptionArray = ['невест', 'неожид', 'нее', 'неё', 'некот', 'ниж', 'ник', 'нейтр', 'негр', 'нищ'];
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

      var testForExceptions = true;

      for(i=0; i< exceptionArray.length; i++){
       //поиск исключений

        var curIteration = exceptionArray[i];
        var exc = item.toLowerCase().search(curIteration);
        if(exc > -1){
          testForExceptions = false;
        }
      }

      if(testForExceptions){
        var curEl = item.search( /^н[е,и]/i );  //поиск отрицаний
        if(curEl > -1){
          negativeArray[negativeArray.length] = item;
        }

      }
    });

    $('.catchedNeg').empty();

    negativeArray.forEach(function(item, i, negativeArray){

      $('.catchedNeg').append(item+'; ');

    })

    console.log(negativeArray);

   		var wordsLength = wordsArray.length;
   		$('.wordCount').text(wordsLength);

      var negLength = negativeArray.length;
      $('.negCount').text(negLength);

      var negPercents = (+negLength / +wordsLength * 100);
      $('.negPercents').text(negPercents.toFixed(2)+' %');


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