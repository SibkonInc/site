<?php
/**
 * @author Yerick
 * @copyright 2009
 * @name YCMS 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
function action()
{
	global $id_user, $tip_user, $site, $god_site;
	if (isset($_GET['id']))
	{
		$id = addslashes($_GET['id']);
	}
	else
	{
		$id = "00";
	}
	if (!is_numeric($id))
	{
		die("Такой записи нет!");
	}
	$id = intval($id);
	$master = dostup_comand($id);
	if ($master == 1)
	{
		$ok_page = mysql_query("select * from command where id = $id");
		while ($t_page = mysql_fetch_array($ok_page))
		{
			$id = $t_page['id'];
			$name = $t_page['name'];
			$text = $t_page['text'];
			$tip = $t_page['tip'];
			$tip_u = $t_page['tip_u'];
			$tp = $t_page['tp'];
			$adm = $t_page['adm'];
			$files = $t_page['files'];
			$forum = $t_page['forum'];
		}
		echo "
		<h4 align = \"center\">Редиктирование Команды</h4>
<form name=\"form1\" method=\"post\" action=\"edit_post.php?id=$id\">
<table>
<tr><td>Название команды:</td><td><input type=\"text\"  name='name' size=\"86\" value = \"$name\"></td></tr>
<tr><td>Тип:</td><td>
<select name=\"tip\" size=\"1\">
<option value=\"0\"";
		if ($tip == "0")
		{
			echo " selected";
		}
		echo ">Открытая</option>
<option value=\"1\"";
		if ($tip == "1")
		{
			echo " selected";
		}
		echo ">Закрытая</option>
</select></td></tr>

<tr><td>Кто может писать комментарии</td><td>
<select name=\"tip_u\" size=\"1\">
<option value=\"0\"";
		if ($tip_u == "0")
		{
			echo " selected";
		}
		echo ">Все</option>
<option value=\"1\"";
		if ($tip_u == "1")
		{
			echo " selected";
		}
		echo ">Только зарегистрированные</option>
</select></td></tr>

<tr><td>Текстовое поле при подчи заявки на участие?</td><td>
<select name=\"tp\" size=\"1\">
<option value=\"1\"";
		if ($tp == "1")
		{
			echo " selected";
		}
		echo ">Да</option>
<option value=\"0\"";
		if ($tp == "0")
		{
			echo " selected";
		}
		echo ">Нет</option>
</select></td></tr>

<tr><td>Управление командой</td><td>
<select name=\"adm\" size=\"1\">
<option value=\"0\"";
		if ($adm == "0")
		{
			echo " selected";
		}
		echo ">Только мной</option>
<option value=\"1\"";
		if ($adm == "1")
		{
			echo " selected";
		}
		echo ">Руководством</option>
</select></td></tr>

<tr><td>Разрешить прикрепление файлов</td><td>
<select name=\"files\" size=\"1\">
<option value=\"0\"";
		if ($files == "0")
		{
			echo " selected";
		}
		echo ">Да</option>
<option value=\"1\"";
		if ($files == "1")
		{
			echo " selected";
		}
		echo ">Нет</option>
</select></td></tr>

<tr><td>Разрешить форум</td><td>
<select name=\"forum\" size=\"1\">
<option value=\"0\"";
		if ($forum == "0")
		{
			echo " selected";
		}
		echo ">Да</option>
<option value=\"1\"";
		if ($forum == "1")
		{
			echo " selected";
		}
		echo ">Нет</option>
</select></td></tr>

</table>
<p>Текст<br><textarea name='text' rows=\"36\" cols='96' >$text</textarea></p>
<div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"javascript:document.form1.submit()\">Изменить</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div>
<p> <input name = \"kno\" type=\"submit\" value='.' style=\"color:#fff;border:0;padding:0;margin:0;background:#fff;height:6px;width:6px\">                           
</form>
";
	}
	else
	{
		error(7);
	}
}
function title()
{
	global $id_user, $name_site;
	if (isset($_GET['id']))
	{
		$id = addslashes($_GET['id']);
	}
	else
	{
		$id = "00";
	}
	if (!is_numeric($id))
	{
		die("Такой записи нет!");
	}
	$id = intval($id);
	$ok_page = mysql_query("select * from command where id = $id");
	while ($t_page = mysql_fetch_array($ok_page))
	{
		$name = $t_page['name'];
	}
	echo "
<title>Редактирование $name| $name_site</title>";
}
function right()
{
}
require ("../theme/$theme/$theme.htm");
?>