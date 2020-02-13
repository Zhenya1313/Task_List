<?php
    include "db.php";

    $query = "SELECT * FROM project";
    $result = mysqli_query($connection, $query);


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $project = $_POST['project'];
      $date = date('l jS \of F Y h:i:s A');
    if (empty($project)) { //check add empty task
      $error = "Field is required";
    }
    else{
      $sql = "INSERT INTO project(name,p_date) VALUES('$project', '$date')" ;
      $results = mysqli_query($connection, $sql);

      if (!$results) { //Check for adding task
        die("Failed");
      } else{
        header("Location:project.php?prog-added");
      }
    }
    }

    if (isset($_GET['delete_project'])) {
      $dlt_progect = $_GET['delete_project'];
      $sqli = "DELETE FROM project WHERE id = $dlt_progect";
      $res = mysqli_query($connection,$sqli);
      if (!$res) {  //Check for del task
        die("Failed");
      } else{
        header("Location:project.php?prog-delete");
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
      .project{
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
      <div class="project">
          <h1>Php App</h1>
          <h3>Add a New Project</h3>
          <?php
            if(isset($error)){
              echo "<div class='alert alert-danger'>$error</div>"; //Error empty task
            }
           ?>
          <form class="" action="<?php echo$_SERVER['PHP_SELF']  ?>" method="POST">
            <div class="form-group">
              <input class="form-control" type="text" name="project"
                placeholder="Todo Name">
              </input>
            </div>
            <div class="form-group">
              <input class="btn btn-primary" type="submit" value="Add a New Project">
            </div>
          </form>
      </div>

      <div class="table-responsive col-lg-12">
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <th>№</th>
            <th>Project</th>
            <th>Date Added</th>
            <th>Edit</th>
            <th>Delete</th>
          </thead>
          <tbody>
            <?php
              while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $name = $row['name'];
                $p_date = $row['p_date'];

                ?>
                <tr>
                  <td><?php echo $id; ?></td>
                  <td><a href="task.php?id=<?php echo $id; ?>"><?php echo  $name; ?></a></td>
                  <td><?php echo $p_date; ?></td>
                  <td><a href="edit.prog.php?edit-project=<?php echo $id; ?>" class="btn btn-primary">Edit</a></td>
                  <td><a href="project.php?delete_project=<?php echo $id; ?>" class="btn btn-danger">Delete</a></td>
                </tr>

            <?php  }

             ?>


          </tbody>
        </table>
      </div>
    </div>
    <?php require "blocks/footer.html"; ?>
  </body>
</html>
