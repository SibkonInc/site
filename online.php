<?php
/**
 * @author нукшсл
 * @copyright 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
function action()
{
	global $id_user, $site;
	$timeonline = date("YmdHi");
	$timeonline = $timeonline - 5;
	$online = mysql_query("select * from online  WHERE `time` > $timeonline");
	$itog_reg1 = mysql_num_rows($online);
	echo "<p><strong>Сейчас на сайте: $itog_reg1</strong>";
	echo "<table id=\"example\" class=\"display\">";
	$online1 = mysql_query("select * from online  WHERE `time` > $timeonline");
	while ($online_s = mysql_fetch_array($online1))
	{
		$id_us = $online_s['id_us'];
		$query = "select * From `us` where `id_us` = $id_us ";
		$result = mysql_query($query);
		while ($link = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$tip_us = "$link[tip_us]";
			$nick_us = "$link[nick_us]";
			$gorod = "$link[gorod_us]";
            $name = "$link[name_us]";
            $fam = "$link[fam_us]";
			if ($tip_us == "9")
			{
				$nick_us = "<strike>$nick_us</strike>";
			}
			$info = "<a href = \"$site/profile.php?id=$id_us\">$nick_us</a>";
			$adm = dostup_adm();
			if ($adm == 1)
			{
				$info = "$info <a href = \"$site/log_per.php?id=$id_us\">П</a>";
			}
		}
		$pict = "user/photo/$id_us.jpg";
		if (file_exists($pict))
		{
			list($width, $height, $type, $attr) = getimagesize($pict);
			if ($height > $width)
			{
				$vis1 = height;
			}
			else
			{
				$vis1 = width;
			}
		}
		else
		{
			$pict = "img/no.jpg";
		}
		echo "<tr><td width = \"80\"><img src= \"$site/$pict\" $vis1=\"60\" border=\"0\" alt=\"Инфо\" align=\"left\" ></td><td>$info<br><font color=\"#676666\">$name $fam<br>$gorod</font></td><td><a href = \"$site/message.php?id=$id_us\">Написать сообщение</a><br><a href = \"$site/query.php?id_user=$id_us\">Пригласить</a></tr>";
	}
	echo "</table>";
}
function title()
{
	global $name_site,$site;
	
	echo "
<title>Пользователи на сайте | $name_site</title>
";
}
function right()
{
}
require ("theme/$theme/$theme.htm");
?>