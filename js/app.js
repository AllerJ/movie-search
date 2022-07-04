// Useing jQuery to listen for the form to be submitted and process the ajax request.

$(function(){
	$('#search-form').submit( function(e){
		// Let the client know something is happening while our api queries MovieDatabase API.
		$('.loading-holder').show();
		// Don't let the form submit
		e.preventDefault();
		// Make our ajax call as a post with the data from the search form
		$.ajax({
  		url: "api.php",
		method: "Post",
		data: {
			method : 'search',
			search : $('#search').val()
		},
  		}).done(function( data ) {
		  // hide the loader
		  $('.loading-holder').hide();
		  // use the template below to build each card and append it to the HTML of the #movie-card-now div
		  $('#movie-card-row').html(data.map(Card).join(''));
		});
	});
});


// Use traditional javascript with "OnClick=" in the link.
function showMore(id){
	// Back to jQuery though
	$('.loading-holder').show();
	$.ajax({
  	url: "api.php",
	method: "Post",
	data: {
		method : 'details',
		id : id
	},
  	}).done(function( data ) {

		// With valid data we start a bootstrap modal to hold our data.
		var myModal = new bootstrap.Modal(document.getElementById('details-modal'), {
  			keyboard: true
		});

		// Prepare the json data into strings to be placed in the modal at appropriate places.
		var genres = data.genre_list.toString();
		genres = genres.replace(/\,/g, ", ")
		$('#modalTitle').text(data.title);
		$('#overview').text(data.overview);
		$('#genreList').text('Categories: ' + genres);
		$('#poster_image').attr("src", data.poster);
		$('#release_date').text('Released On: '+ data.release_date);

		// Show the modal
		myModal.show();
	});

}


const Card = ({ backdrop, title, overview, id, release_date }) => `
<div class="card col-md-3 px-0 mt-2 mx-4" id="movie-${id}">
	<img src="${backdrop}" class="card-img-top cropped" alt="Backdrop image of ${title}">
	<div class="card-body d-flex flex-column ">
		<h5 class="card-title">${title}</h5>
		<small>Released On: ${release_date}</small>
		<p class="card-text flex-grow-1 mt-2">${overview}</p>
		<a href="#" class="btn btn-outline-primary more-button" onclick="showMore(${id})">Find Out More</a>
	</div>
</div>
`;


