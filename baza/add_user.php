<?php 
	include_once ('header.php');
	require_once "functions.php";
	
	?>

		<div id="center_wrap">

			<div id="one_column">
<center>Список текущих пользователей в регистратуре</center>
<table border=1>
<tr><td>ID</td><td>ФИО</td><td>Логин</td><td>Пароль</td><td>Действия</td></tr>
<?php
$query = "select * From `reg_users`";
$result = mysql_query($query);
while ($t_page = mysql_fetch_array($result, MYSQL_ASSOC))
			{
				$login = "$t_page[login]";
				$fam_us = "$t_page[fam_us]";
				$name_us = "$t_page[name_us]";
				$id = "$t_page[id]";
				$password = "$t_page[password]";			
				echo"<tr><td>$id</td><td>$name_us $fam_us</td><td>$login</td><td>$password</td><td><button>Удалить</button></td></tr>";
			}
			

?>			
</table>
<center>Добавить пользователя в админы регистратуры</center>

			 <form action="admin/add.php" method="post">
<p>
    <label>Логин:<br></label>
    <input name="login" type="text" size="15" maxlength="15">
    </p>
<p>
    <label>Пароль:<br></label>
    <input name="password" type="password" size="15" maxlength="15">
    </p>
	<p>
    <label>Имя:<br></label>
    <input name="name_us" type="text" size="15" maxlength="15">
    </p>
	<p>
    <label>Фамилия:<br></label>
    <input name="fam_us" type="text" size="15" maxlength="15">
    </p>
<p>
    <input type="submit" name="submit" value="Добавить">

</p></form>
			</div>
			<div id="two_column">
			<?php
					include ('spisok.php');
				?>
		</div>
		<?php 
	include_once ('footer.php');
	?>