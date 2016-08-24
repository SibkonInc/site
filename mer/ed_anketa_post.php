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
	$ok_page_a = mysql_query("select * from anketa where tip = 2 and id = $id");
	while ($t_page_a = mysql_fetch_array($ok_page_a))
	{
		$id_id = $t_page_a['id_id'];
	}
	$adm = dostup_adm();
	$org_god = dostup_org_god($god_site);
	$upravlenie = dostup_mer_adm($id_id);
	if ($upravlenie == "1")
	{
		$vopros = addslashes($_POST['vopros']);
		mysql_query(" UPDATE anketa SET vopros ='$vopros' where id = '$id'");
		header("Location: $site/mer/ed_anketa.php?id=$id_id");
	}
	else
	{
		header("Location: $site/error.php?i=7");
	}
}
?>