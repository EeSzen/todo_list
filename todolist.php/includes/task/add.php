<?php

// connnect to database
$database = connectToDB();


$task = $_POST["label"];

if(empty($task)){
    setError ("plz insert something thanks my G","pages/home.php");
}else{
    $sql = 'INSERT INTO todos(`label`)VALUES(:label)';
    $query = $database ->prepare( $sql );
    $query -> execute(['label'=> $task]);

    header("Location: /");
    exit;
}