<?php 
	include_once ('header.php');
	require_once "functions.php";
	?>

		<div id="center_wrap">
		<?php 
		if(isset($_SESSION['id'])) 
			{
?>
<div id="one_column">
<center>
<?php
	global $id_user, $name_site;
	$site_info = mysql_query("select pp from setting_site");
	$site_info = mysql_query("select * from setting_site");
	while ($site_i = mysql_fetch_array($site_info))
	{
		$oth_on = $site_i['oth_on'];
		$god_on = $site_i['god_on'];
		$pass_on = $site_i['pass_on'];
		$telefon_on = $site_i['telefon_on'];
		$osebe_on = $site_i['osebe_on'];
		$contact_on = $site_i['contact_on'];
		$interest_on = $site_i['interest_on'];
		$oth_ob = $site_i['oth_ob'];
		$god_ob = $site_i['god_ob'];
		$pass_ob = $site_i['pass_ob'];
		$telefon_ob = $site_i['telefon_ob'];
		$osebe_ob = $site_i['osebe_ob'];
		$contact_ob = $site_i['contact_ob'];
		$interest_ob = $site_i['interest_ob'];
	}
	echo "<br>
Поля выделенные <font color = \"#FF0000\">красным цветом</font> обязательны для заполнения.

<form id=\"formID\" class=\"formular\" method=\"post\" action=\"admin/reg_post.php\">
<table>
<tr><td><font color = \"#FF0000\">Логин</font>:</td><td><input type=\"text\" name=\"login_us\" size = \"50\" class=\"validate[required,custom[noSpecialCaracters],length[0,20],]\" id=\"login\"></td></tr>
<tr><td><font color = \"#FF0000\">Пароль</font>:</td><td><input size = \"50\" class=\"validate[required,length[5,11]] text-input\" type=\"password\" name=\"passw_us\"  id=\"password\" ></td></tr>
<tr><td><font color = \"#FF0000\">Подтвердите пароль</font>:</td><td><input name=\"passw2_us\" size = \"50\"  class=\"validate[required,confirm[password]] text-input\" type=\"password\" id=\"password2\"></td></tr>
<tr><td><font color = \"#FF0000\">Ник</font>:</td><td><input type=\"text\" name=\"nick_us\" class=\"validate[required]\" id=\"nick_us\" size = \"50\"></td></tr>
<tr><td><font color = \"#FF0000\">Имя</font>:</td><td><input type=\"text\" name=\"name_us\" class=\"validate[required,custom[namer]]\" id=\"name_us\"size = \"50\"></td></tr>
<tr><td><font color = \"#FF0000\">Фамилия</font>:</td><td><input type=\"text\" name=\"fam_us\" class=\"validate[required,custom[namer]]\" id=\"fam_us\" size = \"50\"></td></tr>
<tr><td><font color = \"#FF0000\">Город</font>:</td><td><input type=\"text\" name=\"gorod_us\" class=\"validate[required,custom[namer]]\" size = \"50\"></td></tr>
<tr><td><font color = \"#FF0000\">Email адрес </font>: </td><td><input value=\"\"  class=\"validate[required,custom[email]] text-input\" type=\"text\" name=\"email\" id=\"email\" size=\"50\" ></td></tr>
<tr><td><font color = \"#FF0000\">Подтвердите email адрес</font> : </td><td><input value=\"\" class=\"validate[required,confirm[email]] text-input\" type=\"text\" name=\"email2\"  id=\"email2\" size=\"50\"></td></tr>
";
	if ($oth_on == "1")
	{
		if ($oth_ob == "1")
		{
			echo "<tr><td><font color = \"#FF0000\">Отчество</font>:</td><td><input type=\"text\" name=\"otch_us\"  size = \"50\" id=\"oth_ob\" class=\"validate[required]\"></td></tr>";
		}
		else
		{
			echo "<tr><td>Отчество:</td><td><input type=\"text\" name=\"otch_us\"  size = \"50\" ></td></tr>";
		}
	}
	if ($god_on == "1")
	{
		if ($god_ob == "1")
		{
			echo "<tr><td><font color = \"#FF0000\">Год рождения</font>:</td><td><input type=\"text\" name=\"god_us\"  size = \"50\" id=\"god_ob\"\"></td></tr>";
		}
		else
		{
			echo "<tr><td>Год рождения:</td><td><input type=\"text\" name=\"god_us\"  size = \"50\"></td></tr>";
		}
	}
	if ($pass_on == "1")
	{
		if ($pass_ob == "1")
		{
			echo "<tr><td><font color = \"#FF0000\">Паспорт (серия и номер, 10 цифр)</font>:</td><td><input type=\"text\" name=\"passport_us\" size = \"50\" id=\"passport_us\" class=\"validate[required]\"></td></tr>";
		}
		else
		{
			echo "<tr><td>Паспорт (серия и номер, 10 цифр):</td><td><input type=\"text\" name=\"passport_us\"  size = \"50\"></td></tr>";
		}
	}
	if ($telefon_on == "1")
	{
		if ($telefon_ob == "1")
		{
			echo "<tr><td><font color = \"#FF0000\">Контактный телефон (для администрации)</font>:</td><td><input type=\"text\" name=\"telefon_us\"  size = \"50\" id=\"example\" class=\"validate[required]\"></td></tr>";
		}
		else
		{
			echo "<tr><td>Контактный телефон (для администрации):</td><td><input type=\"text\" name=\"telefon_us\"  size = \"50\"></td></tr>";
		}
	}
		echo "</table><br><input name=\"adress\" type=\"hidden\" value=\"\"><p><input type=\"submit\" value=\"Регистрация\" ></p></form>";
?>
</center>
</div>
			<div id="two_column">
				<?php
					include ('spisok.php');
				?></div>
			<?php
			} 
		else 
			{ 
			echo"<center><b>ВЫ НЕ АВТОРИЗОВАНЫ!</b></center>";
			} 
?>
			
	
		</div>
		<?php 
	include_once ('footer.php');
	?>