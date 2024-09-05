<?php

// connnect to database
$database = connectToDB();

// get data from signup.php
$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];

// check for empty input
if(empty($name) || empty($email) || empty($password) || empty($confirm_password)){
    setError("Please fill up all details in the form, Thank You","/signup");
}else if($password !== $confirm_password){
    setError("Password Unmatch","/signup");
}else if(strlen($password) < 8){
    setError("Password must contain at least 8 characters","/signup");
}else{
     // check if the email already in-used or not
        // sql command
        $sql = "SELECT * FROM users WHERE email = :email";    

        //prepare
        $query = $database -> prepare($sql);

        // execute
        $query -> execute([
            'email' => $email
        ]);

        // fetch
        $user = $query -> fetch(); //return the first row starting from the query row
        // if user exists, it means the email already in-used
        if ( $user ) {
            echo '<script>alert("The email entered already in-used! Please use another email");window.location.href="signup.php";</script>';
        }else{
    
    $sql = "INSERT INTO users(`name`,`email`,`password`) VALUES( :name, :email, :password)";
    $query = $database -> prepare( $sql );
    $query -> execute([
        "name" => $name,
        "email" => $email,
        "password" => password_hash($password , PASSWORD_DEFAULT)
    ]);

header("Location: /login");
exit;

        }
};