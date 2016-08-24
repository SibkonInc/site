<?php
/**
 * @author нукшсл
 * @copyright 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
if ($id_user == "")
{
	header("Location: $site/error.php?i=7");
}
else
{
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
	$upravlenie = dostup_mer_adm($id);
	if ($upravlenie == "1")
	{
		$name = ($_POST['name']);
		$text = ($_POST['text']);
		$date = ($_POST['date']);
		$date_news = date("Y-m-d H:i");
		mysql_query("insert into `news`(small_news,full_news,date_news,tip,id_id) values('$name', '$text', '$date', '2', '$id')");
		$nit = mysql_insert_id();
		header("Location: $site/news.php?id=$nit");
	}
	else
	{
		header("Location: $site/error.php?i=7");
	}
}
?>