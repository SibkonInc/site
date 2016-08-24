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
	$id = addslashes($_GET['id']);
	$name = addslashes($_POST['name']);
	$on = addslashes($_POST['on']);
	$file = addslashes($_POST['file']);
	mysql_query("UPDATE `module` SET `name` ='$name', `on` ='$on', `file` ='$file' where `id` = '$id'");
	$mess_log = "Изменил модуль <a href = $site/module.php?id=$id>$name</a>";
	ad_log($mess_log);
header("Location: $site/admin.php?id=11");
}
else
{
	header("Location: $site/error.php?i=7");
}
?>