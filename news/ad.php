<?php
/**
 * @author нукшсл
 * @copyright 2009
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
		if (isset($_GET['ok']))
		{
			$ok = addslashes($_GET['ok']);
		}
		$ok = intval($ok);
		if ($ok == "1")
		{
			echo "<div align=\"center\"><font color = red><h4>Данные были изменены</h4></div>";
		}
		$date_news = date("Y-m-d");
		echo "
<form name=\"form1\" method=\"post\" action=\"ad_post.php\">
<table>
<tr><td>Название:</td><td><input type=\"text\"  name='name' size=\"86\"></td></tr>
<tr><td>Дата:</td><td><input type=\"text\"  name='date' size=\"86\" value= \"$date_news\"></td></tr>
</table>
<p>Текст<br><textarea name='text' rows=\"36\" cols='96' >$text</textarea></p>
<div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"javascript:document.form1.submit()\">Добавить новость</a></span> 
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
	echo "
<title>Добавление новости | $name_site</title>";
}
function right()
{
}
require ("../theme/$theme/$theme.htm");
?>