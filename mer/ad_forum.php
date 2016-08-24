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
	global $site, $status_site, $name_group, $god_site, $id_user, $name_site;
	if (isset($_GET['id']))
	{
		$id = addslashes($_GET['id']);
	}
	else
	{
		$id = 0;
	}
	if (!is_numeric($id))
	{
		die("Такой записи нет!");
	}
	$id = intval($id);
	$adm = dostup_adm();
	$org_god = dostup_org_god($god_site);
	$upravlenie = dostup_mer_user($id);
	
    $ok_page = mysql_query("select * from meropriatia where id = $id");
   while ($t_page = mysql_fetch_array($ok_page))
   {
      $forum_all = $t_page['forum_all'];
   }
    
    
    
    if ($id_user == "")
	{
		error(7);
	}
	else
	{
		if ($upravlenie == "1" or $forum_all == "1")
		{
			$ok_page = mysql_query("select * from meropriatia where id = $id");
			{
				while ($t_page = mysql_fetch_array($ok_page))
				{
					$id = $t_page['id'];
					$name = $t_page['name'];
					$text = nl2br($t_page['text']);
					$id_con = $t_page['id_con'];
					$tip = $t_page['tip'];
					$tip = name_tip($tip);
					$podtip = $t_page['podtip'];
					$podtip = name_podtip($podtip);
					$name_mer = name_mer($id);
				}
			}
			$ok_sibkon = mysql_query("SELECT * FROM `sibkon` WHERE `id` = $id_con");
			while ($t_sibkon = mysql_fetch_array($ok_sibkon))
			{
				$id_sibkon = $t_sibkon['id_con'];
				$god = $t_sibkon['god'];
				$tema = $t_sibkon['tema'];
			}
			echo "
<p>
	<a href = \"$site/sibkon.php?id=$god\">$name_site $god: $tema</a> | $tip | $podtip | $name_mer
	";
			echo "<h3 align = \"center\">Добавление Обсуждения к $name</h3>";


			echo "
<form name=\"form1\" method=\"post\" action=\"ad_forum_post.php?m=$m&amp;t=$t&amp;id=$id\">
<table>
<tr><td>Тема</td><td><input type=\"text\"  name='name' size=\"86\"></td></tr>";
echo "<tr><td>Закрытый</td><td><SELECT NAME=\"dostup\" SIZE=\"1\"><OPTION VALUE=\"0\">Нет</OPTION><OPTION VALUE=\"1\">Да</OPTION></select> Виден будет только участникам</td></tr>";
echo"</table>
<p>Текст<br><textarea name='text' rows=\"36\" cols='96' ></textarea></p>
<div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"javascript:document.form1.submit()\">Добавить обсуждение</a></span> 
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
}
function title()
{
	global $name_site, $name_group;
	echo "

";
	echo "
    <script src=\"$site/js/addElements.js\" type='text/javascript'></script>
<title>Добавление новости $name_group | $name_site</title>";
}
function right()
{
	
}
require ("../theme/$theme/$theme.htm");
?>