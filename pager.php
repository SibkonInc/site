<?
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
//Выводим страницу
//внешний вид пагера
function theme_pager($id)
{
	$ok_tip = mysql_query("SELECT * FROM `pager` WHERE `id` =$id");
	while ($t_tip = mysql_fetch_array($ok_tip))
	{
		$id = $t_tip['id'];
		$in = $t_tip['in'];
		$out = $t_tip['out'];
		$date = $t_tip['date'];

        $time = time_zone($date);
		$date = date("Y-m-d", strtotime($date));
		$date = format_date_html($date);
		$text = nl2br($t_tip['text']);
		$st_in = $t_tip['st_in'];
		$st_out = $t_tip['st_out '];
		$tip = $t_tip['tip'];
		$nit = $t_tip['nit'];
		if ($tip == "")
		{
			$tip = "Быстрое сообщение";
		}
	}
	$ok_reg = mysql_query("select * from pager  WHERE nit =  '$nit'");
	$itog_reg1 = mysql_num_rows($ok_reg);
	$itog_reg1 = $itog_reg1 - 1;
	if ($itog_reg1 > "0")
	{
		$re = "Re: ($itog_reg1)";
	}
	echo "
<div class=\"pane\">
<div class=\"pane_p\">
<div class=\"nccp\">
<div class=\"pl\" align=\"left\"> от ";
	user_information($out);
	echo " к ";
	user_information($in);
	echo ": $re $tip</div><div class=\"pr\" align=\"right\">$date $time</div><br></div>
<br><div class=\"text_block\">$text </div><br>
<b class=\"ncp\"><b class=\"ncp1\"><b></b></b><b class=\"ncp2\"><b></b></b></b>
<div class=\"example cursor\" id=\"example$id$id\"><span class=\"nccp\">
<a><img src=\"img/p_otv.png\"  alt=\"Ответить\" border=\"0\"> Ответить на сообщение</a> | <a  href=\"#\" class=\"delete\" id=\"a$id\" title = \"Прочитано\"><img src=\"img/p_ok.png\"  alt=\"Прочитано\" border=\"0\"> Прочитано</a> | 
<a  href=\"#\" class=\"delete\" id=\"b$id\" title = \"Удалить\"><img src=\"img/p_del.png\"  alt=\"Удалить\" border=\"0\"> Удалить</a> | 
<a  href=\"#\" class=\"delete\" id=\"c$id\" title = \"Сохранить\"><img src=\"img/p_save.png\"  alt=\"Сохранить\" border=\"0\"> Сохранить</a> | ";
	if ($nit == 0)
	{
		echo "";
	}
	else
	{
		echo "<a href = \"pager.php?i=5&amp;nit=$nit\" title = \"Ветка разговора\"><img src=\"img/p_vetka.png\"  alt=\"Ветка разговора\" border=\"0\"> Ветка</a>";
	}
	echo "</span> </div>
<div class=\"example cursor\" id=\"ex$id\"></div>
<b class=\"ncp\"><b class=\"ncp2\"><b></b></b><b class=\"ncp1\"><b></b></b></b>
</div></div>";
?>
<script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery('#example<?
	echo "$id$id";
?>').click(function(){
                    jQuery('#ex<?
	echo "$id";
?>').load('<?
	echo "pager/pager_otv.php?out=$out&id=$id&nit=$nit";
?>');                
                }) 
            });
$(document).ready(function(){
  $("#a<?
	echo "$id";
?>").click(
    function () {
      $.ajax({
        type: "GET",
        url: "pager/pager_del.php?d=1&id=<?
	echo "$id";
?>"
      });
    });
    $("#b<?
	echo "$id";
?>").click(
    function () {
      $.ajax({
        type: "GET",
        url: "pager/pager_del.php?d=2&id=<?
	echo "$id";
?>"
      });
    });
     $("#c<?
	echo "$id";
?>").click(
    function () {
      $.ajax({
        type: "GET",
        url: "pager/pager_del.php?d=3&id=<?
	echo "$id";
?>"
      });
    });
});
$(document).ready(function(){
	$(".pane .delete").click(function(){
		$(this).parents(".pane").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow")
		return false;
	});
});
</script>
<?
}
//просмотр страницы//////////////////////////////////////////////////////////////////////
function pages()
{
	global $id_user, $site;
	if ($id_user == "")
	{
		error(6);
	}
	else
	{
		echo "<h3>Новые непрочитанные сообщения</h3>";
		if (isset($_GET['str']))
		{
			$str = ($_GET['str']);
		}
		else
		{
			$str = "0";
		}
		$str = intval($str);
		echo "<p>Страницы <a href=\"pager.php?i=2\">Все</a> | ";
		$q = "SELECT count(*) FROM `pager` WHERE `in` =$id_user AND `st_in` = 0";
		$res = mysql_query($q);
		$row = mysql_fetch_row($res);
		$total_rows = $row[0];
		$per_page = 20;
		$num_pages = ceil($total_rows / $per_page);
		for ($i = 1; $i <= $num_pages; $i++)
		{
			if ($str == $i)
			{
				echo "<a><b>$i</b></a> | ";
			}
			else
			{
				echo "<a href=\"$site/pager.php?str=$i\">$i</a> | ";
			}
		}
		echo "";
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
		$ok_tip = mysql_query("SELECT * FROM `pager` WHERE `in` =$id_user AND `st_in` = 0 order by date desc LIMIT $start,$per_page ");
		while ($t_tip = mysql_fetch_array($ok_tip))
		{
			$id = $t_tip['id'];
			theme_pager($id);
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
		echo "<p>Страницы <a href=\"pager.php?i=2\">Все</a> | ";
		$q = "SELECT count(*) FROM `pager` WHERE `in` =$id_user AND `st_in` = 0";
		$res = mysql_query($q);
		$row = mysql_fetch_row($res);
		$total_rows = $row[0];
		$per_page = 20;
		$num_pages = ceil($total_rows / $per_page);
		for ($i = 1; $i <= $num_pages; $i++)
		{
			if ($str == $i)
			{
				echo "<a><b>$i</b></a> | ";
			}
			else
			{
				echo "<a href=\"$site/pager.php?str=$i\">$i</a> | ";
			}
		}
		echo "";
	}
}
//просмотр входящих//////////////////////////////////////////////////////
function in_pager()
{
	global $id_user;
	if ($id_user == "")
	{
		error(6);
	}
	else
	{
		echo "<h3>Входящие сообщения</h3>";
		echo "<a href = \"$site/pager/pager_del.php?d=2&amp;id=all\">Удалить все</a>";
		if (isset($_GET['str']))
		{
			$str = ($_GET['str']);
		}
		else
		{
			$str = "0";
		}
		$str = intval($str);
		echo "<p>Страницы <a href=\"pager.php?i=2\">Все</a> | ";
		$q = "SELECT count(*) FROM `pager` WHERE `in` =$id_user AND `st_in` = 1";
		$res = mysql_query($q);
		$row = mysql_fetch_row($res);
		$total_rows = $row[0];
		$per_page = 20;
		$num_pages = ceil($total_rows / $per_page);
		for ($i = 1; $i <= $num_pages; $i++)
		{
			if ($str == $i)
			{
				echo "<a><b>$i</b></a> | ";
			}
			else
			{
				echo "<a href=\"pager.php?i=1&amp;str=$i\">$i</a> | ";
			}
		}
		echo "";
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
		$ok_tip = mysql_query("SELECT * FROM `pager` WHERE `in` =$id_user AND `st_in` = 1 order by date desc LIMIT $start,$per_page ");
		while ($t_tip = mysql_fetch_array($ok_tip))
		{
			$id = $t_tip['id'];
			theme_pager($id);
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
		echo "<p>Страницы <a href=\"pager.php?i=2\">Все</a> | ";
		$q = "SELECT count(*) FROM `pager` WHERE `in` =$id_user AND `st_in` = 1";
		$res = mysql_query($q);
		$row = mysql_fetch_row($res);
		$total_rows = $row[0];
		$per_page = 20;
		$num_pages = ceil($total_rows / $per_page);
		for ($i = 1; $i <= $num_pages; $i++)
		{
			if ($str == $i)
			{
				echo "<a><b>$i</b></a> | ";
			}
			else
			{
				echo "<a href=\"pager.php?i=1&amp;str=$i\">$i</a> | ";
			}
		}
		echo "";
	}
}
//просмотр исходящих/////////////////////////////////////
function out_pager()
{
	global $id_user;
	if ($id_user == "")
	{
		error(6);
	}
	else
	{
		echo "<h3>Исходящие cообщения</h3>";
		echo "<a href = pager/pager_del.php?d=2&amp;id=al>Удалить все</a>";
		if (isset($_GET['str']))
		{
			$str = ($_GET['str']);
		}
		else
		{
			$str = "0";
		}
		$str = intval($str);
		echo "<p>Страницы <a href=\"pager.php?i=2\">Все</a> | ";
		$q = "SELECT count(*) FROM `pager` WHERE `out` =$id_user AND `st_out` = 1";
		$res = mysql_query($q);
		$row = mysql_fetch_row($res);
		$total_rows = $row[0];
		$per_page = 20;
		$num_pages = ceil($total_rows / $per_page);
		for ($i = 1; $i <= $num_pages; $i++)
		{
			if ($str == $i)
			{
				echo "<a><b>$i</b></a> | ";
			}
			else
			{
				echo "<a href=\"pager.php?i=2&amp;str=$i\">$i</a> | ";
			}
		}
		echo "";
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
		$ok_tip = mysql_query("SELECT * FROM `pager` WHERE `out` =$id_user AND `st_out` = 1 order by date desc LIMIT $start,$per_page ");
		while ($t_tip = mysql_fetch_array($ok_tip))
		{
			$id = $t_tip['id'];
			theme_pager($id);
		}
		echo "<a href = pager/pager_del.php?d=2&amp;id=al>Удалить все</a>";
		if (isset($_GET['str']))
		{
			$str = ($_GET['str']);
		}
		else
		{
			$str = "0";
		}
		$str = intval($str);
		echo "<p>Страницы <a href=\"pager.php?i=2\">Все</a> | ";
		$q = "SELECT count(*) FROM `pager` WHERE `out` =$id_user AND `st_out` = 1";
		$res = mysql_query($q);
		$row = mysql_fetch_row($res);
		$total_rows = $row[0];
		$per_page = 20;
		$num_pages = ceil($total_rows / $per_page);
		for ($i = 1; $i <= $num_pages; $i++)
		{
			if ($str == $i)
			{
				echo "<a><b>$i</b></a> | ";
			}
			else
			{
				echo "<a href=\"pager.php?i=2&amp;str=$i\">$i</a> | ";
			}
		}
		echo "";
	}
}
//просмотр удаленных///////////////////////////////////////////////
function del_pager()
{
	global $id_user;
	if ($id_user == "")
	{
		error(6);
	}
	else
	{
		echo "<h3>Удаленные cообщения</h3>";
		echo "<a href = pager/pager_del.php?d=2&amp;id=aloff>Удалить все</a>";
		if (isset($_GET['str']))
		{
			$str = ($_GET['str']);
		}
		else
		{
			$str = "0";
		}
		$str = intval($str);
		echo "<p>Страницы <a href=\"pager.php?i=2\">Все</a> | ";
		$q = "SELECT count(*) FROM `pager` WHERE `in` =$id_user AND `st_in` = 2";
		$res = mysql_query($q);
		$row = mysql_fetch_row($res);
		$total_rows = $row[0];
		$per_page = 20;
		$num_pages = ceil($total_rows / $per_page);
		for ($i = 1; $i <= $num_pages; $i++)
		{
			if ($str == $i)
			{
				echo "<a><b>$i</b></a> | ";
			}
			else
			{
				echo "<a href=\"pager.php?i=3&amp;str=$i\">$i</a> | ";
			}
		}
		echo "";
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
		$ok_tip = mysql_query("SELECT * FROM `pager` WHERE `in` =$id_user AND `st_in` = 2 order by date desc LIMIT $start,$per_page ");
		while ($t_tip = mysql_fetch_array($ok_tip))
		{
			$id = $t_tip['id'];
			theme_pager($id);
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
		echo "<p>Страницы <a href=\"pager.php?i=2\">Все</a> | ";
		$q = "SELECT count(*) FROM `pager` WHERE `in` =$id_user AND `st_in` = 2";
		$res = mysql_query($q);
		$row = mysql_fetch_row($res);
		$total_rows = $row[0];
		$per_page = 20;
		$num_pages = ceil($total_rows / $per_page);
		for ($i = 1; $i <= $num_pages; $i++)
		{
			if ($str == $i)
			{
				echo "<a><b>$i</b></a> | ";
			}
			else
			{
				echo "<a href=\"pager.php?i=3&amp;str=$i\">$i</a> | ";
			}
		}
		echo "";
	}
}
//просмотр архива///////////////////////////////////////
function arh_pager()
{
	global $id_user;
	if ($id_user == "")
	{
		error(6);
	}
	else
	{
		echo "<h3>Сохраненные сообщения.</h3>";
		if (isset($_GET['str']))
		{
			$str = ($_GET['str']);
		}
		else
		{
			$str = "0";
		}
		$str = intval($str);
		echo "<p>Страницы <a href=\"pager.php?i=2\">Все</a> | ";
		$q = "SELECT count(*) FROM `pager` WHERE `in` =$id_user AND `st_in` = 3";
		$res = mysql_query($q);
		$row = mysql_fetch_row($res);
		$total_rows = $row[0];
		$per_page = 20;
		$num_pages = ceil($total_rows / $per_page);
		for ($i = 1; $i <= $num_pages; $i++)
		{
			if ($str == $i)
			{
				echo "<a><b>$i</b></a> | ";
			}
			else
			{
				echo "<a href=\"pager.php?i=4&amp;str=$i\">$i</a> | ";
			}
		}
		echo "";
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
		$ok_tip = mysql_query("SELECT * FROM `pager` WHERE `in` =$id_user AND `st_in` = 3 order by date desc LIMIT $start,$per_page ");
		while ($t_tip = mysql_fetch_array($ok_tip))
		{
			$id = $t_tip['id'];
			theme_pager($id);
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
		echo "<p>Страницы <a href=\"pager.php?i=2\">Все</a> | ";
		$q = "SELECT count(*) FROM `pager` WHERE `in` =$id_user AND `st_in` = 3";
		$res = mysql_query($q);
		$row = mysql_fetch_row($res);
		$total_rows = $row[0];
		$per_page = 20;
		$num_pages = ceil($total_rows / $per_page);
		for ($i = 1; $i <= $num_pages; $i++)
		{
			if ($str == $i)
			{
				echo "<a><b>$i</b></a> | ";
			}
			else
			{
				echo "<a href=\"pager.php?i=4&amp;str=$i\">$i</a> | ";
			}
		}
		echo "";
	}
}
//просмотр нити разговора/////////////////////////////////////////
function nit_pager()
{
	global $id_user;
	if ($id_user == "")
	{
		error(6);
	}
	else
	{
		echo "<h3>Нить разговора</h3>";
		if (isset($_GET['nit'])) $nit = addslashes($_GET['nit']);
		else
		{
			$nit = 0;
		}
		if (!is_numeric($nit))
		{
			die("Такой записи нет!");
		}
		$nit = intval($nit);
		$ok_tip = mysql_query("SELECT * FROM `pager` WHERE `nit` = $nit order by date") or
			die("Нет такой записи");
		while ($t_tip = mysql_fetch_array($ok_tip))
		{
			$id = $t_tip['id'];
			$in = $t_tip['in'];
			$out = $t_tip['out'];
			$date = $t_tip['date'];
			$time = date("H:i", strtotime($date));
			$date = date("Y-m-d", strtotime($date));
			$date = format_date_html($date);
			$text = nl2br($t_tip['text']);
			$st_in = $t_tip['st_in'];
			$st_out = $t_tip['st_out '];
			$tip = $t_tip['tip'];
			if ($tip == "")
			{
				$tip = "Быстрое сообщение";
			}
			if ($in == "$id_user")
			{
				echo "
<div class = 'pane'>
<font size=2>";
				user_information($out);
				echo " : $date $time</font>
<blockquote class=\"style2\">$text</blockquote></div>
";
			}
			else
				if ($out == "$id_user")
				{
					echo "<div class = 'pane'>
<font size=2>";
					user_information($out);
					echo " : $date $time</font>
<blockquote class=\"style2\">$text</blockquote></div>
";
				}
				else
				{
					echo "бла бла, не хорошо чужую перепись смотреть. Уведомление о ваших коварствах ушло администратору и хозяевам переписки.";
				}
		}
	}
}
function action()
{
	global $id_user;
	if ($id_user == "")
	{
		error(6);
	}
	else
	{
		if (isset($_GET['i']))
		{
			$i = addslashes($_GET['i']);
		}
		else
		{
			$i = 0;
		}
		if (!is_numeric($i))
		{
			die("Такой записи нет!");
		}
		$i = intval($i);
		if ($i == "1")
		{
			$i = in_pager();
		} elseif ($i == "2")
		{
			$i = out_pager();
		} elseif ($i == "3")
		{
			$i = del_pager();
		} elseif ($i == "4")
		{
			$i = arh_pager();
		} elseif ($i == "5")
		{
			$i = nit_pager();
		}
		else
		{
			$i = pages();
		}
	}
}
// подключаем интерфейс
function title()
{
	global $id_user, $name_site;
	if (isset($_GET['i']))
	{
		$i = addslashes($_GET['i']);
	}
	else
	{
		$i = 0;
	}
	if (!is_numeric($i))
	{
		die("Такой записи нет!");
	}
	$i = intval($i);
	if ($i == "1")
	{
		$tit = "Входящие";
	} elseif ($i == "2")
	{
		$tit = "Исходящие";
	} elseif ($i == "3")
	{
		$tit = "Удаленные";
	} elseif ($i == "4")
	{
		$tit = "Сохраненные";
	} elseif ($i == "5")
	{
		$tit = "Ветка разговора";
	}
	else
	{
		$tit = "Новые";
	}
	echo "
<title>Пейджер: $tit | $name_site</title>
<script type=\"text/javascript\" src=\"ja/jquery.color.js\"></script>
";
}
function right()
{
	global $id_user, $site;
	if (!($id_user == ""))
	{
		$ok_reg = mysql_query("select * from pager  WHERE `in` =  '$id_user' AND `st_in` =  '0'");
		$itog_reg1 = mysql_num_rows($ok_reg);
		if ($itog_reg1 == "0")
		{
			$itog_reg1 = "--";
		}
		echo "<table><tr><td><a href=\"$site/pager.php\">Новые</a></td><td align=\"right\">$itog_reg1</td></tr>";
		$ok_reg = mysql_query("select * from pager  WHERE `in` =  '$id_user' AND `st_in` =  '1'");
		$itog_reg1 = mysql_num_rows($ok_reg);
		if ($itog_reg1 == "0")
		{
			$itog_reg1 = "--";
		}
		echo "<tr><td><a href=\"$site/pager.php?i=1\">Входящие:</a></td><td align=\"right\">$itog_reg1</td></tr>";
		$ok_reg = mysql_query("select * from pager  WHERE `out` =  '$id_user' AND `st_out` =  '1'");
		$itog_reg1 = mysql_num_rows($ok_reg);
		if ($itog_reg1 == "0")
		{
			$itog_reg1 = "--";
		}
		echo "<tr><td><a href=\"$site/pager.php?i=2\">Исходящие:</a></td><td align=\"right\">$itog_reg1</td></tr>";
		$ok_reg = mysql_query("select * from pager  WHERE `in` =  '$id_user'  AND `st_in` =  '3'");
		$itog_reg1 = mysql_num_rows($ok_reg);
		if ($itog_reg1 == "0")
		{
			$itog_reg1 = "--";
		}
		echo "<tr><td><a href=\"$site/pager.php?i=4\">Сохраненные:</a></td><td align=\"right\">$itog_reg1</td></tr>";
		$ok_reg = mysql_query("select * from pager  WHERE `in` =  '$id_user'  AND `st_in` =  '2'");
		$itog_reg1 = mysql_num_rows($ok_reg);
		if ($itog_reg1 == "0")
		{
			$itog_reg1 = "--";
		}
		echo "<tr><td><a href=\"$site/pager.php?i=3\">Удаленные:</a></td><td align=\"right\">$itog_reg1</td></tr></table>";
	}
}
require ("theme/$theme/$theme.htm");
?>
