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
	global $site, $tip_user, $name_site;
	if (isset($_GET['id']))
	{
		$id = addslashes($_GET['id']);
	}
	else
	{
		$id = "0";
	}
	if (!is_numeric($id))
	{
		die("Такой записи нет!");
	}
	$id = intval($id);
	$site_info = mysql_query("select * from setting_site");
	while ($site_i = mysql_fetch_array($site_info))
	{
		$name_site = $site_i['name_site'];
		$status_site = $site_i['status_site'];
		$status_text = $site_i['status_text'];
		$god = $site_i['god'];
		$st_glav = $site_i['st_glav'];
	}
	if ($st_glav == "0")
	{
		$glav = "news";
	}
	if ($id == "0")
	{
		if ($st_glav == "news")
		{
			echo "<h3 align = \"center\">Новости $name_site</h3>";
			$ok_page = mysql_query("select * from news order by id_news desc limit 0, 10");
			while ($t_page = mysql_fetch_array($ok_page))
			{
				$id = $t_page['id_news'];
				$name = $t_page['small_news'];
				$text = $t_page['full_news'];
				$date = $t_page['date_news'];
				$date = date("Y-m-d", strtotime($date));
				$date = format_date_html($date);
				echo "
				<div class=\"pane\">
					<div class=\"pane_p\">
						<div class=\"nccp\">
							$date | <b>$name</b>
						<br>		
						</div>
						<div class=\"text_block\">
							$text
						</div>
					</div>
				</div>
				";
			}
				echo "<a href=\"$site/news.php\">Все новости</a>";
		}
		else
			if ($st_glav == "anons")
			{
				$ok_page = mysql_query("select * from sibkon where god = $god");
				while ($t_page = mysql_fetch_array($ok_page))
				{
					$id_con = $t_page['id'];
					$god = $t_page['god'];
					$tema = $t_page['tema'];
					$text = $t_page['text'];
					$date_in = $t_page['date_in'];
					$date_out = $t_page['date_out'];
					$date_in1 = date("d", strtotime($date_in));
					$date_out1 = date("d", strtotime($date_out));
					$date_in_m = date("m", strtotime($date_in));
					$date_out1_m = date("m", strtotime($date_out));
					$date_out2 = format_date_mes($date_out);
					$date_out23 = format_date_mes($date_in);
					$date_god = date("Y", strtotime($date_out));
				}
				echo "<h2 align=\"center\"><b>$tema</b></h2>";
				if ($date_in_m == $date_out1_m)
				{
					$data = "$date_in1-$date_out1 $date_out2 $date_god";
				}
				else
				{
					$data = "$date_in1 $date_out23 - $date_out1 $date_out2 $date_out3";
				}
				echo "<div align=\"center\" class = \"title_page\">$data</div><p>$text";
				$dostup_adm = dostup_adm();
				$dostup_org = dostup_org_god($god);
				if ($dostup_adm == "1" or $dostup_org == "1")
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
			else
			{
				$ok_page = mysql_query("select * from page where id_page = $st_glav");
				while ($t_page = mysql_fetch_array($ok_page))
				{
					$page = $t_page['id_page'];
					$text = $t_page['text'];
					$nazvanie = $t_page['nazvanie'];
				}
				$title = "$nazvanie";
				echo "<p><h2 align=\"center\"><b>$nazvanie</b></h2>";
				echo "$text";
				$dostup_adm = dostup_adm();
				$dostup_org = dostup_org_god($god);
				if ($dostup_adm == "1" or $dostup_org == "1")
				{
					echo "<div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"$site/page/edit.php?id=$page\">Редактировать</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div><p>";
				}
			}
	}
	else
	{
		$ok_page = mysql_query("select * from page where id_page = $id");
		while ($t_page = mysql_fetch_array($ok_page))
		{
			$page = $t_page['id_page'];
			$text = $t_page['text'];
			$nazvanie = $t_page['nazvanie'];
		}
		$title = "$nazvanie";
		echo "<p><h2 align=\"center\"><b>$nazvanie</b></h2>";
		echo "$text";
		$dostup_adm = dostup_adm();
		$dostup_org = dostup_org_god($god);
		if ($dostup_adm == "1" or $dostup_org == "1")
		{
			echo "<div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"$site/page/edit.php?id=$page\">Редактировать</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div><p>";
		}
	}
}
function title()
{
	global $id_us, $name_site;
	if (isset($_GET['id']))
	{
		$id = addslashes($_GET['id']);
	}
	else
	{
		$id = 1;
	}
	if (!is_numeric($id))
	{
		die("Такой записи нет!");
	}
	$id = intval($id);
	$ok_page = mysql_query("select * from page where id_page = $id");
	while ($t_page = mysql_fetch_array($ok_page))
	{
		$page = $t_page['id_page'];
		$text = $t_page['text'];
		$nazvanie = $t_page['nazvanie'];
	}
	if ($id == 1)
	{
		echo "
<title>$name_site</title>";
	}
	else
	{
		echo "
<title>$nazvanie | $name_site</title>";
	}
}
function right()
{
	global $site;
	echo "<div align=\"center\"><b><a href=\"$site/news.php\">Все новости</a></b></div><table>";
	$ok_news = mysql_query("select * from news where id_id = 0 order by id_news desc limit 0, 5;");
	while ($t_news = mysql_fetch_array($ok_news))
	{
		$id = $t_news['id_news'];
		$name_news = $t_news['small_news'];
		$time = $t_news['date_news'];
		$time1 = date("d.m.y", strtotime($time));
		echo "<tr><td>$time1</td><td><a href = \"$site/news.php?id=$id\">$name_news</a></td></tr>";
	}
	echo "</table><br><div align=\"center\"><b><a href=\"$site/forum.php\">Форум</a></b></div><table>";
	$ok_news = mysql_query("select * from forum where org = 0 and pr_zap = 0 order by id desc limit 0, 5;");
	while ($t_news = mysql_fetch_array($ok_news))
	{
		$id = $t_news['id'];
		$name = $t_news['name'];
        $id_us = $t_news['id_us'];
        $user = user_info($id_us);
		echo "<tr><td>$user</td><td><a href = \"$site/forum.php?id=$id\">$name</a></td></tr>";
	}
    echo"</table><br>";
	//	echo "<div align=\"center\"><b><a href=\"$site/news.php\">Новости проектов</a></b></div><table>";
	//$ok_news = mysql_query("select * from news where tip = 2 order by id_news desc limit 0, 5;");
	//while ($t_news = mysql_fetch_array($ok_news))
	//{
	//	$id = $t_news['id_news'];
	//	$name_news = $t_news['small_news'];
    //   $id_id = $t_news['id_id'];
	//	$time = $t_news['date_news'];
	//	$time1 = date("d.m.y", strtotime($time));
    //   $name_mer = name_mer($id_id );
	//	echo "<tr><td>$time1</td><td>$name_mer: <a href = \"$site/news.php?id=$id\">$name_news</a></td></tr>";
	//}
    //echo"</table><br>";
    
    
    baner();
    ?>
    <script type="text/javascript" src="http://vkontakte.ru/js/api/openapi.js?10"></script>

<!-- VK Widget -->
<div id="vk_groups"></div>
<script type="text/javascript">
VK.Widgets.Group("vk_groups", {mode: 0, width: "350"}, 11504414);
</script>
    <?
}
require ("theme/$theme/$theme.htm");
?>