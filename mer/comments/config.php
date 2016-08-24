<?php
	$hostname="localhost"; // Имя хоста
	$login="root"; // Логин для подкл. к серверу баз даных
	$pwd=""; // Пароль для подкл. к серверу баз даных
	$db_name="test";  // Название базы даных
	//подключение к базе
	$con = @mysql_connect($hostname, $login, $pwd) or die("Error! connect-database");
	mysql_select_db($db_name, $con) or die ("Error! select-database");
?>