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
	$org = dostup_org_god($god_site);
	if ($adm == "1" or $org == "1")
	{
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
		$ok_page = mysql_query("select * from news where id_news = $id");
		if (isset($_GET['ok']))
		{
			$ok = addslashes($_GET['ok']);
		}
		$ok = intval($ok);
		if ($ok == "1")
		{
			echo "<div align=\"center\"><font color = red><h4>Данные были изменены</h4></div>";
		}
		if (!mysql_num_rows($ok_page)) die("error(12).<p>");
		else
		{
			while ($t_page = mysql_fetch_array($ok_page))
			{
				$id = $t_page['id_news'];
				$name = $t_page['small_news'];
				$text = $t_page['full_news'];
				$date = $t_page['date_news'];
			}
		}
		echo "
<div align=\"center\"><h4>Редактирование новости</h4></div>        
<form name=\"form1\" method=\"post\" action=\"edit_post.php?id=$id\">
<table>
<tr><td>Название:</td><td><input type=\"text\"  name='name' size=\"86\" value= \"$name\"></td></tr>
<tr><td>Дата:</td><td><input type=\"text\"  id=\"datepicker\" name='date' size=\"86\" value= \"$date\"></td></tr>
</table>
<p>Текст<br><textarea name='text' rows=\"36\" cols='96' >$text</textarea></p>
<div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"javascript:document.form1.submit()\">Изменить новость</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div>
<p> <input name = \"kno\" type=\"submit\" value='.' style=\"color:#fff;border:0;padding:0;margin:0;background:#fff;height:6px;width:6px\"/>                           
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
	$ok_page = mysql_query("select * from news where id_news = $id");
	while ($t_page = mysql_fetch_array($ok_page))
	{
		$id = $t_page['id_news'];
		$name = $t_page['small_news'];
		$text = $t_page['full_news'];
		$date = $t_page['date_news'];
	}
	echo "
<title>Редактирование $name| $name_site</title>";
}
function right()
{
}
require ("../theme/$theme/$theme.htm");
?>