<?
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
$SERVER_NAME = $_SERVER[SERVER_NAME];
$site = "$SERVER_NAME";
$head = "<?xml version='1.0'?>\n<rss version='2.0'><channel>";
$head .= "\n\t<link>$site</link>";
$ok_news = mysql_query("select * from `news`   order by id_news desc LIMIT 0,20");
$head .= "\n\t<description>$name_site news</description>";
$head .= "\n\t<title>Новости $name_site</title>";
while ($t_news = mysql_fetch_array($ok_news))
{
	$id = $t_news['id_news'];
	$small_news = $t_news['small_news'];
	$text = htmlspecialchars($t_news['full_news']);
	$date = $t_news['date_news'];
	$body .= "\n\t<item>";
	$body .= "\n\t\t<title>$small_news</title>";
	$body .= "\n\t\t<pubDate>" . date("r", strtotime($date)) . "</pubDate>";
	$body .= "\n\t\t<link>http://$site/news.php?id=$id</link>";
	$body .= "\n\t\t<description>$text</description>";
	$body .= "\n\t</item>";
	if (!isset($LastModifed)) $LastModifed = date("r", strtotime($date));
}
$tail = "\n</channel></rss>";
//$head .= "\n\t<LastModifed>$LastModifed</LastModifed>";
header('Connection: close');
header("Last-Modified: $LastModifed");
header("Content-type: text/xml; charset=utf-8");
echo iconv("CP1251", "utf-8", $head . $body . $tail);
?>