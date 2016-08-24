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
	$id = intval($id);
	if ($id == "0")
	{
		error(1);
	}
	else
	{
		$ok_page = mysql_query("select * from page_sibkon where id = $id");
		{
			while ($t_page = mysql_fetch_array($ok_page))
			{
				$id = $t_page['id'];
				$name = $t_page['name'];
				$text = nl2br($t_page['text']);
				$id_con = $t_page['id_con'];
				$tip = $t_page['tip'];
				$id_id = $t_page['id_id'];
				$dostup = $t_page['dostup'];
			}
		}
		$ok_sibkon = mysql_query("SELECT * FROM `sibkon` WHERE `id` = $id_con");
		while ($t_sibkon = mysql_fetch_array($ok_sibkon))
		{
			$id_sibkon = $t_sibkon['id_con'];
			$god = $t_sibkon['god'];
			$tema = $t_sibkon['tema'];
		}
		$name_sibkon = name_sibkon($id_con);
		if ($tip == "2")
		{
			$dos = dostup_mer($id_id);
			if ($dos = "0")
			{
				$dostupm = dostup_mer_user($id_id);
				if ($dostupm == "1")
				{
					$ok = 1;
				}
				else
				{
					$ok = 0;
				}
			}
			else
			{
				if ($dostup == "1")
				{
					$dostupm = dostup_mer_user($id_id);
					if ($dostupm == "1")
					{
						$ok = 1;
					}
					else
					{
						$ok = 0;
					}
				}
				else
				{
					$ok = 1;
				}
			}
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
			$tit = " | $name_mer";
		}
		else
			if ($tip == "0")
			{
				$ok = "1";
			}
		if ($ok == "1")
		{
			echo "<p><a href = \"$site/sibkon.php?id=$god\">$name_site $god: $tema</a> | Материалы$tit </p>";
			echo "<h3 align='center'>$name</h2>";
			echo "<p>$text</p>";
		}
		else
		{
			error(7);
		}
		$adm = dostup_adm();
		$god_org = dostup_org_god($god);
		$upravlenie1 = dostup_mer_adm($id_id);
		if ($adm == 1 or $god_org == 1 or $upravlenie1 == 1)
		{
			echo "<div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"$site/page_sibkon/edit.php?id=$id\">Редактировать</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div><p>";
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
	$ok_page = mysql_query("select * from page_sibkon where id = $id");
	{
		while ($t_page = mysql_fetch_array($ok_page))
		{
			$name = $t_page['name'];
		}
	}
	echo "
<title>$name | $name_site</title>";
}
function right()
{
	global $site, $status_site;
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
	if ($status_site == "2")
	{
		$ok_page = mysql_query("select * from page_sibkon where id = $id");
		if (!mysql_num_rows($ok_page)) die("error(12).<p>");
		else
		{
			while ($t_page = mysql_fetch_array($ok_page))
			{
				$id_id = $t_page['id_id'];
				$id_con = $t_page['id_con'];
				$tip = $t_page['tip'];
			}
		}
        $name_mer = name_mer($id_id);
		if ($tip == "0")
			{
		echo "Материалы к Сибкону";
			}
			else
		echo "Материалы к $name_mer";
        echo "<table>";
		$ok_page_s = mysql_query("select * from page_sibkon where id_id = $id_id and id_con = $id_con");
		{
			while ($t_page_s = mysql_fetch_array($ok_page_s))
			{
				$id_page = $t_page_s['id'];
				$name_page = $t_page_s['name'];
				global $site;
				echo "<tr><td><a href =\"$site/page_sibkon.php?id=$id_page\" >$name_page</a></td></tr>";
			}
		}
		echo "</table>";
	}
	else
	{
		$ok_page = mysql_query("select * from page_sibkon where id = $id");
		if (!mysql_num_rows($ok_page)) die("error(12).<p>");
		else
		{
			while ($t_page = mysql_fetch_array($ok_page))
			{
				$id_con = $t_page['id_con'];
			}
		}
		echo "<br><div id=\"accordion\"><h3><a href=\"#\">Материалы</a></h3><div>";
		$ok_page_s = mysql_query("select * from page_sibkon where id_con = $id_con");
		{
			while ($t_page_s = mysql_fetch_array($ok_page_s))
			{
				$id_page = $t_page_s['id'];
				$name_page = $t_page_s['name'];
				global $site;
				echo "<a href =\"$site/page_sibkon.php?id=$id_page\" >$name_page</a><br><br>";
			}
		}
		echo "</div>";
		$ok_page_t = mysql_query("select * from tip_mer");
		while ($t_page_t = mysql_fetch_array($ok_page_t))
		{
			$id_tip = $t_page_t['id'];
			$name_tip = $t_page_t['name'];
			echo "<h3><a href=\"#\">$name_tip</a></h3><div>";
			$ok_page_m = mysql_query("select * from meropriatia where id_con = $id_con and tip = $id_tip");
			while ($t_page_m = mysql_fetch_array($ok_page_m))
			{
				$id_mer = $t_page_m['id'];
				$name_mer = $t_page_m['name'];
				echo "<a href = \"$site/mer.php?id=$id_mer\">$name_mer</a><br><br>";
			}
			echo "</div>";
		}
		echo "</div>";
	}
}
require ("theme/$theme/$theme.htm");
?>