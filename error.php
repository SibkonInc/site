<?php
/**
 * @author Yerick
 * @copyright 2009
 * @name YCMS 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
function action()
{
	$i = mysql_escape_string($_GET['i']);
	if (!is_numeric($i))
	{
		die("������ ����������� �������� ������");
	}
	$i = intval($i);
	$ok_er = mysql_query("select * from error where id = '" . $i . "'");
	while ($t_er = mysql_fetch_array($ok_er))
	{
		$text = $t_er['text'];
	}
	echo "
<div align=\"center\"><h2>��,�������� �����!</h2>
������� ������:
<br><h2><font color = red>$text </font></h2>
</div>
";
}
function title()
{
	global $name_site;
	echo "
<title>������! | $name_site</title>";
}
function right()
{
}
require ("theme/$theme/$theme.htm");
?>