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
$id = intval($id);
$master = dostup_comand($id);
if ($master == 1)
{
	$name = addslashes($_POST['name']);
	$text = addslashes($_POST['text']);
	$tip = addslashes($_POST['tip']);
	$tip_u = addslashes($_POST['tip_u']);
	$tp = addslashes($_POST['tp']);
	$adm = addslashes($_POST['adm']);
	$files = addslashes($_POST['files']);
	$forum = addslashes($_POST['forum']);
	mysql_query(" UPDATE command SET name='$name', text='$text', tip='$tip', tip_u='$tip_u', tp='$tp', adm='$adm', files='$files', forum='$forum' where id = '$id'");
	$mess_log = "Изменил команду <a href = \"$site/command.php?id=$id\">$name</a>";
	ad_log($mess_log);
	header("Location: $site/command.php?id=$id");
}
else
{
	header("Location: $site/error.php?i=7");
}
?>