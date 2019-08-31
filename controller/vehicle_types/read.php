<?php
//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../../config/database.php';
include_once '../../model/vehicleType.php';

// instantiate database
$database = new Database();
$db = $database->getConnection();

// initialize services object
$vehicleTypes = new VehicleType($db);

// query Services
$response = $vehicleTypes->read();

while ($r = mysqli_fetch_assoc($response)) {
	echo '<option value="' . $r['id'] . '">' . $r['vehicle_type_name'] . '</option>';
}
