<?php
/**
 * Created by PhpStorm.
 * User: julia
 * Date: 2020-02-11
 * Time: 21:53
 */
namespace App;

class TodoEntity
{
	private $date;

	private $description;

	public function __construct(string $date, string $description)
	{
		$this->setDescription($description);
		$this->setDate($date);
	}

	public function setDate(string $date)
	{
		if (preg_match('/^(\d{1,4}([-])\d{1,2}([-])\d{1,2})$/', $date))
		{
			$this->date = new \DateTime($date);
		}
	}

	public function setDescription(string $description)
	{
		if (strlen($description))
		{
			$this->description = quotemeta($description);
		}
	}

	public function getDate()
	{
		return $this->date->format('Y-m-d');
	}

	public function getDescription()
	{
		return $this->description;
	}
}