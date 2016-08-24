<?php
/**
 * @author нукшсл
 * @copyright 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=windows-1251\">";
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
	$adm = dostup_adm();
	$org = dostup_org();

if ($adm == "1" or $org == "1" or $master = $id)
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
	$ok_page = mysql_query("select * from comand_us where id = $id");
	while ($t_page = mysql_fetch_array($ok_page))
	{
		$id_us = $t_page['id_us'];
		$user = user_inf($id_us);
		echo "<a href= \"$site/command/del_user_post.php?id=$id\">Вы хотите удалить \"$user\" из команды?</a> ?";
	}
}
else
{
	error(7);
}
?>