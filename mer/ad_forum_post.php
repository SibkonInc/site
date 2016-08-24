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
    $name = addslashes($_POST['name']);
	$text = addslashes($_POST['text']);
	$dostup = addslashes($_POST['dostup']);
    $name_mer = name_mer($id);
	$date = date("Y-m-d H:i");
	mysql_query("insert into `forum`(id_us,tip,name,text,date,pr_zap,org,m,dostup) values('$id_user','2', '$name', '$text', '$date', '$id', '2', '0', '$dostup')");
	$nit = mysql_insert_id();
	$mess_log = "Добавил форум к $name_mer<a href = \"$site/forum.php?id=$nit\">$name</a>";
	ad_log($mess_log);
	header("Location: $site/forum.php?id=$nit");
}
?>