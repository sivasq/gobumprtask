<?php

class Services
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
		$city = $_POST['city'];
		$service = $_POST['service'];
		$vType = $_POST['vType'];

		$query = "SELECT * FROM services s LEFT JOIN city_has_services csh ON s.id = csh.service WHERE s.vehicle_type = " . $vType . " AND csh.city = " . $city . " AND s.service_name like '%" . $service . "%' ";
		$result = $this->conn->query($query);

		$rows = array();
		while ($r = mysqli_fetch_assoc($result)) {
			$rows[] = $r;
		}
		return $rows;
	}
}