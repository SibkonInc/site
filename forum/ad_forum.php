<?php
/**
 * @author нукшсл
 * @copyright 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
function ad_forum()
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
	if (isset($_GET['t']))
	{
		$t = addslashes($_GET['t']);
	}
	else
	{
		$t = 0;
	}
	if (!is_numeric($t))
	{
		die("Такой записи нет!");
	}
	if (isset($_GET['m']))
	{
		$m = addslashes($_GET['m']);
	}
	else
	{
		$m = 0;
	}
	if (!is_numeric($m))
	{
		die("Такой записи нет!");
	}
	echo "
<form name=\"form1\" method=\"post\" action=\"ad_post.php?m=$m&amp;t=$t&amp;id=$id\">
<table>
<tr><td>Тема</td><td><input type=\"text\"  name='name' size=\"86\"></td></tr>";

if (!($m =="0"))
{
    echo "<tr><td>Закрытый</td><td><SELECT NAME=\"dostup\" SIZE=\"1\"><OPTION VALUE=\"0\">Нет</OPTION><OPTION VALUE=\"1\">Да</OPTION></td></tr>";
}
echo"</table>
<p>Текст<br><textarea name='text' rows=\"36\" cols='96' >$text</textarea></p>
<div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"javascript:document.form1.submit()\">Добавить форум</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div>
<p> <input name = \"kno\" type=\"submit\" value='.' style=\"color:#fff;border:0;padding:0;margin:0;background:#fff;height:6px;width:6px\"/>                           
</form>
";
}
function action()
{
	global $id_user, $tip_user, $site, $god_site;
	if ($id_user == "")
	{
		error(6);
	}
	else
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
		if (isset($_GET['t']))
		{
			$t = addslashes($_GET['t']);
		}
		else
		{
			$t = 0;
		}
		if (!is_numeric($t))
		{
			die("Такой записи нет!");
		}
		if (isset($_GET['m']))
		{
			$m = addslashes($_GET['m']);
		}
		else
		{
			$m = 0;
		}
		if (!is_numeric($m))
		{
			die("Такой записи нет!");
		}
		if ($id == 0)
		{
			echo "
		<h3 align = \"center\">Добавление нового форума</h3>
<form name=\"form1\" method=\"post\" action=\"ad_post.php\">
<table>
<tr><td>Тема</td><td><input type=\"text\"  name='name' size=\"86\"></td></tr>
</table>
<p>Текст<br><textarea name='text' rows=\"36\" cols='96' >$text</textarea></p>
<div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"javascript:document.form1.submit()\">Добавить форум</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div>
<p> <input name = \"kno\" type=\"submit\" value='.' style=\"color:#fff;border:0;padding:0;margin:0;background:#fff;height:6px;width:6px\"/>                           
</form>
";
		}
		else
		{
			if ($t == "1")
			{
				$name_comand = name_comand($id);
				echo "<h3 align = \"center\">Новая тема</h3>обсуждение в команде \"$name_comand\"";
				$ok_page = mysql_query("select * from command where id = $id");
				while ($t_page = mysql_fetch_array($ok_page))
				{
					$tip = $t_page['tip'];
					$forum = $t_page['forum'];
				}
				if ($tip == "0")
				{
					ad_forum();
				}
				else
				{
					$master = dostup_comand_user($id);
					if ($master == 1)
					{
						ad_forum();
					}
					else
					{
						error(7);
					}
				}
			}
			else
				if ($t == "3")
				{
					$ok_page = mysql_query("SELECT * FROM `module` WHERE `id` = '$m'");
					while ($t_page = mysql_fetch_array($ok_page))
					{
						$id_modul = $t_page['id'];
						$name_modul = $t_page['name'];
						$file = $t_page['file'];
						$on = $t_page['on'];
						$forum = $t_page['forum'];
						$only_us = $t_page['only_us'];
						$table_us = $t_page['table_us'];
					}
					if ($forum == "0")
					{
						if ($only_us == "0")
						{
							echo "<h3 align = \"center\">Новая тема</h3>обсуждение в \"$name_modul\"";
							ad_forum();
						}
						else
						{
							$ok_page = mysql_query("SELECT * FROM `$table_us` WHERE `id_us` = '$id_user' and id_command = $id");
							while ($t_page = mysql_fetch_array($ok_page))
							{
								$id_us_reg = $t_page['id_us'];
							}
							if ($id_us_reg == $id_user)
							{
								echo "<h3 align = \"center\">Новая тема</h3>обсуждение в \"$name_modul\"";
								ad_forum();
							}
							else
							{
								error(16);
							}
						}
					}
					else
					{
						error(15);
					}
				}
		}
	}
}
function title()
{
	global $id_user, $name_site;
	echo "
<title>Добавление форума | $name_site</title>";
}
function right()
{
}
require ("../theme/$theme/$theme.htm");
?>