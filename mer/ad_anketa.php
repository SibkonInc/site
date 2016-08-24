<?php
/**
 * @author yerick
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
		$vopros = addslashes($_POST['vopros']);
		mysql_query("insert into `anketa`(id_id,tip,vopros) values('$id', '2', '$vopros')");
		header("Location: $site/mer/ed_anketa.php?id=$id");
	}
	else
	{
		header("Location: $site/error.php?i=7");
	}
}
?>