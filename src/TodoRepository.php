<?php
/**
 * Created by PhpStorm.
 * User: julia
 * Date: 2020-02-11
 * Time: 22:25
 */
namespace App;

class TodoRepository
{
	public $dbConnect;

	public function __construct(DBConnect $dbConnect)
	{
		$this->dbConnect = $dbConnect;
	}

	public function createTodoListTable()
	{
		$query = 'CREATE  TABLE todolist (
			id serial PRIMARY KEY,
			description varchar(255),
			created_date date
		)';

		$this->dbConnect->executeQuery($query);
	}

	public function getTodo(TodoEntity $todo)
	{
		$query = 'SELECT * FROM todolist
			WHERE description ='.$todo->getDescription().' and 
			created_date ='.$todo->getDate();

		return $this->dbConnect->executeQuery($query);
	}

	public function saveTodo(TodoEntity $todo)
	{
		$query = "INSERT INTO todolist VALUES (default, '{$todo->getDescription()}', '{$todo->getDate()}')";

		$result = $this->dbConnect->executeQuery($query);

		if ($result) {
			return true;
		}
	}
}