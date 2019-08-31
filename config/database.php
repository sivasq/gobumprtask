<?php

class Database
{
	// Database credentials
	public $conn;
	private $host = "localhost";
	private $db_name = "task_db";
	private $username = "root";
	private $password = "password";

	// get the database connection
	public function getConnection()
	{
		$this->conn = null;

		$this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

		if ($this->conn->connect_error) {
			die("Connection failed: " . $this->conn->connect_error);
		}

		return $this->conn;
	}
}