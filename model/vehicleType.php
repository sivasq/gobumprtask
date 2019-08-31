<?php

class VehicleType
{
	// model properties
	private $conn;

	// constructor with $db as database connection
	public function __construct($db)
	{
		$this->conn = $db;
	}

	function read()
	{
		// select all query
		$query = "SELECT * FROM vehicle_types";
		$result = $this->conn->query($query);
		return $result;
	}
}