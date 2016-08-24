<?php
/**
 * @author нукшсл
 * @copyright 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
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
		$id = 1;
	}
	if (!is_numeric($id))
	{
		die("Такой записи нет!");
	}
	$id = intval($id);
	$ok_page = mysql_query("select * from news where id_news = $id");
	if (!mysql_num_rows($ok_page)) die("error(12).<p>");
	else
	{
		while ($t_page = mysql_fetch_array($ok_page))
		{
			$page = $t_page['id_news'];
			$nazvanie = $t_page['small_news'];
			$mess_log = "Удалил новость $page $nazvanie";
			ad_log($mess_log);
			mysql_query("DELETE FROM news WHERE   id_news = '$page'");
			header("Location: $site/admin.php?id=4");
		}
	}
}
else
{
	header("Location: $site/error.php?i=7");
}
?>