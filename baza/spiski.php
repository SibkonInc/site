<?php 
	include_once ('header.php');
	require_once "functions.php";
	?>

		<div id="center_wrap">
		<?php 
		if(isset($_SESSION['id'])) 
			{
?>
<div id="one_column">
<?php
		echo "<h4 align = \"center\">Список регистрации</h4>";
		$ok_reg = mysql_query("select * from registr  WHERE `reg` !=  '0' and `god` = 2016");
		echo "<p><table border=1><thead><th>Ник</th><th>Имя</th><th>Фамилия</th><th>Город</th></thead>";
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
                
			echo "<tr><td><a title = \"$nick_us\" href = \"$site/profile.php?id=$id_us\">$nick_us</a></td><td>$name</td><td>$fam</td><td>$gorod</td></tr>";
            $id_room = "";
		}
		echo "</tbody></table>";

?>			
			
			</div>
			<div id="two_column">
				<?php
					include ('spisok.php');
				?></div>
			<?php
			} 
		else 
			{ 
			echo"<center><b>ВЫ НЕ АВТОРИЗОВАНЫ!</b></center>";
			} 
?>
			
	
		</div>
		<?php 
	include_once ('footer.php');
	?>