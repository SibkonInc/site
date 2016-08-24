<!DOCTYPE html>
<html>
<link href="style.css" rel="stylesheet" type="text/css">
    <head>
     <META content="text/html; charset=utf-8" http-equiv="Content-Type">
	<title>Регистрация участников на Сибкон ##</title>	 
    </head>
    <body>

		<div id="wrapper">
		
		<div id="header">Заголовок</div>

		<div id="center_wrap">

			<div id="one_column">Блок с выводом информации о человеке</div>
			<div id="two_column">Список всех пользователей сайта
				<?php
					include_once ('spisok.php');
				?></div>
	
		</div>
		
		<div id="footer"></div>
		
	</div>
		
    </body>
</html>