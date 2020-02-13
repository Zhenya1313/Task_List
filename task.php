<?php
    include "db.php";

    if (isset($_GET['id'])){
      $query = "SELECT * FROM todo WHERE project_id=". $_GET['id'];
      $result = mysqli_query($connection, $query);
    }



    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $todo = $_POST['todo'];
      $date = date('l jS \of F Y h:i:s A');
    if (empty($todo)) { //check add empty task
      $error = "Field is required";
    }
    else{
      $id = $_POST['id'];
      $sql = "INSERT INTO todo(t_name,t_date,project_id) VALUES('$todo', '$date', '$id')" ;
      $results = mysqli_query($connection, $sql);

      if (!$results) { //Check for adding task
        die("Failed");
      } else{
        header("Location:task.php?id=".$id);
      }
    }
    }

    if (isset($_GET['delete_todo'])) {
      $dlt_todo = $_GET['delete_todo'];
      $sqli = "DELETE FROM todo WHERE t_id = $dlt_todo";
      $res = mysqli_query($connection,$sqli);
      if (!$res) {  //Check for del task
        die("Failed");
      } else{
        header("Location:task.php?id=".$_GET['id']);
      }
    }

    if ($_GET['file-upload']) {

    $uploaddir = "F:/";
    $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {

    } else {
      echo "Возможная атака с помощью файловой загрузки!\n";
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
      .search {
        margin: 7px;
      }
    </style>
  </head>
  <body>
    <?php require "blocks/sidebar.html"; ?>
    <div class="container">
      <div class="todo">
          <h1>Php App</h1>
          <h3>Add a New Todo</h3>
          <?php
            if(isset($error)){
              echo "<div class='alert alert-danger'>$error</div>"; //Error empty task
            }
           ?>
          <form class="" action="<?php echo$_SERVER['PHP_SELF']  ?>" method="POST">
            <div class="form-group">
              <input class="form-control" type="text" name="todo"
                placeholder="Todo Name">
              </input>
              <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"></input>
            </div>
            <div class="form-group">
              <input class="btn btn-primary" type="submit" value="Add a New todo Task List">
            </div>
          </form>
      </div>
      <div class="col-lg-4 search">
        <form class="" action="search.php" method="POST">

          <input class="form-control" type="text" name="search" placeholder="Search..."></input>

        </form>
      </div>
      <div class="table-responsive col-lg-12">
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <th>№</th>
            <th>ToDo</th>
            <th>Date Added</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Upload</th>
          </thead>
          <tbody>
            <?php
              while ($row = mysqli_fetch_assoc($result)) {
                $t_id = $row['t_id'];
                $t_name = $row['t_name'];
                $t_date = $row['t_date'];
                ?>
                <tr>
                  <td><?php echo $t_id;   ?></td>
                  <td><?php echo $t_name; ?></td>
                  <td><?php echo $t_date; ?></td>
                  <td><a href="edit.php?edit-todo=<?php echo $t_id; ?>" class="btn btn-primary">Edit</a></td>
                  <td>
                    <form action="task.php" method="GET">
                      <input type="hidden" name="delete_todo" value="<?php echo $t_id; ?>">
                      <input type="hidden" value="<?php echo $_GET['id'];?>" name="id">
                      <input type="submit" name="submit" class="btn btn-danger" value="Delete">
                  </td>
                  <td>
                      <input type="file" name="userfile" >
                      <input type="submit" class="btn btn-primary"value="Upload">
                    </form>
                  </td>
                </tr>

            <?php  }

             ?>


          </tbody>
        </table>
      </div>
    </div>



  </body>
</html>
