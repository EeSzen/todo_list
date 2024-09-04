<?php
session_start();


$host = "localhost";
$database_name = "todolist";
$database_user = "root";
$database_password = "password";

$database = new PDO(
    "mysql:host=$host;dbname=$database_name",
        $database_user, // username
        $database_password // password
    );

// get data from login.php
$email = $_POST["email"];
$password = $_POST["password"];

// check for empty imput
if(empty($email) || empty($password)){
    echo "<h1>Please fill up all details in the form, Thank You</h1>";
}else{
    $sql = "SELECT * FROM users WHERE email = :email";
    $query = $database -> prepare($sql);
    $query -> execute([
        "email" => $email
    ]);

    // fetch
    $user = $query -> fetch();

     // check if user exist
     if ( $user ){
        // check if the password is correct
        if(password_verify($password, $user["password"])){
            // login the user
            $_SESSION["user"] = $user;
            header("Location: index.php");
            exit; 
        }else{
            echo "The password provided is incorrect";
        };

    }else{
        echo "The Email Does Not Exist";
    }
}