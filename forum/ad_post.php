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
	header("Location: $site/error.php?i=6");
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
	if (isset($_GET['t']))
	{
		$t = addslashes($_GET['t']);
	}
	else
	{
		$t = 0;
	}
	if (!is_numeric($t))
	{
		die("Такой записи нет!");
	}
	if (isset($_GET['m']))
	{
		$m = addslashes($_GET['m']);
	}
	else
	{
		$m = 0;
	}
	if (!is_numeric($m))
	{
		die("Такой записи нет!");
	}
	$name = addslashes($_POST['name']);
	$text = addslashes($_POST['text']);
	$dostup = addslashes($_POST['dostup']);
	$date = date("Y-m-d H:i");
	mysql_query("insert into `forum`(id_us,tip,name,text,date,pr_zap,org,m,dostup,data_old) values('$id_user','1', '$name', '$text', '$date', '$id', '$t', '$m', '$dostup', '$date')");
	$nit = mysql_insert_id();
	$mess_log = "Добавил форум <a href = \"$site/forum.php?id=$nit\">$name</a>";
	ad_log($mess_log);
	header("Location: $site/forum.php?id=$nit");
}
?>