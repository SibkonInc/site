<?php
/**
 * @author нукшсл
 * @copyright 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
global $id_user;
if ($id_user == "")
{
	header("Location: $site/error.php?i=6");
}
else
{
	$name = addslashes($_POST['name']);
	$text = addslashes($_POST['text']);
	$tip = addslashes($_POST['tip']);
	$tip_u = addslashes($_POST['tip_u']);
	$tp = addslashes($_POST['tp']);
	$adm = addslashes($_POST['adm']);
	$files = addslashes($_POST['files']);
	$forum = addslashes($_POST['forum']);
	mysql_query("insert into `command`(name,tip,text,tp,adm,files,forum,tip_u) values('$name', '$tip', '$text', '$tp', '$adm', '$files', '$forum', '$tip_u')");
	$nit = mysql_insert_id();
	mysql_query("insert into `comand_us`(id_command,id_us,tip) values('$nit', '$id_user', '1')");
	$mess_log = "Создал команду <a href = \"$site/command.php?id=$nit\">$name</a>";
	ad_log($mess_log);
	header("Location: $site/command.php?id=$nit");
}
?>