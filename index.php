<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Search</title>

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<!-- Bootstrap via CDN -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- Bootstrap Icons -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
<!-- Our custom classes to override Bootstrap -->
		<link href="css/style.css" rel="stylesheet">
<!-- JQuery via CDN -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


		<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

	</head>
	<body>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-sm-8 text-center my-5 py-5">
					<h1>Movie Search</h1>
				</div>
				<div class="col-sm-8">
					<form method="post" id="search-form">
						<div class="input-group mb-3">
							<input type="text" class="form-control" placeholder="Search Term" aria-label="Search term" aria-describedby="search-button" name="search" id="search">
							<button class="btn btn-outline-primary" type="submit" id="search-button">
								<i class="bi bi-search"></i>
							</button>
						</div>
					</form>
				</div>
			</div>
			<div class="row justify-content-around" id="movie-card-row">

			</div>
		</div>
		<div class="loading-holder mt-5">
			<div class="d-flex justify-content-center">
				<div class="spinner-grow text-primary" role="status">
					<span class="visually-hidden">Loading...</span>
				</div>
			</div>
		</div>
<!-- Modal for More Details -->
	<div class="modal fade" id="details-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg	">
			<div class="modal-content">
				<div class="modal-body">
					<div class="container">
						<div class="row">
							<div class="col-4">
								<img src="" id="poster_image">
							</div>
							<div class="col-8">
								<h4 id="modalTitle"></h4>
								<p id="release_date"></p>
								<p id="overview"></p>

							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer flex justify-content-between">
					<div id="genreList"></div>
					<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
<!-- Bootstrap JS via CDN -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- Custom JS for this tool -->
		<script src="js/app.js"></script>
	</body>
</html>
