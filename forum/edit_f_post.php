<?php
/**
 * @author нукшсл
 * @copyright 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
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
//$adm = dostup_adm();
//if ($adm == "1")
//{
	$name = addslashes($_POST['name']);
	$text = addslashes($_POST['text']);
	$org = addslashes($_POST['org']);
	$pr_zap = addslashes($_POST['pr_zap']);
	mysql_query(" UPDATE forum SET  name ='$name', text='$text', org='$org', pr_zap='$pr_zap' where id = '$id'");
	
	$mess_log = "Изменил Форум <a href = $site/forum.php?id=$id>$name</a>";
	ad_log($mess_log);
	header("Location: $site/forum.php?id=$id");
//}
//else
//{
//	header("Location: $site/error.php?i=7");
//}
?>