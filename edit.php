<?php
    include "db.php";

    if (isset($_GET['edit-todo'])) {
        $e_id = $_GET['edit-todo'];
    }

    if (isset($_POST['edit_todo'])) {
      $edit_todo = $_POST['todo'];

      $query = "UPDATE todo SET t_name = '$edit_todo' WHERE t_id = $e_id";
      $run = mysqli_query($connection, $query);
      $query_select = "SELECT project_id FROM todo WHERE t_id = $e_id";
      $project_id=mysqli_fetch_assoc(mysqli_query($connection,$query_select));
      if (!$run) {
        die("Failed");
      } else {
        header("Location: task.php?id=". $project_id['project_id']);
      }
    }

 ?>
<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To-Do List</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
      .todo{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        border-radius: 3px;
        border: 1px solid #cccccc;
        margin-top: 5px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="todo">
          <h1>Php App</h1>
          <form action="" method="POST">
            <?php
              $sql = "SELECT * FROM todo WHERE t_id = $e_id";
              $result = mysqli_query($connection, $sql);
              $data = mysqli_fetch_array($result);
             ?>
            <div class="form-group">
              <input class="form-control" type="text" name="todo"
                placeholder="Todo Name" value="<?php echo $data['t_name']; ?>">
              </input>
            </div>
            <div class="form-group">
              <input class="btn btn-primary" type="submit"
              value="Edit Task" name="edit_todo">
            </div>
          </form>
      </div>
      <div class="table-responsive">

    </div>

  </body>
</html>
