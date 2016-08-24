<?php
/**
 * @author Yerick
 * @copyright 2009
 * @name YCMS 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
function forum($id)
{
	global $id_user, $site;
	$ok_page = mysql_query("select * from orgforum where id = $id");
	while ($t_page = mysql_fetch_array($ok_page))
	{
		$id = $t_page['id'];
		$name = $t_page['name'];
		$t = $t_page['org'];
		$com_count = $t_page['com_count'];
		$id_us = $t_page['id_us'];
		$avtor = user_info($id_us);
		$date = $t_page['date'];
		$time = date("H:i", strtotime($date));
		$date = date("Y-m-d", strtotime($date));
		$date = format_date_html($date);
		$text = nl2br($t_page['text']);
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
	}
	$q = "SELECT count(*) FROM `orgcomment` where `id_page` = $id";
	$res = mysql_query($q);
	$row = mysql_fetch_row($res);
	$total_rows = $row[0];
	echo "<p><b><a href = \"$site/orgforum.php\">Орг Форум</a> | $name</b></p>";
	echo "Всего  $total_rows комментов (далее по 20 на странице)";
	echo "<div class = \"str\">";
	$per_page = 20;
	$num_pages = ceil($total_rows / $per_page);
	for ($i = 1; $i <= $num_pages; $i++)
	{
		if ($str == $i)
		{
			echo "<b>$i</b>";
		}
		else
		{
			echo "<a href=\"$site/orgforum.php?id=$id&amp;str=$i\">$i</a>";
		}
	}
	echo "</div><p>";
	if (isset($_GET['st']))
	{
		$st = addslashes($_GET['st']);
	}
	else
	{
		$st = "";
	}
	if (isset($_GET['str'])) $str = ($_GET['str'] - 1);
	else  $str = 0;
	$str = intval($str);
	$start = abs($str * $per_page);
	if ($str < "1")
	{
		echo "
<div class=\"pane\">
<div class=\"pane_p\">
<img src= \"$pict\" $vis1=\"40\" border=\"0\" alt=\"Инфо\" align=\"left\" >
<div class=\"nccp\">
$avtor<br>
$date $time
</div><br>
<div class=\"text_block\">$text</div>
</div>
</div>";
	}
	$ok_com = mysql_query("select * from `orgcomment` where `id_page` = $id order by id_com LIMIT $start,$per_page");
	while ($row = mysql_fetch_array($ok_com))
	{
		$id_com = $row['id_com'];
		$id_us_com = $row['id_us'];
		$text_com = nl2br($row['text']);
		$avtor_com = user_info($id_us_com);
		$com_otv = $row['com_otv'];
		$date_com = $row['date'];
		$time_com = date("H:i", strtotime($date_com));
		$date_com = date("Y-m-d", strtotime($date_com));
		$date_com = format_date_html($date_com);
		$pic_com = "user/photo/$id_us_com.jpg";
		if (file_exists($pic_com))
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
			$pic_com = "img/no.jpg";
		}
		echo "<a name='$id_com'>
<div class=\"pane\">
	<div class=\"pane_p\">
	<img src= \"$pic_com\" $vis1=\"40\" border=\"0\" align=\"left\" alt=\"Инфо\">
		<div class=\"nccp\">
			$avtor_com<br>
			$date_com $time_com
		</div>
		<br>
		<div class=\"text_block\">
			$text_com
		</div>
		<div id=\"exp$id_com\"></div>
		<div class=\"nccp\">";
		if (!($com_otv == "0"))
		{
			echo "<script type=\"text/javascript\">jQuery(document).ready(function(){jQuery('#examp$id_com$id_com').click(function(){jQuery('#exp$id_com').load('$site/orgforum/com_text.php?id=$com_otv');})});</script>    
		<a id=\"examp$id_com$id_com\">это ответ на...</a> | Ветка сообщений | ";
		}
		if (!($id_user == ""))
		{
			echo "<a href='javascript:reply($id,$id_com);'>Ответить на сообщение</a>";
		}
		echo "<div id=f$id_com></div>
		</div>
	</div>
</div>";
	}
	if (isset($_GET['st']))
	{
		$st = addslashes($_GET['st']);
	}
	else
	{
		$st = "";
	}
	if (isset($_GET['str'])) $str = ($_GET['str']);
	else  $str = 0;
	$str = intval($str);
	$q = "SELECT count(*) FROM `orgcomment` where `id_page` = $id";
	$res = mysql_query($q);
	$row = mysql_fetch_row($res);
	$total_rows = $row[0];
	echo "<p>Всего  $total_rows комментов (по 20 на странице)";
	echo "<div class = \"str\">";
	$per_page = 20;
	$num_pages = ceil($total_rows / $per_page);
	for ($i = 1; $i <= $num_pages; $i++)
	{
		if ($str == $i)
		{
			echo "<b>$i</b>";
		}
		else
		{
			echo "<a href=\"$site/orgforum.php?id=$id&amp;str=$i\">$i</a>";
		}
	}
	echo "</div><p>";
?>
<script type="text/javascript">
$(function () { 
	$('form').submit(function () {
		$('input[type="submit"]', this).replaceWith('<p><strong>Ждите ответа в следующей серии...</strong></p>');
	});
});
</script>   
<?
	if ($id_user == "")
	{
		echo "<h5>Не зарегистрированные пользователи не могут оставлять комментарии.</h5>";
	}
	else
	{
		echo "<h5>Оставить новый комментарий.</h5>
<form name=\"form\"  method=\"post\" action=\"$site/orgforum/ad.php?id=$id\">
<textarea name=\"text\" rows=\"7\" cols=\"60\"></textarea><p>
<input type=\"submit\" name=\"formbutton1\" value=\"Добавить\"></p>
</form>";
	}
}
function action()
{
	global $id_user, $god_site, $site, $id_user;
	$adm = dostup_adm();
	$god_org = dostup_org_god($god_site);
	if ($adm == 1 or $god_org == 1)
	{
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
		if (isset($_GET['str']))
		{
			$str = ($_GET['str']);
		}
		else
		{
			$str = "0";
		}
		$str = intval($str);
		//общий форум - показывает все ветки разрешенные
		if ($id == 0)
		{
			echo "<h2 align='center'>Орг Форум</h2>";
			echo "<div class = \"str\">";
			$q = "SELECT count(*) FROM `orgforum`";
			$res = mysql_query($q);
			$row = mysql_fetch_row($res);
			$total_rows = $row[0];
			$per_page = 20;
			$num_pages = ceil($total_rows / $per_page);
			for ($i = 1; $i <= $num_pages; $i++)
			{
				if ($str == $i)
				{
					echo "<b>$i</b>";
				}
				else
				{
					echo "<a href=\"$site/orgforum.php?str=$i\">$i</a>";
				}
			}
			echo "</div><table>";
			if (isset($_GET['st']))
			{
				$st = addslashes($_GET['st']);
			}
			else
			{
				$st = "";
			}
			if (isset($_GET['str'])) $str = ($_GET['str'] - 1);
			else  $str = 0;
			$str = intval($str);
			$start = abs($str * $per_page);
			$ok_page = mysql_query("select * from orgforum order by date desc LIMIT $start,$per_page");
			while ($t_page = mysql_fetch_array($ok_page))
			{
				$id = $t_page['id'];
				$name = $t_page['name'];
				$t = $t_page['org'];
				$com_count = $t_page['com_count'];
				$id_us = $t_page['id_us'];
				$tip = $t_page['tip'];
				$avtor = user_info($id_us);
				$date = $t_page['date'];
				$date = date("d.m.y", strtotime($date));
				echo "<tr><td>$date</td><td>$tip</td><td>$avtor</td><td>";
				$god_org = dostup_org_god($tip);
				if ($adm == 1 or $god_org == 1)
				{
					echo "<a href = \"$site/orgforum.php?id=$id\">$name</a>";
				}
				else
				{
					echo "$name";
				}
				echo "</td><td>$com_count</td></tr>";
			}
			echo "</table>";
			if (isset($_GET['str']))
			{
				$str = ($_GET['str']);
			}
			else
			{
				$str = "0";
			}
			$str = intval($str);
			echo "<p>";
			echo "<div class = \"str\">";
			$q = "SELECT count(*) FROM `orgforum` ";
			$res = mysql_query($q);
			$row = mysql_fetch_row($res);
			$total_rows = $row[0];
			$per_page = 20;
			$num_pages = ceil($total_rows / $per_page);
			for ($i = 1; $i <= $num_pages; $i++)
			{
				if ($str == $i)
				{
					echo "<b>$i</b>";
				}
				else
				{
					echo "<a href=\"orgforum.php?str=$i\">$i</a>";
				}
			}
			echo "</p></div>";
		}
		else
		{
?>
<script type="text/javascript">
function reply(id,id_com){
	document.getElementById('f'+id_com).innerHTML='<form name=add_coment method=post action=<?
			echo "$site";
?>/orgforum/ad.php?id='+id+'&otv='+id_com+'><textarea id=a'+id_com+' name="text" rows="8" cols="49"></textarea><p><input type="submit" name="formbutton1" value="Отправить"></p></form>';
	document.getElementById('a'+id_com).focus();
	id_c = id_com;}
</script>
	<?
			$id = intval($id);
			forum($id);
		}
	}
	else
	{
		error(7);
	}
}
function title()
{
	global $name_site;
	echo "
<title>Оргфорум | $name_site</title>";
}
function right()
{
	global $id_user, $god_site, $site, $id_user;
	$adm = dostup_adm();
	$god_org = dostup_org_god($god_site);
	if ($adm == 1 or $god_org == 1)
	{
		echo "<a href = \"$site/orgforum/ad_forum.php\">Добавить новый форум</a>";
	}
}
require ("theme/$theme/$theme.htm");
?>