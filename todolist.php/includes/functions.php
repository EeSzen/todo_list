<?php
// connect to database
function connectToDB(){
    // 1. collect database info
    $host = "localhost";
    $database_name = "todolist";// connecting to which database
    $database_user = "root";
    $database_password = "password";

    // 2. connect to database (PDO - PHP database object)
    $database = new PDO(
    "mysql:host=$host;dbname=$database_name",
    $database_user,//username
    $database_password//password
    );

    return $database;
}

// set error message
function setError( $message , $redirect){
    $_SESSION['error'] = $message;
    // redirect user 
    header("Location:" . $redirect);
}