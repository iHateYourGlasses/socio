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
        displayResults(response, wordsArray);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(jqXHR);
      }
    })
}
function displayResults(data, origArray) {
  
  var allAvgCount = 0;

    data.forEach(function(item, i, data) {

      if((item['type'] !== 'Глаголы') &&(item['type'] !== 'Местоимения_1_лица')){
        allAvgCount += item['count']*1;
      }
      
    });
    console.log(allAvgCount);

    data.forEach(function(item, i, data) {

      if(item['type'] === 'Глаголы'){

        $('.verbsCount').text(item['count']);

        let verbsPercent = (item['count'] / origArray.length * 100).toFixed(2) + '%';
        $('.verbsPercent').text(verbsPercent);

        let verbsAvgPercent = (item['count'] / allAvgCount * 100).toFixed(2) + '%';
        $('.verbsAvgPercent').text(verbsAvgPercent);

      }
      
    });

}