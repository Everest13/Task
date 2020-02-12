<?php

namespace App;

class DBConnect
{
	const HOST = "localhost";
	const DBNAME = "todo";
	const PORT = 5432;
	const USER ="postgres";
	const PASSWORD = "postgres";

	private $db_connection;

	private static $instance;

	private function __construct()
	{
		if ($this->db_connection == false)
		{
			$this->connectToDB();
		}
	}

	public static function getInstance(): DBConnect
	{
		if (self::$instance == null)
		{
			self::$instance = new DBConnect();
		}

		return self::$instance;
	}

	public function getConnection()
	{
		return $this->db_connection;
	}

	public function stopConnection()
	{
		pg_close($this->db_connection);
	}

	public function clearResult($result)
	{
		pg_free_result($result);
	}

	public function executeQuery(string $query)
	{
		$result = pg_query($query) or new \Exception('Ошибка запроса: ' . pg_last_error());

		return $result;
	}

	private function connectToDB()
	{
		$this->db_connection = pg_connect("host=".self::HOST." dbname=".self::DBNAME." port=".self::PORT." user=".self::USER." password=".self::PASSWORD);
	}
}
