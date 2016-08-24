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
	global $site, $status_site, $name_group, $god_site, $id_user, $name_site;
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
	if ($id == 0)
	{
		echo "<h3 align = \"center\">Все новости</h3><table>";
		$ok_page = mysql_query("select * from news order by id_news desc");
		{
			while ($t_page = mysql_fetch_array($ok_page))
			{
				$id = $t_page['id_news'];
				$name = $t_page['small_news'];
				$date = $t_page['date_news'];
				$tip = $t_page['tip'];
				$id_id = $t_page['id_id'];
				$date = date("d.m.y", strtotime($date));
				if ($tip == "0")
				{
					$tip = "Новости";
				}
				else
					if ($tip == "2")
					{
						$tip = name_mer($id_id);
					}
				echo "<tr><td>$date</td><td>$tip</td><td><a href = news.php?id=$id>$name</a></td></tr>";
			}
		}
		echo "</table>";
	}
	else
	{
	if ($id_user == "") {
        error(6);
    } else {
		$id = intval($id);
		$ok_page = mysql_query("select * from news where id_news = $id");
		{
			while ($t_page = mysql_fetch_array($ok_page))
			{
				$id = $t_page['id_news'];
				$name = $t_page['small_news'];
				$text = $t_page['full_news'];
				$date = $t_page['date_news'];
				$date = date("Y-m-d", strtotime($date));
				$date = format_date_html($date);
				$tip = $t_page['tip'];
				$id_id = $t_page['id_id'];
				if ($tip == "2")
				{
					$ok_page = mysql_query("select * from meropriatia where id = $id_id");
					while ($t_page = mysql_fetch_array($ok_page))
					{
						$id_con = $t_page['id_con'];
					}
					$ok_sibkon = mysql_query("SELECT * FROM `sibkon` WHERE `id` = $id_con");
					while ($t_sibkon = mysql_fetch_array($ok_sibkon))
					{
						$id_sibkon = $t_sibkon['id_con'];
						$god = $t_sibkon['god'];
						$tema = $t_sibkon['tema'];
					}
					$name_mer = name_mer($id_id);
					$tit = ": <a href = \"$site/sibkon.php?id=$god\">$god: $tema</a> | Новости | $name_mer";
					$dostup = dostup_mer($id_id);
				}
				else
					if ($tip == "0")
					{
						$dostup = "1";
					}
			}
		}
		if ($dostup == "1")
		{
			echo "<p>$name_site$tit | $date</p>";
			echo "<h3 align='center'>$name</h2>";
			echo "<p>$text</p>";
		}
		else
		{
			error(7);
		}
		$adm = dostup_adm();
		$god_org = dostup_org_god($god_site);
		if ($adm == 1 or $god_org == 1)
		{
			echo "<div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"news/edit.php?id=$id\">Редактировать</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div><p>";
		}
	}
	}
}
function title()
{
	global $name_site;
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
	$ok_page = mysql_query("select * from news where id_news = $id");
	{
		while ($t_page = mysql_fetch_array($ok_page))
		{
			$name = $t_page['small_news'];
		}
	}
	if ($id == "0")
	{
		echo "
<title>$name_site</title>";
	}
	else
	{
		echo "
<title>$name | $name_site</title>";
	}
}
function right()
{
	echo "<b>Последниe новости:</b><table>";
	$ok_news = mysql_query("select * from news order by id_news desc limit 0, 20;");
	while ($t_page = mysql_fetch_array($ok_news))
	{
		$id = $t_page['id_news'];
		$name = $t_page['small_news'];
		$date = $t_page['date_news'];
		$tip = $t_page['tip'];
		$id_id = $t_page['id_id'];
		$date = date("d.m.y", strtotime($date));
		if ($tip == "0")
		{
			$tip = "";
		}
		else
			if ($tip == "2")
			{
				$tip = name_mer($id_id);
				$tip = " ($tip)";
			}
		echo "<tr><td>$date</td><td><a href = news.php?id=$id>$name</a>$tip</td></tr>";
	}
	echo "</table>";
}
require ("theme/$theme/$theme.htm");
?>