<?php
/**
 * Created by PhpStorm.
 * User: julia
 * Date: 2020-02-10
 * Time: 21:38
 */

namespace App;

use App\DBConnect;
use App\TodoService;

class TodoController
{
	public $dbConnect;
	public $todoService;


	public function __construct(DBConnect $dbConnect)
	{
		$this->dbConnect = $dbConnect;
		$this->todoService = new TodoService($dbConnect);
	}

	public function postTodo(array $data)
	{
		try {
			$this->todoService->saveTodo($data);
		} catch (\Exception $e)
		{
			throw new \Exception($e->getMessage());
			var_dump($e->getMessage());exit;
		}


	}


}