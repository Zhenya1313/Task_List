<?php
  $login = filter_var(trim($_POST['login']),
  FILTER_SANITIZE_STRING);
  $name = filter_var(trim($_POST['name']),
  FILTER_SANITIZE_STRING);
  $pass = filter_var(trim($_POST['pass']),
  FILTER_SANITIZE_STRING);

  if(mb_strlen($login) < 5 || mb_strlen($login) > 40) {
    echo "Недопустимая длина логина";
    exit();
  } else if(mb_strlen($name) < 5 || mb_strlen($name) > 40) {
    echo "Недопустимая длина имени";
    exit();
  } else if(mb_strlen($pass) < 3 || mb_strlen($pass) > 15) {
    echo "Недопустимая длина логина (от 3 до 15 символов)";
    exit();
  }
  $pass = md5($pass."soli2345");

  $mysql = new mysqli('localhost','root','','todo_list');
  $mysql -> query("INSERT INTO `users` (`login`, `name`, `pass`)
  VALUES ('$login','$name','$pass')");

  $mysql -> close();

  header('Location:/registr.php');



?>
