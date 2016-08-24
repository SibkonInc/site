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
	$adm = dostup_adm();
	if ($adm == "1")
	{
		if (isset($_GET['id']))
		{
			$id = addslashes($_GET['id']);
		}
		else
		{
			$id = "0";
		}
		if (!is_numeric($id))
		{
			die("Такой записи нет!");
		}
		$id = intval($id);
		$ok_page = mysql_query("select * from module where id = $id");
		while ($t_page = mysql_fetch_array($ok_page))
		{
			$id = $t_page['id'];
			$name = $t_page['name'];
			$on = $t_page['on'];
			$file = $t_page['file'];
		}
		echo "<h4 align = \"center\">Редактирование модуля \"$name\"</h4>
<form name=\"form1\" method=\"post\" action=\"edit_post.php?id=$id\">
<table>";
		echo "
<tr><td>Название:</td><td><input type=\"text\"  name='name' size=\"86\" value= \"$name\"></td></tr>
<tr><td>Название:</td><td><input type=\"text\"  name='file' size=\"86\" value= \"$file\"></td></tr>
";
		echo "<tr><td>Включен</td><td><select name=\"on\" size=\"1\">";
		echo "<OPTION VALUE=\"0\"";
		if ($on == "0") echo "SELECTED";
		echo ">Нет</OPTION>";
		echo "<OPTION VALUE=\"1\"";
		if ($on == "1") echo "SELECTED";
		echo ">Да</OPTION>";
		echo "</select></td></tr>";
		echo "</table>
<div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"javascript:document.form1.submit()\">Изменить данные</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div>
<p> <input name = \"kno\" type=\"submit\" value='.' style=\"color:#fff;border:0;padding:0;margin:0;background:#fff;height:6px;width:6px\"/> </form>
";
	}
	else
	{
		error(7);
	}
}
function title()
{
	global $name_site;
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
	$ok_page = mysql_query("select * from module where id = $id");
	if (!mysql_num_rows($ok_page)) die("error(12).<p>");
	else
	{
		while ($t_page = mysql_fetch_array($ok_page))
		{
			$name = $t_page['name'];
		}
	}
	echo "
<title>Редактирование $name | $name_site</title>";
}
function right()
{
}
require ("../theme/$theme/$theme.htm");
?>