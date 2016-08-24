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
	$ok_page = mysql_query("select * from module where id = $id");
	if (!mysql_num_rows($ok_page)) die("error(12).<p>");
	else
	{
		while ($t_page = mysql_fetch_array($ok_page))
		{
			$page = $t_page['id'];
			$nazvanie = $t_page['name'];

			echo iconv("CP1251", "utf-8", "
<a href= \"$site/module/del_post.php?id=$page\">Вы хотите удалить \"$nazvanie\"</a> ?");
		}
	}
}
else
{
	echo iconv("CP1251", "utf-8", "
Нет доступа. Удалить может только администратор");
}
?>