<?php

$host = "localhost";
$database_name = "todolist";
$database_user = "root";
$database_password = "password";

$database = new PDO(
    "mysql:host=$host;dbname=$database_name",
        $database_user, // username
        $database_password // password
    );

// get data from signup.php
$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];

// check for empty input
if(empty($name) || empty($email) || empty($password) || empty($confirm_password)){
    echo "<h1>Please fill up all details in the form, Thank You</h1>";
}else if($password !== $confirm_password){
    echo "<h3>Password Unmatch</h3>";
}else if(strlen($password) < 8){
    echo "<h3>Password must contain at least 8 characters</h3>";
}else{
    
    $sql = "INSERT INTO users(`name`,`email`,`password`) VALUES( :name, :email, :password)";
    $query = $database -> prepare( $sql );
    $query -> execute([
        "name" => $name,
        "email" => $email,
        "password" => password_hash($password , PASSWORD_DEFAULT)
    ]);

header("Location: login.php");
exit;

};