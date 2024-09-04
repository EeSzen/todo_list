<?php

$host = "localhost";
$database_name = "todolist";
$database_user = "root";
$database_password = "password";

$database = new PDO("mysql:host=$host;dbname=$database_name",$database_user,$database_password);

$task = $_POST["label"];

if(empty($task)){
    echo "plz insert something thanks my G";
}else{
    $sql = 'INSERT INTO todos(`label`)VALUES(:label)';
    $query = $database ->prepare( $sql );
    $query -> execute(['label'=> $task]);

    header("Location: /");
    exit;
}