<?php

// connnect to database
$database = connectToDB();


$task_id = $_POST["task_id"];

$sql = "DELETE FROM todos WHERE id = :id";
$query = $database -> prepare($sql);
$query->execute([
    "id" => $task_id
]);

header("Location: /");
exit;