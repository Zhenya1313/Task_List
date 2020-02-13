<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Форма для авторизации</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
	<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
  <script src="css/script.js"></script>
</head>
<body>
  <?php require "blocks/indheader.php" ?>
	<div class="container-fluid">
  <div class="row">
	<div class="foto col-md-7 col-lg-7 col-sm-12 dws-wrapper pt-5">
		<img src="img/glavna.png" class="img-fluid">
	</div>

  <div class="avtoriz col-md-5 col-lg-5 col-sm-12 col-12 pt-5 pb-3  ">

	<?php
		if($_COOKIE['user'] == ''):
	?>

  <div class="dws-wrapper">
	<div class="dws-form">
		<!-- Вкладки на JS -->
  <div class="col-12">


		<div class="row">


    <label class="tab active col"  title="Вкладка 2"><a>Регистрация</a></label>
		<label class="tab col" title="Вкладка 1"><a>Авторизация</a></label>

</div>
</div>
    <form class="tab-form active" action="check.php" method="post">
      <div class="box-input" >
        <input type="text"  name="login" id="login" required  >
        <label>Введите Логин</label>
      </div>
      <div class="box-input mt-3" >
        <input type="text"  name="name" id="name" required >
        <label>Введите Имя</label>
      </div>
      <div class="box-input mt-3">
        <input type="password" name="pass" id="pass" required >
        <label>Введите Пароль</label>
      </div>
		<button class="btn btn-primary btn-lg w-100 mt-3 " type="submit">Зарегистрироваться</button>

  			<div class="recover mt-2">
  				<input type="checkbox">
  				<label>Ознакомлен(-а) и принимаю <a href="#">условия регистрации</a></label>
  			</div>
		</form>

		<form  class="tab-form" action="auth.php" method="post" >
      <div class="box-input mt-3">
        <input type="text"  name="login" id="login" required >
        <label>Введите Логин</label>
      </div>

			<div class="box-input mt-3">
        <input type="password"  name="pass" id="pass" required>
        <label>Введите пароль</label>
      </div>
		 <button class="btn btn-primary btn-lg w-100 mt-3 " type="submit">войти</button>

			<div class="zabul mt-2">
			<a href="#">Я забыл свой E-mail или пароль</a>
		</div>
		</form>
	</div>
</div>
<?php else: ?>
	<p>Привет <?=$_COOKIE['user']?>.Чтобы выйти нажмите здесь <a href="/exit.php">Выйти</a></p>
<?php endif; ?>
</div>
</div>
</div>
</body>
</html>
