<?php


// connnect to database
$database = connectToDB();


// get data from login.php
$email = $_POST["email"];
$password = $_POST["password"];

// check for empty imput
if(empty($email) || empty($password)){
    $_SESSION['error'] = "Please fill up all details in the form, Thank You";
    header ("Location: /login");
    exit;
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
            header("Location: /");
            exit; 
        }else{
            setError("The password provided is incorrect","/login");
        }

    }else{
        setError("The Email Does Not Exist","/login");
    }
}