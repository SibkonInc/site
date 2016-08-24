<?php
/**
 * @author нукшсл
 * @copyright 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
global $id_user, $tip_user, $site, $god_site;
$adm = dostup_adm();
if ($adm == "1")
{
	$name = ($_POST['name']);
	$on = ($_POST['on']);
	$file = ($_POST['file']);
    mysql_query("insert into `module`(`name` , `on` , `file` ) values('$name', '$on', '$file')");
  

	$nit = mysql_insert_id();
	$mess_log = "Добавил модуль <a href = $site/module.php?id=$nit>$name</a>";
	ad_log($mess_log);
	header("Location: $site/admin.php?id=11");
}
else
{
	error(7);
}
?>