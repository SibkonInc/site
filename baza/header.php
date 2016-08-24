<!DOCTYPE html>
<html>    <head>
<script type="text/javascript" src="http://sibkon.org/js/jquery.js"></script>
<script type="text/javascript" src="http://sibkon.org/js/fun.js"></script>
<script type="text/javascript" src="http://sibkon.org/js/jquery.cookie.js"></script>
<link type="text/css" href="http://sibkon.org/js/css/le-frog/jquery-ui-1.7.2.custom.css" rel="stylesheet">
<link href="js/facebox/facebox.css" media="screen" rel="stylesheet" type="text/css">
<script src="js/facebox/facebox.js" type="text/javascript"></script>
<script src="http://sibkon.org/js/jquery.expander.min.js" type="text/javascript"></script>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/style_profile.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.dataTables.js"></script>

</script>
<!--<META content="text/html; charset=windows-1251" http-equiv="Content-Type">-->
<META content="text/html; charset=utf-8" http-equiv="Content-Type">
	<title>Регистрация участников на Сибкон 2015</title>	 
    </head>
    <body>
<?php 	session_start(); 
$db = mysql_connect("mysql-1", "us3513b", "ghtdtlrhfcfdxtu"); 
		mysql_select_db("db3513b", $db);
		mysql_query('SET NAMES utf8');
?>
		<div id="wrapper">
		
		<div id="header"><center><h3>Регистрация на Сибкон 2015</h3>
		<?php
		if(isset($_SESSION['id'])) 
			{ ?>
		<a href="index.php">Главная</a> | <a href="register_user.php">Регистрация участника</a> | <a href="log.php">Лог действий</a>  | <a href="pitanie.php">Питание</a>  | <a href="rooms.php">Комнаты</a> | <a href="money.php">Деньги и статистика</a> | <a href=print_stat.php>Печать статистики</a>
		<?php if ($login == "jogray")
			echo" | <a href=spiski.php>Списки</a> | <a href=add_user.php>Админы</a>  ";?>
		
		<?php 
			echo "
			<div id=login_form2>
			Вы вошли как:<br>";
			$result = mysql_query("SELECT * FROM reg_users WHERE login='$login'", $db);
			$myrow = mysql_fetch_array($result);
			$name_us=$myrow["name_us"]; 
			$fam_us=$myrow["fam_us"]; 
			echo "$name_us $fam_us<br>";
			echo"<a href='login/exit.php'>выйти</a> </div>";
			} 
		else 
			{
			echo"<div id=login_form>";
			include ('login/main.php'); 
			echo"</div>";
			} 
?>
		</center>
		</div>