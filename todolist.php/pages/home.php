<?php

// connnect to database
$database = connectToDB();


// 3. get students data from the database
  // 3.1 - SQL command (recipe)
  $sql = "SELECT * FROM todos";
  // 3.2 - prepare SQL query (prepare your material)
  $query = $database->prepare($sql); 
  // 3.3 - execute SQL query (to cook)
  $query->execute();
  // 3.4 - fetch all the results (eat)
  $label = $query->fetchAll();

  require 'parts/header.php';

?>


    <?php if (isset($_SESSION["user"])):?>
    <div
      class="card rounded shadow-sm "
      style="max-width: 600px; margin: 60px auto;"
    >
      <div class="card-body">
        <h2 class="card-title mb-3 text-center"><?= $_SESSION["user"]["name"];?>'s Todo List</h2>

        <ul class="list-group">


        <?php foreach($label as $index => $task):?>
          <li class="list-group-item d-flex justify-content-between align-items-center">
          <div class="d-flex">   
            <!-- checkbox -->
            <form method ="POST" action = "/task/tick_box">
              <input type="hidden"name="task_id"value="<?=$task["id"]?>"/>
                <input type="hidden"name="completed"value="<?=$task["completed"]?>"/>

            <?php if($task["completed"] == 0):?>

              <button class="btn btn-sm">
                <i class="bi bi-square"></i>
              </button>

            <?php else:?>

              <button class="btn btn-sm btn-success">
                <i class="bi bi-check-square"></i>
              </button>

            <?php endif;?>
            </form>
            
              <span class="ms-2 "><?=$task['label']?></span>
            </div>
            <!-- delete -->
            <div>
              <form method ="POST" action = "/task/delete">
                <button class="btn btn-sm btn-danger">
                  <input type="hidden"name = "task_id"value="<?=$task["id"]?>"/>
                  <i class="bi bi-trash"></i>
                </button>
              </form>
            </div>
          </li>
        <?php endforeach;?>
          
          
        </ul>
        <!-- add task -->
        <?php require 'parts/error_box.php'?>
        <div class="mt-4">
          <form method="POST"action="/task/add" class="d-flex justify-content-between align-items-center">
            <input
              type="text"
              class="form-control"
              placeholder="Add new item..."
              name="label"
            />
            <button class="btn btn-primary btn-sm rounded ms-2">Add</button>
          </form>
        </div>
        <div class="text-center">
      <a href="/logout" class="text-decoration-none"
        ><button class="btn btn-sm btn-danger mx-auto mt-5">Log Out</button></a
      >
    </div>
      </div>
    </div>
    <?php else :?>
      <div class="card rounded shadow-sm text-center " style="max-width: 500px; margin: 60px auto;">
        <div class="card-body ">
        <h2 class="card-title mb-2">To Do list</h2>
        <p class = "mb-4">Please log in to continue</p>
          <a href="/login" class="btn btn-sm btn-primary mb-2">Log In</a>
          <a href="/signup" class="btn btn-sm btn-primary mb-2">Sign Up</a>
        </div>
      </div>
    <?php endif;?>


    
<?php
  require 'parts/footer.php';





