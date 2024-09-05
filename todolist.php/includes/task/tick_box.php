<?php

// connnect to database
$database = connectToDB();


$tick_box = $_POST["completed"];
$task_id = $_POST["task_id"];




// change value to 01
if($tick_box == 0){
    $sql = "UPDATE todos SET completed = 1 WHERE id = :id";
    $query = $database -> prepare($sql);
    $query -> execute([
        'id' => $task_id
    ]);

    header("Location: /");
    exit;
}else{
    $sql = "UPDATE todos SET completed = 0 WHERE id = :id";
    $query = $database -> prepare($sql);
    $query -> execute([
        'id' => $task_id
    ]);

    header("Location: /");
    exit;
}





// send back to database
    // $sql = "UPDATE todos SET completed = :completed WHERE id = :id";
    // $query = $database -> prepare($sql);
    // $query -> execute([
    //     'completed' => $tick_box,
    //     'id' => $task_id
    // ]);

    // header("Location: index.php");
    // exit;
