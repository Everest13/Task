<?php
/**
 * Created by PhpStorm.
 * User: julia
 * Date: 2020-02-11
 * Time: 21:23
 */
namespace App;

use App\TodoEntity;
use mysql_xdevapi\Exception;

class TodoService
{
	public $dbConnect;
	public $todoRepository;

	public function __construct(DBConnect $dbConnect)
	{
		$this->dbConnect = $dbConnect;
		$this->todoRepository = new TodoRepository($dbConnect);
	}

	public function saveTodo($data)
	{
		$this->checkTodoTable();

		if (!array_key_exists('date', $data) && !array_key_exists('description', $data))
		{
			throw new Exception('Error: one or both fields is empty!');
		}

		$todo = new TodoEntity($data['date'], $data['description']);

		if ($this->todoRepository->getTodo($todo))
		{
			throw new Exception('Error: such a task has already been created');
		}

		$this->todoRepository->saveTodo($todo);

	}

	public function checkTodoTable(): bool
	{
		$meta = pg_meta_data($this->dbConnect->getConnection(), 'todolist');
		if ($meta == false)
		{
			$this->todoRepository->createTodoListTable();
		}

		return true;
	}


}