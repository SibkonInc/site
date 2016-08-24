<?php
/**
 * @author нукшсл
 * @copyright 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
$adm = dostup_adm();
if ($adm == "1")
{
	if (isset($_GET['id']))
	{
		$id = addslashes($_GET['id']);
	}
	else
	{
		$id = 1;
	}
	if (!is_numeric($id))
	{
		die("Такой записи нет!");
	}
	$id = intval($id);
	$ok_page = mysql_query("select * from meropriatia where id = $id");
	if (!mysql_num_rows($ok_page)) die("error(12).<p>");
	else
	{
		while ($t_page = mysql_fetch_array($ok_page))
		{
			$page = $t_page['id'];
			$nazvanie = $t_page['name'];
			$id_con = $t_page['id_con'];
			$ok_page = mysql_query("select * from sibkon where id = $id_con");
			if (!mysql_num_rows($ok_page)) die("error(12).<p>");
			else
			{
				while ($t_page = mysql_fetch_array($ok_page))
				{
					$id_con = $t_page['id'];
					$god = $t_page['god'];
					$tema = $t_page['tema'];
				}
			}
			$ok_tip = mysql_query("SELECT * FROM org where id_org = $id_user and god = $god");
			while ($t_tip = mysql_fetch_array($ok_tip))
			{
				$id_o = $t_tip['id'];
				$id_org = $t_tip['id_org'];
				$god = $t_tip['god'];
			}
			echo iconv("CP1251", "utf-8", "
<a href= \"$site/mer/del_post.php?id=$page\">Вы хотите удалить \"$nazvanie\"</a> ?");
		}
	}
}
else
{
	echo iconv("CP1251", "utf-8", "
Нет доступа. Удалить может только администратор");
}
?>