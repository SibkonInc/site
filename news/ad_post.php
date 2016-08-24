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
	$name = ($_POST['name']);
	$text = ($_POST['text']);
	$date = ($_POST['date']);
	$date_news = date("Y-m-d H:i");
	mysql_query("insert into `news`(small_news,full_news,date_news) values('$name', '$text', '$date')");
	$nit = mysql_insert_id();
	$mess_log = "Добавил новость <a href = \"$site/news.php?id=$nit\">$name</a>";
	ad_log($mess_log);
	header("Location: $site/news.php?id=$nit");
}
else
{
	header("Location: $site/error.php?i=7");
}
?>