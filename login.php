<?
$login_us = mysql_escape_string($_POST['login']);
$pass_us = mysql_escape_string($_POST['pass_us']);
$aliens = mysql_escape_string($_POST['aliens']);
$url = mysql_escape_string($_POST['url']);
$pass_us = md5($pass_us);
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
$sql = "select * From us where login_us = '" . $login_us . "' and pass_us = '" .
	$pass_us . "'";
$result = mysql_query($sql);
while ($link = mysql_fetch_array($result, MYSQL_ASSOC))
{
	$act_us = "$link[act_us]";
	$id = "$link[id_us]";
	$nick_us = "$link[nick_us]";
	$tip_us = "$link[tip_us]";
	$k = "$link[k]";
}
if ($id == "")
{
	header("Location: $site/error.php?i=3");
}
else
{
	if ($act_us == 0 or $tip_us == 9)
	{
		header("Location: $site/error.php?i=4");
	}
	else
	{
		if ($aliens == "")
		{
			SetCookie('id_us', $id, time() + 60 * 60 * 24 * 30);
			SetCookie('ktip_us', $k, time() + 60 * 60 * 24 * 30);
		}
		else
		{
			SetCookie('id_us', $id);
			SetCookie('ktip_us', $k);
		}
		$date_news = date("Y-m-d H:i");
		mysql_query("insert into `log`(data,name,whot) values('$date_news', '$id', 'Вошел в систему')");
		header("Location: $site");
		$date_news = date("Y-m-d H:i");
	}
}
?>