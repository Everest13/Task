<?php
require __DIR__ . '/vendor/autoload.php';

use App\DBConnect;
use App\TodoController;

try {
	$instance = DBConnect::getInstance();
	$todoController = new TodoController($instance);

	if ($_POST)
	{
		$todoController->postTodo($_POST);
	}








} catch (Exception $e)
{
	return $e;
}
