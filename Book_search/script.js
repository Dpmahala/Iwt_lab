$('.search').keydown( function(){
	var valueInput = $('.search').val();
	if (valueInput.length > 0){
		$('.button').show('fast');
	} else {
		$('.button').hide('fast');
	}
});



$('.navigation').on('click', 'a', function(event){
	event.preventDefault();
	var API_KEY = 'AIzaSyB-bxs9O-i86_sUwCDugraiWvLvXW1OIBA';
    
           //AIzaSyC0OEOhH3U-8vntQRoHpzYTVouQxHHHLfQ
	var input = $('.search').val();

	$.ajax("https://www.googleapis.com/books/v1/volumes?q=" + input + "&key="+API_KEY, {
		dataType: 'json',

		beforeSend: function() {
				$('.loader').css('display', 'flex');
				$('main').css('display', 'none');
				$('.header').css('display', 'none');
		},

		complete: function() {
				$('.loader').css('display', 'none');
				$('main').css('display', 'flex');
				$('.header').css('display', 'flex');
		},

		success: function(result){

			function myRequest(request){

					var title = result.items[0].volumeInfo.title;
					var addTitle = $('.title').text(title);

					var textSnippet = result.items[0].searchInfo.textSnippet;
					var addTextSnippet = $('.textSnippet').text(textSnippet);

					var author = result.items[0].volumeInfo.authors[0];
					var addAuthor = $('.author').text(author);

					var bookThumbnail = result.items[0].volumeInfo.imageLinks.thumbnail;
					$(".thumbnail").attr('src', bookThumbnail);

					return;
			};

			myRequest(result);

		},

		error: function(error){
			alert("Sorry, but an error occurred, we will definitely fix everything :)")
		}
	});
});