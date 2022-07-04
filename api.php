<?php

// Provides the following variables. Rename config.example.php to config.php and set the variables
// $apiKey String
// $apiVersion Int
// $imagePath String
// $apiDomain String
// $mySqlHost String
// $mySqlUser String
// $mySqlPass String
// $mySqlDatabase String
require_once('config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Process and return a JSON result from the search box
if($_POST['method'] == 'search') {

// Building and sanitizing our variables
	$term = $_POST['search'];
	$q = urlencode($term);
	$apiUrl = 'https://'.$apiDomain.'/'.$apiVersion.'/search/movie?api_key='.$apiKey.'&query='.$q;

// Getting the JSON results from the API. Could use CURL as well.
	$data = file_get_contents($apiUrl);
	$result = json_decode($data);

// Start a counter to only pass 10 entries to client. Better to stop at 10 here than in the javascript, less text to send, less data, less it costs the client on mobile.
	$i = 0;

// Start looping over the results
	foreach($result->results as $movie):

// If/Then shorthand to make sure there is always an image in our display card.
		$movie->backdrop_path ? $backdrop = $imagePath.$movie->backdrop_path : $backdrop = $imagePath.$movie->poster_path;

// Normal if statement to insert our puppy dog if no other image.
		if($backdrop == $imagePath) {
			$backdrop = 'https://allerj.com/php/images/no_image.jpg';
		}

// Get the release date ready for formatting
		$release_date = new DateTime($movie->release_date);

// Build Array of data specific for template in app.js
		$thisArray = [
			"id"		=> $movie->id,
			"title"		=> $movie->title,
			"backdrop"	=> $backdrop,
			"overview"	=> substr($movie->overview, 0, 140).'...',
			"release_date"	=> $release_date->format('M n, Y')
		];

// Format our array of arrays so jquery can read and insert it into template in app.js
		$dataArray[] = $thisArray;
		$i++;
		if($i==10) break;
	endforeach;

// To keep code clean I put database in a function and just send the term there. You'll find the function lower in this file.
	storeInDatabase($term);

// Pass the client the json data
	header('Content-Type: application/json; charset=utf-8');
	echo json_encode($dataArray);

}

//Process and return a JSON result from the details button
if($_POST['method'] == 'details') {

	$id = $_POST['id'];

	$apiUrl = 'https://'.$apiDomain.'/'.$apiVersion.'/movie/'.$id.'?api_key='.$apiKey;
	$data = file_get_contents($apiUrl);
	$movie = json_decode($data);


		$movie->poster_path ? $backdrop = $imagePath.$movie->poster_path : 'https://allerj.com/php/images/no_image.jpg';

		$release_date = new DateTime($movie->release_date);

		foreach($movie->genres as $genre){
			$genre_list[] = $genre->name;
		}

		$thisArray = [
			"id"		=> $movie->id,
			"title"		=> $movie->title,
			"poster"	=> $backdrop,
			"overview"	=> $movie->overview,
			"release_date"	=> $release_date->format('M n, Y'),
			"genre_list"	=> $genre_list
		];


	header('Content-Type: application/json; charset=utf-8');
	echo json_encode($thisArray);
}

function storeInDatabase($term)
{

// Made a fake analytics database, simply a csv. But you'll find the TODO and actual mySQL code.
	$searchTerm = filter_var($term, FILTER_SANITIZE_STRING);
	$searchDate = date("Y-m-d H:i:s");
	$searchIp = $_SERVER['REMOTE_ADDR'];

	$myfile = fopen("fakeDb.csv", "a") or die("Unable to open file!");
	$txt = $searchTerm.", ".$searchIp.", ".$searchDate."\n";
	fwrite($myfile, $txt);
	fclose($myfile);


// TODO;
//
// 	$conn = mysqli_connect($mySqlHost, $mySqlUser, $mySqlPass, $mySqlDatabase);
// 	if (!$conn) {
// 	  	die("Connection failed: " . mysqli_connect_error());
// 	}
// 	$sql = 'INSERT INTO searches (term, ip, created_at) VALUES ('.$searchTerm.', '.$searchIp.', '.$searchDate.')';
// 	mysqli_query($conn, $sql);
// 	mysqli_close($conn);

//	FAKE STORE



}

