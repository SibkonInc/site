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
	if (isset($_GET['id']))
	{
		$id = addslashes($_GET['id']);
	}
	else
	{
		$id = 0000;
	}
	if (!is_numeric($id))
	{
		die("Такой записи нет!");
	}
	$id = intval($id);
	if ($id == 0000)
	{
		$ok_page = mysql_query("select * from sibkon where god = '0000' ");
	}
	else
	{
		$ok_page = mysql_query("select * from sibkon where god = $id");
	}
	if (!mysql_num_rows($ok_page)) die("error(12).<p>");
	else
	{
		while ($t_page = mysql_fetch_array($ok_page))
		{
			$id_con = $t_page['id'];
			$god = $t_page['god'];
			$tema = $t_page['tema'];
			$text = $t_page['text'];
			$date_in = $t_page['date_in'];
			$date_out = $t_page['date_out'];
			$date_in1 = date("d", strtotime($date_in));
			if (!($id == 0000))
			{
				$date_out1 = date("d", strtotime($date_out));
				$date_in_m = date("m", strtotime($date_in));
				$date_out1_m = date("m", strtotime($date_out));
				$date_out2 = format_date_mes($date_out);
				$date_out23 = format_date_mes($date_in);
				$date_god = date("Y", strtotime($date_out));
			}
			$ob = $t_page['ob'];
			$den = $t_page['den'];
			$noc = $t_page['noc'];
			$lux = $t_page['lux'];
			$krov = $t_page['krov'];
			$spal = $t_page['spal'];
			$orgvzos = $t_page['orgvzos'];
			$st_lux = $t_page['st_lux'];
			$st_spa = $t_page['st_spa'];
			$st_kro = $t_page['st_kro'];
			$data_reg = $t_page['data_reg'];
			$data_pod = $t_page['data_pod'];
			$data_pos = $t_page['data_pos'];
		}
	}
	echo "<div align=\"center\" class = \"title_page\"><h2><a>$tema</a></h2></div>";
	if (!($id == 0000))
	{
		if ($date_in_m == $date_out1_m)
		{
			$data = "$date_in1-$date_out1 $date_out2 $date_god";
		}
		else
		{
			$data = "$date_in1 $date_out23 - $date_out1 $date_out2 $date_out3";
		}
	}
	echo "<div align=\"center\" class = \"title_page\">$data</div><p>$text";
	$adm = dostup_adm();
	$god_org = dostup_org_god($god);
	if ($adm == 1 or $god_org == 1)
	{
		echo "<div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"sibkon/edit.php?id=$id_con\">Редактировать</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div><p>";
	}
}
function title()
{
	global $id_us;
	$site_info = mysql_query("select * from setting_site");
	if (!mysql_num_rows($site_info)) die("Данные о сайте не получены.");
	else
	{
		while ($site_i = mysql_fetch_array($site_info))
		{
			$name_site = $site_i['name_site'];
			$status_site = $site_i['status_site'];
			$status_text = $site_i['status_text'];
			$theme = $site_i['theme'];
		}
	}
	if (isset($_GET['id']))
	{
		$id = addslashes($_GET['id']);
	}
	else
	{
		$id = 0000;
	}
	if (!is_numeric($id))
	{
		die("Такой записи нет!");
	}
	$id = intval($id);
	if ($id == 0000)
	{
		$ok_page = mysql_query("select * from sibkon where god = '0000' ");
	}
	else
	{
		$ok_page = mysql_query("select * from sibkon where god = $id");
	}
	while ($t_page = mysql_fetch_array($ok_page))
	{
		$id_con = $t_page['id'];
		$god = $t_page['god'];
		$tema = $t_page['tema'];
	}
	echo "
<title>$name_site $god: $tema</title>";
}
function right()
{
	global $site;
	if (isset($_GET['id']))
	{
		$id = addslashes($_GET['id']);
	}
	else
	{
		$id = 0000;
	}
	if (!is_numeric($id))
	{
		die("Такой записи нет!");
	}
	$id = intval($id);
	if ($id == 0000)
	{
		echo "<h4>Все проекты</h4>";
		echo "<ul>";
		$ok_page = mysql_query("select * from sibkon where god >0000 order by god desc ");
		if (!mysql_num_rows($ok_page)) die("error(12).<p>");
		else
		{
			while ($t_page = mysql_fetch_array($ok_page))
			{
				$id_con = $t_page['id'];
				$god = $t_page['god'];
				$tema = $t_page['tema'];
				echo "<li><a href = \"$site/sibkon.php?id=$god\">$god: $tema</a></li>";
			}
		}
		echo "</ul>";
	}
	else
	{
		$ok_page = mysql_query("select * from sibkon where god = $id");
		if (!mysql_num_rows($ok_page)) die("error(12).<p>");
		else
		{
			while ($t_page = mysql_fetch_array($ok_page))
			{
				$id_con = $t_page['id'];
				$god = $t_page['god'];
				$tema = $t_page['tema'];
				$date_in = $t_page['date_in'];
				$date_out = $t_page['date_out'];
				$ob = $t_page['ob'];
				$den = $t_page['den'];
				$noc = $t_page['noc'];
				$lux = $t_page['lux'];
				$krov = $t_page['krov'];
				$spal = $t_page['spal'];
				$orgvzos = $t_page['orgvzos'];
				$st_lux = $t_page['st_lux'];
				$st_spa = $t_page['st_spa'];
				$st_kro = $t_page['st_kro'];
				$data_reg = $t_page['data_reg'];
				$data_pod = $t_page['data_pod'];
				$data_pos = $t_page['data_pos'];
			}
		}
		echo "<br><div id=\"accordion\"><h3><a href=\"#\">Материалы</a></h3><div>";
		$ok_page_s = mysql_query("select * from page_sibkon where id_con = $id_con");
		while ($t_page_s = mysql_fetch_array($ok_page_s))
		{
			$id_page = $t_page_s['id'];
			$name_page = $t_page_s['name'];
			echo "<a href =\"$site/page_sibkon.php?id=$id_page\" >$name_page</a><br><br>";
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