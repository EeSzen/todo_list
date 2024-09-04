<?php

$host = "localhost";
$database_name = "todolist";
$database_user = "root";
$database_password = "password";

$database = new PDO("mysql:host=$host;dbname=$database_name",$database_user,$database_password);

$task_id = $_POST["task_id"];

$sql = "DELETE FROM todos WHERE id = :id";
$query = $database -> prepare($sql);
$query->execute([
    "id" => $task_id
]);

header("Location: /");
exit;