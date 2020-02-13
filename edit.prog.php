<?php
    include "db.php";

    if (isset($_GET['edit-project'])) {
        $e_id = $_GET['edit-project'];
    }

    if (isset($_POST['edit_project'])) {
      $edit_project = $_POST['project'];

      $query = "UPDATE project SET name = '$edit_project' WHERE id = $e_id";
      $run = mysqli_query($connection, $query);

      if (!$run) {
        die("Failed");
      } else {
        header("Location: project.php?updated");
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
    </style>
  </head>
  <body>
    <div class="container">
      <div class="project">
          <h1>Php App</h1>
          <form action="" method="POST">
            <?php
              $sql = "SELECT * FROM project WHERE id = $e_id";
              $result = mysqli_query($connection, $sql);
              $data = mysqli_fetch_array($result);
             ?>
            <div class="form-group">
              <input class="form-control" type="text" name="project"
                placeholder="Project Name" value="<?php echo $data['name']; ?>">
              </input>
            </div>
            <div class="form-group">
              <input class="btn btn-primary" type="submit"
              value="Edit Project" name="edit_project">
            </div>
          </form>
      </div>
      <div class="table-responsive">

    </div>

  </body>
</html>
