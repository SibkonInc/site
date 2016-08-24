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
	$ok_page = mysql_query("select * from forum where id = $id");
	while ($t_page = mysql_fetch_array($ok_page))
	{
		$id = $t_page['id'];
		$name = $t_page['name'];
		$t = $t_page['org'];
		$pr_zap = $t_page['pr_zap'];
		$com_count = $t_page['com_count'];
		$id_us = $t_page['id_us'];
		$avtor = user_info($id_us);
		$date = $t_page['date'];
		$time = time_zone($date);
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
	$q = "SELECT count(*) FROM `comment` where `id_page` = $id";
	$res = mysql_query($q);
	$row = mysql_fetch_row($res);
	$total_rows = $row[0];
	echo "<p><b><a href = \"$site/forum.php\">Общий Форум</a>";
	if ($t == "1")
	{
		$name_command = name_comand($pr_zap);
		echo " | $name_command";
	}
	echo " | $name</b></p>";
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
			echo "<a href=\"$site/forum.php?id=$id&amp;str=$i\">$i</a>";
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
		<div class=\"text_block\">
		$text
		</div>
	</div>
</div>";
	}
	$ok_com = mysql_query("select * from `comment` where `id_page` = $id order by id_com LIMIT $start,$per_page");
	while ($row = mysql_fetch_array($ok_com))
	{
		$id_com = $row['id_com'];
		$id_us_com = $row['id_us'];
		$text_com = nl2br($row['text']);
		$avtor_com = user_info($id_us_com);
		$com_otv = $row['com_otv'];
		$date_com = $row['date'];
		$time_com = time_zone($date_com);
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
		echo "
<div class=\"pane\">

	<div class=\"pane_p\">
		<div class=\"nccp\">
			<img src= \"$pic_com\" $vis1=\"40\" border=\"0\" alt=\"Инфо\" align=\"left\" >
			$avtor_com<br>
			$date_com $time_com <a name='$id_com'> </a>
		</div><br>
	<div class=\"text_block\">
		$text_com
	</div>
	<div id=\"exp$id_com\">
	</div>
	<div class=\"nccp\">";
		if (!($com_otv == "0"))
		{
			echo "<script type=\"text/javascript\">jQuery(document).ready(function(){jQuery('#examp$id_com$id_com').click(function(){jQuery('#exp$id_com').load('$site/forum/com_text.php?id=$com_otv');})});</script>    
		<a id=\"examp$id_com$id_com\">это ответ на...</a> | Ветка сообщений | ";
		}
		if (!($id_user == ""))
		{
			echo "<a href='javascript:reply($id,$id_com);'>Ответить на сообщение</a>";
		}
		echo "
		<div id=f$id_com>
		</div>
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
	$q = "SELECT count(*) FROM `comment` where `id_page` = $id";
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
			echo "<a href=\"$site/forum.php?id=$id&amp;str=$i\">$i</a>";
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
<form name=\"form\"  method=\"post\" action=\"$site/forum/ad.php?id=$id\">
<textarea name=\"text\" rows=\"7\" cols=\"60\"></textarea><p>
<input type=\"submit\" name=\"formbutton1\" value=\"Добавить\"></p>
</form>";
		//занесение данных в новое
		$ok_news_nabl = mysql_query("select * from posech where id_us = $id_user and id_forum = $id");
		while ($t_news_nabl = mysql_fetch_array($ok_news_nabl))
		{
			$comment = $t_news_nabl['comment'];
			$id_count = $t_news_nabl['id'];
		}
		if ($comment == "")
		{
			mysql_query("insert into `posech`(id_us,id_forum,comment) values('$id_user', '$id', '$com_count')");
		}
		mysql_query(" UPDATE posech SET comment='$com_count', id_com='$id_com' where id = $id_count");
	}
}
function action()
{
	global $id_user, $site;
	if (isset($_GET['f']))
	{
		$f = addslashes($_GET['f']);
	}
	else
	{
		$f = 0;
	}
	if (!is_numeric($f))
	{
		die("Такой записи нет!");
	}
	$f = intval($f);
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
	if ($f == "1")
	{
		echo "<h2 align='center'>Форумы команд</h2>Перечисленны форумы команд, в которых вы состоите. ";
		echo "Новые темы добавляются на страницах команд";
		echo "<table><thead></thead><tr><th>Дата</th><th>Команда</th><th>Тема</th><th>Автор</th><th></th><th></th></tr>";
		$ok_page = mysql_query("select * from forum where org = 1 order by date desc ");
		while ($t_page = mysql_fetch_array($ok_page))
		{
			$id_tema = $t_page['id'];
			$name_tema = $t_page['name'];
			$id_ust_tema = $t_page['id_us'];
			$date_tema = $t_page['date'];
			$date_tema = date("d.m.y", strtotime($date_tema));
			$user_tema = user_info($id_ust_tema);
			$com_count_tema = $t_page['com_count'];
			$pr_zap = $t_page['pr_zap'];
			$dostup = dostup_comand_user($pr_zap);
			$name_command = name_comand($pr_zap);
			$count = count_com($id_tema);
			$id_count_com = id_count_com($id_tema);
			if ($count == "")
			{
				$count = "$com_count_tema";
			}
			else
			{
				$count = $com_count_tema - $count;
				if ($count > "0")
				{
					$count = "$com_count_tema <font color = \"#FA0808\">+$count</font>";
				}
				else
				{
					$count = "$com_count_tema";
				}
			}
			if ($dostup == "1")
			{
				echo "<tr><td>$date_tema</td><td>$name_command</td><td><a href = \"forum.php?id=$id_tema\">$name_tema</a></td><td>$user_tema</td><td>$count </td><td align = right><a href = \"$site/forum.php?id=$id_tema$id_count_com\"><img src=\"img/message_reply.png\"  alt=\"К последнему сообщению\" border=\"0\"></a></td></tr>";
			}
		}
		echo "</table>";
	}
	else
		if ($f == "2")
		{
			echo "<h2 align='center'>Отслеживаемые темы</h2>Перечисленны темы из всех форумов, на которые вы подписаны";
		}
		else
			if ($f == "3")
			{
				echo "<h2 align='center'>Доступные темы</h2>Перечисленны доступные вам темы";
			}
			else
			{
				if ($id == 0)
				{
					echo "<h2 align='center'>Общий Форум</h2>";
					echo "<a href = \"$site/forum/ad_forum.php\">Добавить новую тему</a><br>";
					echo "<div class = \"str\">";
					$q = "SELECT count(*) FROM `forum` where org = 0 and pr_zap = 0";
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
							echo "<a href=\"$site/forum.php?str=$i\">$i</a>";
						}
					}
					echo "</div><table>";
					echo "<table><thead></thead><tr><th>Дата</th><th>Автор</th><th>Тема</th><th></th><th></th></tr>";
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
					$ok_page = mysql_query("select * from forum where org = 0 and pr_zap = 0 order by date desc LIMIT $start,$per_page");
					while ($t_page = mysql_fetch_array($ok_page))
					{
						$id = $t_page['id'];
						$name = $t_page['name'];
						$t = $t_page['org'];
						$com_count = $t_page['com_count'];
						$id_us = $t_page['id_us'];
						$avtor = user_info($id_us);
						$date = $t_page['date'];
						$date = date("d.m.y", strtotime($date));
						$count = count_com($id);
						$id_count_com = id_count_com($id);
						if ($count == "")
						{
							$count = "$com_count";
						}
						else
						{
							$count = $com_count - $count;
							if ($count > "0")
							{
								$count = "$com_count <font color = \"#FA0808\">+$count</font>";
							}
							else
							{
								$count = "$com_count";
							}
						}
						echo "<tr><td>$date</td><td>$avtor</td><td><a href = \"$site/forum.php?id=$id\">$name</a></td><td>$count </td><td align = right><a href = \"$site/forum.php?id=$id$id_count_com\"><img src=\"img/message_reply.png\"  alt=\"К последнему сообщению\" border=\"0\"></a></td></tr>";
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
					$q = "SELECT count(*) FROM `forum` where org = 0 and pr_zap = 0";
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
							echo "<a href=\"forum.php?str=$i\">$i</a>";
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
?>/forum/ad.php?id='+id+'&otv='+id_com+'><textarea id=a'+id_com+' name="text" rows="8" cols="49"></textarea><p><input type="submit" name="formbutton1" value="Отправить"></p></form>';
	document.getElementById('a'+id_com).focus();
	id_c = id_com;}
</script>
	<?
					$id = intval($id);
					$ok_page = mysql_query("select * from forum where id = $id");
					while ($t_page = mysql_fetch_array($ok_page))
					{
						$pr_zap = $t_page['pr_zap'];
						$t = $t_page['org'];
						$id_z = $t_page['id'];
					}
					if ($id_z == "")
					{
						error(13);
					}
					else
					{
						if ($pr_zap == "0")
						{
							forum($id);
						}
						else
						{
							if ($t == "1")
							{
								$dostup_comand_user = dostup_comand_user($pr_zap);
								if ($dostup_comand_user == "1")
								{
									forum($id);
								}
								else
								{
									error(7);
								}
							}
						}
					}
				}
			}
}
function title()
{
	global $name_site;
	echo "
<title>Форум | $name_site</title>";
}
function right()
{
	global $id_user, $site;
	if ($id_user == "")
	{
		echo "Вы не можете добавлять новые форумы, поскольку на авторизованы в системе.";
	}
	else
	{
		echo "<a href = \"$site/forum/ad_forum.php\">Добавить новую тему в общий форум</a>";
	}
}
require ("theme/$theme/$theme 2.htm");
?>