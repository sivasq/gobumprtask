<?php
//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../../config/database.php';
include_once '../../model/city.php';

// instantiate database
$database = new Database();
$db = $database->getConnection();

// initialize services object
$cities = new City($db);

// query Services
$response = $cities->read();

while ($r = mysqli_fetch_assoc($response)) {
	//	$rows[] = $r;
	echo '<option value="' . $r['id'] . '">' . $r['city_name'] . '</option>';
}
