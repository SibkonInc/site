<?php
/**
 * @author нукшсл
 * @copyright 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
$adm = dostup_adm();
$org = dostup_org_god($god_site);
if ($adm == "1" or $org == "1")
{
	$id = ($_GET['id']);
	$name = ($_POST['name']);
	$text = ($_POST['text']);
	$date = ($_POST['date']);
	mysql_query(" UPDATE news SET small_news='$name', full_news='$text', date_news='$date' where id_news = '$id'");
	$mess_log = "Изменил новость <a href = \"$site/news.php?id=$id\">$name</a>";
	ad_log($mess_log);
	header("Location: $site/news.php?id=$id");
}
else
{
	header("Location: $site/error.php?i=7");
}
?>