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
		$ok_page = mysql_query("select * from meropriatia where id = $id");
		{
			while ($t_page = mysql_fetch_array($ok_page))
			{
				$id_con = $t_page['id_con'];
			}
		}
		$name = addslashes($_POST['name']);
		$text = addslashes($_POST['text']);
		$dostup = addslashes($_POST['dostup']);
		mysql_query("insert into `page_sibkon`(id_con,name,text,tip,id_id,dostup) values('$id_con', '$name', '$text', '2', '$id', '$dostup')");
		$name_sibkon = name_sibkon($id_con);
		$name_mer = name_mer($id);
		$nit = mysql_insert_id();
		$mess_log = "Добавил материал к $name_mer <a href = \"$site/page_sibkon.php?id=$nit\">$name</a> к $name_sibkon";
		ad_log($mess_log);
		header("Location: $site/page_sibkon.php?id=$nit");
	}
	else
	{
		header("Location: $site/error.php?i=7");
	}
}
?>