<?php
//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../../config/database.php';
include_once '../../model/services.php';

// instantiate database
$database = new Database();
$db = $database->getConnection();

// initialize services object
$services = new Services($db);

$city = isset($_POST['city']) ? $_POST['city'] : '';
$service = isset($_POST['service']) ? $_POST['service'] : '';
$vType = isset($_POST['vType']) ? $_POST['vType'] : '';

if ($city != '' || $vType != '') {
	// query Services
	$response['success'] = true;
	$response['data'] = $services->read();
} else {
	$response['success'] = false;
}

echo json_encode($response);