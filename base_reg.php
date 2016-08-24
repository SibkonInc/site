<?php
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";

// Основное окно
	function action()
		{
		echo"Привет";
		}
		
// Шапка		
function title()
{
	global $name_site, $site, $god_site;
	echo "
<title>Список регистрации на $name_site $god_site | $name_site</title>
<script type=\"text/javascript\" src=\"$site/js/jquery.dataTables.js\"></script>
<link type=\"text/css\" rel=\"stylesheet\" href=\"$site/js/dataTables.css\" media=\"all\">
";
}
	
	
	
// Список пользователей
	function right()
{
	global $id_user, $site, $name_site, $god_site;
	if ($id_user == "")
	{
		error(6);
	}
	else
	{
		$ok_reg = mysql_query("select * from registr  WHERE `reg` !=  '0' and `god` = '$god_site'");
		$itog_reg1 = mysql_num_rows($ok_reg);
		echo "<p>Всего зарегистрировано: $itog_reg1</p>";
		echo "<p><table id=\"example\" class=\"display\"><thead><th>Ник</th><th>Имя</th><th>Город</th><th>Статус</th></thead>";
		$registr = mysql_query("select * from registr where god = $god_site");
		while ($registr_s = mysql_fetch_array($registr))
		{
			$reg = $registr_s['reg'];
			$pod = $registr_s['pod'];
			$id_us = $registr_s['id_us'];
			$query = "select * From `us` where `id_us` = $id_us ";
			$result = mysql_query($query);
			while ($link = mysql_fetch_array($result, MYSQL_ASSOC))
			{
				$tip_us = "$link[tip_us]";
				$nick_us = "$link[nick_us]";
				$gorod = "$link[gorod_us]";
				$name = "$link[name_us]";
				$fam = "$link[fam_us]";
                $pass = "$link[pass_us]";
			}
			$user = user_info($id_us);
			$status = statusp($id_us);
			if ($status == "1")
			{
				$status = "Зарегистрирован";
			}
			else
				if ($status == "2")
				{				
                
                $queryr = "select * From `room_us` where `id_us` = $id_us ";
			$resultr = mysql_query($queryr);
			while ($linkr = mysql_fetch_array($resultr, MYSQL_ASSOC))
			{
			//	$id_room = "$linkr[id_command]";
			}
                if ($id_room == "")
                {
                    $status = "Подтвержден";
                }
                else
                {
                  $status =  name_room($id_room);  
                }
                }
                
			echo "<tr><td><a title = \"$nick_us\" href = \"$site/profile.php?id=$id_us\">$nick_us</a></td><td>$name $fam</td><td>$gorod</td><td>$status $rom</td></tr>";
            $id_room = "";
		}
		echo "</tbody></table><script type=\"text/javascript\">
$(document).ready(function(){
  $(\"#example\").dataTable();
});
</script>";
	}
}
require ("theme/$theme/$theme.htm");
?>