<?php
/**
 * @author Yerick
 * @copyright 2009
 * @name YCMS 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
function comand($id)
{
	global $site;
	$ok_page = mysql_query("select * from command where id = $id");
	while ($t_page = mysql_fetch_array($ok_page))
	{
		$id = $t_page['id'];
		$name = $t_page['name'];
		$tip = $t_page['tip'];
		$text = $t_page['text'];
		$forum = $t_page['forum'];
		$files = $t_page['files'];
		echo "<p>$text</p>";
		if ($forum == "0")
		{
			echo "<h4>Обсуждения</h4><a href = \"$site/forum/ad_forum.php?t=1&amp;id=$id\">Добавить новое</a>";
            echo "<table><thead></thead><tr><th>Дата</th><th>Автор</th><th>Тема</th><th>Коммент</th></tr>";
			$ok_page = mysql_query("select * from forum where pr_zap = $id and org = 1 order by date desc ");
			while ($t_page = mysql_fetch_array($ok_page))
			{
				$id = $t_page['id'];
				$name = $t_page['name'];
				$com_count = $t_page['com_count'];
				$id_us = $t_page['id_us'];
				$avtor = user_info($id_us);
				$date = $t_page['date'];
				$date = date("d.m.y", strtotime($date));
                $count = count_com($id);
            if($count =="")
            {
               $count =  "$com_count";
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
                     $count =  "$com_count";
                }
            }
				echo "<tr><td>$date</td><td>$avtor</td><td><a href = \"$site/forum.php?id=$id\">$name</a></td><td>$count</td></tr>";
			}
			echo "</table>";
		}
		if ($files == "0")
		{
			echo "<h4>Материалы</h4><a>Добавить материал</a>";
		}
	}
}
function action()
{
	global $site, $id_user;
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
		echo "<h2 align='center'>Команды</h2>";
		echo "
<table id=\"example\" class=\"display\">
<thead>
<tr><th>Тип</th><th>Название</th><th>Участников</th></tr>
</thead>
<tbody>";
		$ok_page = mysql_query("select * from command order by id desc");
		{
			while ($t_page = mysql_fetch_array($ok_page))
			{
				$id = $t_page['id'];
				$name = $t_page['name'];
				$tip = $t_page['tip'];
				if ($tip == "1")
				{
					$pict = "<img src=\"$site/img/ico/lockoverlay.png\" border=\"0\" alt=\"Закрыто\">";
				}
				else
				{
					$pict = "";
				}
				$ok_reg = mysql_query("select * from comand_us  WHERE `id_command` =  '$id'");
				$itog_reg1 = mysql_num_rows($ok_reg);
				echo "<tr><td>$pict</td><td><a href = \"$site/command.php?id=$id\">$name</a></td><td>$itog_reg1</td></tr>";
			}
		}
		echo "</tbody></table>";
	}
	else
	{
		$ok_page = mysql_query("select * from command where id = $id");
		{
			while ($t_page = mysql_fetch_array($ok_page))
			{
				$id = $t_page['id'];
				$name = $t_page['name'];
				$tip = $t_page['tip'];
				$text = $t_page['text'];
				$forum = $t_page['forum'];
				echo "<h2 align='center'>$name</h2>";
				if ($tip == "1")
				{
					$dostup_comand_user = dostup_comand_user($id);
					$adm = dostup_adm();
					if ($dostup_comand_user == "1" or $adm == "1")
					{
						comand($id);
					}
					else
					{
						echo "Это закрытая команда. Вы не можете участвовать в обсуждениях.";
					}
				}
				else
				{
					comand($id);
				}
				$master = dostup_comand($id);
				if ($master == 1)
				{
					echo "<div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"$site/command/edit.php?id=$id\">Редактировать</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div><p>";
				}
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
	if ($id == 0)
	{
		echo "<title>Команды | $name_site</title>";
	}
	else
	{
		$ok_page = mysql_query("select * from command where id = $id");
		{
			while ($t_page = mysql_fetch_array($ok_page))
			{
				$name = $t_page['name'];
				echo "<title>$name | $name_site</title>";
			}
		}
	}
}
function right()
{
	global $id_user, $site;
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
		if (!($id_user == ""))
		{
			echo "<ul>";
			echo "<li><a href = \"$site/command/ad.php\">Создать новую</a></li>";
			echo "</ul>";
		}
	}
	else
	{
		echo "<h5 align = \"center\">Участники</h5>";
		if (!($id_user == ""))
		{
			$master = dostup_comand($id);
			$adm = dostup_adm();
			$ok_pageu = mysql_query("select * from comand_us where id_command = $id and id_us = $id_user");
			while ($t_pageu = mysql_fetch_array($ok_pageu))
			{
				$id_usu = $t_pageu['id_us'];
			}
			if ($id_usu == $id_user)
			{
				echo "";
			}
			else
			{
				$ok_pagez = mysql_query("select * from query where id_tip = 1 and id_mer = $id and id_us = $id_user and ok = 0");
				while ($t_pagez = mysql_fetch_array($ok_pagez))
				{
					$id_usz = $t_pagez['id_us'];
				}
				if ($id_usz == $id_user)
				{
					echo "Вы подали уже заявку в эту команду, ожидайте решения.";
				}
				else
				{
?>	
<script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery('#example-1').click(function(){
                    jQuery(this).load('query/ad_comand_op.php?id=<?
					echo "$id";
?>');                
                }) 
            });
            $("#loading").bind("ajaxSend", function(){
    $(this).show(); // показываем элемент
}).bind("ajaxComplete", function(){
    $(this).hide(); // скрываем элемент
});
           
         </script>        
        <div class="example cursor" id="example-1" align="center"><a>Подать заявку</a></div>
        <div  id="loading">Ждите ответа в следующей серии...</div>
  <style type="text/css">#loading {display:none;}</style>	
		<?
				}
			}
		}
		echo "<table>";
		$ok_page = mysql_query("select * from comand_us where id_command = $id  order by tip");
		{
			while ($t_page = mysql_fetch_array($ok_page))
			{
				$id_us = $t_page['id_us'];
				$tip = $t_page['tip'];
				$id_zap_us = $t_page['id'];
				$user = user_info($id_us);
				if ($tip == "1")
				{
					$pict = "<img src=\"$site/img/ico/admin_icon.png\" border=\"0\" alt=\"Основатель\">";
				}
				else
					if ($tip == "2")
					{
						$pict = "<img src=\"$site/img/ico/kwifimanager.png\" border=\"0\" alt=\"Командование\">";
					}
					else
						if ($tip == "3")
						{
							$pict = "<img src=\"$site/img/ico/kuser.png\" border=\"0\" alt=\"Участники\">";
						}
						else
						{
							$pict = "";
						}
						echo "<tr><td>$pict</td><td>$user</td>";
				if ($master == 1 or $adm == 1)
				{
					echo "<td><a href=\"$site/command/del_user.php?id=$id_zap_us\" rel = \"facebox\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"Удалить\"></a></td>";
				}
				echo "</tr>";
			}
		}
		echo "</table>";
		echo "<h5 align = \"center\">Приглашены</h5>";
		echo "<table>";
		$ok_prig = mysql_query("select * from query where id_tip = 1 and id_mer = $id  and ok = 5");
		while ($t_prig = mysql_fetch_array($ok_prig))
		{
			$id_prig = $t_prig['id_master'];
			$id_pr = $t_prig['id'];
			$user_prig = user_info($id_prig);
			echo "<tr><td>$user_prig</td>";
			$master = dostup_comand($id);
			$adm = dostup_adm();
			if ($master == 1 or $adm == 1)
			{
				echo "<td><a href=\"$site/query/ok.php?ok=2&id=$id_pr\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"Удалить\"></a></td>";
			}
		}
		echo "</tr>";
		echo "</table>";

echo "</table>";
		echo "<h5 align = \"center\">Подали заявки</h5>";
		echo "<table>";
		$ok_prig = mysql_query("select * from query where id_tip = 1 and id_mer = $id  and ok = 0");
		while ($t_prig = mysql_fetch_array($ok_prig))
		{
			$id_prig = $t_prig['id_us'];
			$id_pr = $t_prig['id'];
			$user_prig = user_info($id_prig);
			echo "<tr><td>$user_prig</td>";
			$master = dostup_comand($id);
			$adm = dostup_adm();
			if ($master == 1 or $adm == 1)
			{
				echo "<td><a href=\"$site/query/ok.php?ok=2&id=$id_pr\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"Удалить\"></a></td>";
			}
		}
		echo "</tr>";
		echo "</table>";



	}
}
require ("theme/$theme/$theme.htm");
?>