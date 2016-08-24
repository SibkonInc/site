<head>
  <meta charset="utf-8">

 </head>

<style type="text/css">
table {
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid black;
}
</style>

<?php 
require_once "functions.php";
 ?>
 
	<center><b>Статистика поселения</b>
	
	<table><tr><td>Участник</td><td>Должен оплатить</td><td>Питание</td><td>Оплатил</td><td>Тип оплаты</td><td>Когда оплатил</td><td>Комментарий</td></tr>
	<?php
	$statpos = mysql_query("select * from stat_baza where god = $god_site");
	$prov=0;
	$sanvzn=0;
	{
		while ($t_page = mysql_fetch_array($statpos)) 
			{	
				$proverka = $t_page['proverka'];
				$sanvznos = $t_page['sanvznos'];
				if ($proverka == 1) {
					$prov++;

				}
				if ($sanvznos == 1) {
					$sanvzn++;

				}				
		}
	}
	
	$money = mysql_query("select * from room_us where god = $god_site");
{			$i=0;
			$baza=0;
			$krovat=0;
			$krovat_baza=0;
			$lyks=0;
			$lyks_baza=0;
			$spaln=0;
			$spaln_baza=0;
			$dnev=0;
			$dnev_baza=0;
			$pit_ch=0;
			$pit_pt=0;
			$pit_sb=0;
			$pit_vs=0;
			$pit_ch_baza=0;
			$pit_pt_baza=0;
			$pit_sb_baza=0;
			$pit_vs_baza=0;
			$all_money = 0;
			$dnev_money = 0;
			$all_pit_money = 0;
    while ($t_page = mysql_fetch_array($money)) {	       
		$id_room = $t_page['id_command'];
		$tip_opl = $t_page['tip_opl'];
		$tip_room = $t_page['tip'];
		$str = $t_page['changed'];// $str - строка
		$timestamp = strtotime($str);// $timestamp - уже дата
		$summa_opl = $t_page['summa_opl'];
		$date_opl = '2016-01-22 23:55:00';
		$date_reg = '2016-02-10 23:55:00';
		$null_date = '0000-00-00 00:00:00';
		$timestamp2 = strtotime($date_opl);
		$timestamp3 = strtotime($date_reg);
		$timestamp4 = strtotime($null_date);
		$name_room = name_room($id_room);
		$id_user = $t_page['id_us'];
		$i++;
		
		if ($summa_opl > 0 and strtotime($str) > strtotime($date_reg)) {
			$comment = 'Оплата на базе';	
			$baza++;}
			else if (strtotime($str) <= strtotime($date_opl) and strtotime($str) > strtotime($null_date))
			$comment = 'Предоплата';
				else if ($str == $null_date)
				$comment = '';
					else
					$comment = 'Полная оплата';
		$query = "select * From `us` where `id_us` = $id_user";

		$result = mysql_query($query); {
            while ($link = mysql_fetch_array($result, MYSQL_ASSOC)) {
                $act_us = "$link[act_us]";
                $id_u = "$link[id_us]";
                $name_us = "$link[name_us]";
                $fam_us = "$link[fam_us]";
                $tip_us = "$link[tip_us]";
				
                $nick_us = "$link[nick_us]";
                if ($tip_us == "9") {
                    $nick_us = "<strike>$nick_us</strike>";
                }
                $gorod_us = "$link[gorod_us]";
                $login_us = "$link[login_us]";
                $pass_us = "$link[pass_us]";
                $act_us = "$link[act_us]";
                $mail_us = "$link[mail_us]";
                $telefon_us = "$link[telefon_us]";
                $passport_us = "$link[passport_us]";
                $foto_us = "$link[foto_us]";
                $osebe = nl2br($link[osebe]);
                $god_us = "$link[god_us]";
                $contact = "$link[contact]";
                $contact = nl2br($link[contact]);
                $master = "$link[master]";
                $interest = "$link[interest]";
                $interest = nl2br($link[interest]);
            }
        }			
				    $ok_page = mysql_query("select room_us.*, room.tip from room_us JOIN room ON room_us.id_command = room.id where id_us = $id_user and god = $god_site");
                    
					while ($t_page = mysql_fetch_array($ok_page)) {
						
                        $id_room = $t_page['id_command'];
						$tip_opl = $t_page['tip_opl'];
						$tip_room = $t_page['tip'];
						$summa_opl = $t_page['summa_opl'];
						$name_room = name_room($id_room);
						$predoplata = $t_page['predoplata'];
							$ok_page = mysql_query("select * from sibkon where god = $god_site");
								while ($t_page = mysql_fetch_array($ok_page)) 
								{
									$st_lux = $t_page['st_lux'];
									$st_spa = $t_page['st_spa'];
									$st_kro = $t_page['st_kro'];
									if ($predoplata == 0)
									{	
									$orgvznos = $t_page['orgvzos2'];
									$summ_k = $t_page['st_kro']+$t_page['orgvzos2'];
									$summ_s = $t_page['st_spa']+$t_page['orgvzos2'];
									$summ_l = $t_page['st_lux']+$t_page['orgvzos2'];
									}
									else
									{
									$orgvznos = $t_page['orgvzos'];
									$summ_k = $t_page['st_kro']+$t_page['orgvzos'];
									$summ_l = $t_page['st_lux']+$t_page['orgvzos'];
									$summ_s = $t_page['st_spa']+$t_page['orgvzos'];
									}
								}		
					
					}
					
$ok_page = mysql_query("select * from room_opros where id = $id_user");
$t_opros = mysql_fetch_array($ok_page);
if (!$result = mysql_fetch_array($ok_page)){
$chet='0';
$pyat='0';
$subb='0';
$vos='0';
$predop='1200';
if (!empty($t_opros["data"])) {	
	$opros = @json_decode($t_opros["data"]);
		if (!empty($opros)) {
		if ($opros->pitanie == "3") {$sum_pit=$predop;  $pit_ch++; $pit_pt++; $pit_sb++; $pit_vs++;} else
		if ($opros->pitanie == "1") {$sum_pit = 0;} else
		if ($opros->pitanie == "2") {
			if(in_array("1", $opros->pitanie_choice)) {$chet='400'; if($summa_opl > 0 and strtotime($str) >= strtotime($date_reg)) $pit_ch_baza++;}
			if(in_array("2", $opros->pitanie_choice)) {$pyat='500'; if($summa_opl > 0 and strtotime($str) >= strtotime($date_reg))  $pit_pt_baza++;}
			if(in_array("5", $opros->pitanie_choice)) {$subb='500'; if($summa_opl > 0 and strtotime($str) >= strtotime($date_reg))  $pit_sb_baza++;}
			if(in_array("8", $opros->pitanie_choice)) {$vos='100'; if($summa_opl > 0 and strtotime($str) >= strtotime($date_reg))  $pit_vs_baza++;}
			$sum_pit = $chet + $pyat + $subb + $vos;
			}
if($sum_pit == "1500" and strtotime($str) <= strtotime($date_opl) and strtotime($str) > strtotime($null_date)) $sum_pit = $chet + $pyat + $subb + $vos;}}else{$sum_pit = "0";}}																
			if ($tip_room == 1){
			if($predoplata == 1 and $summa_opl > 0)
				$krovat++;
				else if($summa_opl > 0 and strtotime($str) >= strtotime($date_reg))
				$krovat_baza++;
                   	if ($tip_opl == 0){
					$orgvznos;									
					$poln=$summ_k;
						} else if ($tip_opl == 1) {$poln=$st_kro;
									}else if ($tip_opl == 2) {$poln=$orgvznos;
											}else if ($tip_opl == 3) {$poln=0;}else if ($tip_opl == 5) {$orgvznos = 500;$poln=$st_kro + $orgvznos;}
																				
					} else if ($tip_room == 3) {
						if($predoplata == 1 and $summa_opl > 0)
						$lyks++;
						else if($summa_opl > 0 and strtotime($str) >= strtotime($date_reg))
						$lyks_baza++;
						if ($tip_opl == 0){
							$orgvznos;									
							$poln=$summ_l;							
							} else if ($tip_opl == 1) {$poln=$st_lux;
									}else if ($tip_opl == 2) {
										$poln=$orgvznos;
											}else if ($tip_opl == 3) {$poln=0;}else if ($tip_opl == 5) {$orgvznos = 500;$poln=$st_lux + $orgvznos;}
									
							} else if ($tip_room == 2) {
								if($predoplata == 1 and $summa_opl > 0)
								$spaln++;
								else if($summa_opl > 0 and strtotime($str) >= strtotime($date_reg))
								$spaln_baza++;
						if ($tip_opl == 0){							
							$orgvznos;
							$poln=$summ_s;
							} else if ($tip_opl == 1) {
							$poln=$st_spa;
									}else if ($tip_opl == 2) {$poln=$orgvznos;
											}else if ($tip_opl == 3) {$poln=0;}else if ($tip_opl == 5) {$orgvznos = 500;$poln=$st_spa + $orgvznos;}
							}else if ($tip_room == 4) {
							if(strtotime($str) <= strtotime($date_reg))
								$dnev++;
								else if($summa_opl > 0 and strtotime($str) >= strtotime($date_reg))
								$dnev_baza++;
							}
							$all_money += $poln;
							$all_pit_money += $sum_pit;
							if($tip_room == 4)
							{$dnev_money += $summa_opl;}
							
		echo "<tr><td>$name_us $fam_us</td><td>";if ($tip_room == 4) {echo"Дневное";} else {echo"$poln";} echo"</td><td>$sum_pit</td><td>$summa_opl</td><td>"; if($tip_opl == 0) echo "Полная оплата"; else if($tip_opl==1) echo "Без суммы взноса"; else if($tip_opl==2) echo "Без суммы проживания"; else if($tip_opl==3) echo "Бесплатно"; else if($tip_opl==5) echo "50% взноса"; echo"</td><td>";if ($timestamp > strtotime($date_reg)) echo"На базе"; else  if ($timestamp < "1990-01-01 00:00:00") echo "-"; else echo date('Y-m-d', $timestamp); echo"</td><td>"; if ($tip_opl == 3) {echo"Бесплатно";} else {echo"$comment";} echo"</td></tr>";
			
  }
}
echo"$cnt";
			$all_ch=$pit_ch+$pit_ch_baza;
			$all_pt=$pit_pt+$pit_pt_baza;
			$all_sb=$pit_sb+$pit_sb_baza;
			$all_vs=$pit_vs+$pit_vs_baza;
			
			
?>


</table><br><br>
		<table border=0><tr  valign=top><td>
		<table width=300px>
		<tr><td colspan=3><center><b>Статистика по поселению</b></center></td></tr>
		<tr><td><b>Оплатили:</b></td><td>На базе</td><td>До базы</td></tr>
		<tr><td>Спальники</td><td><?php echo"$spaln_baza человек";?></td><td><?php echo"$spaln человек";?></td></tr>
		<tr><td>Кровати</td><td><?php echo"$krovat_baza человек";?></td><td><?php echo"$krovat человек";?></td></tr>
		<tr><td>Люкс</td><td><?php echo"$lyks_baza человек";?></td><td><?php echo"$lyks человек";?></td></tr>
		<tr> <td colspan=3><b>Приехало: <?php echo"$prov человек";?></b></td></tr>
		<?php $vsego = $spaln + $krovat + $lyks; ?>
		<tr> <td colspan=3>Всего по сайту без дневников: <?php echo"$vsego человек";?></td></tr>
		<tr><td>Дневное</td><td><?php echo"$dnev_baza человек";?></td><td><?php echo"$dnev человек";?></td></tr>
		<tr><td>Дневники оплатили:</td><td><?php echo"$dnev_money .р";?></td><td></td></tr>
		</table>
		</td><td>
		<table width=300px>
		<tr><td colspan=5><center><b>Статистика оплаты питания</b></center></td></tr>
		<tr><td><b>Оплатили:</b></td><td>ЧТ.</td><td>ПТ.</td><td>СБ.</td><td>ВС.</td></tr>
		<tr><td>До базы:</td><td><?php echo"$pit_ch";?></td><td><?php echo"$pit_pt";?></td><td><?php echo"$pit_sb";?></td><td><?php echo"$pit_vs";?></td></tr>
		<tr><td><b>На базе:</b></td><td><?php echo"$pit_ch_baza";?></td><td><?php echo"$pit_pt_baza";?></td><td><?php echo"$pit_sb_baza";?></td><td><?php echo"$pit_vs_baza";?></td></tr>
		<tr><td><b>ВСЕГО:</b></td><td><?php echo"$all_ch";?></td><td><?php echo"$all_pt";?></td><td><?php echo"$all_sb";?></td><td><?php echo"$all_vs";?></td></tr>
		<tr><td>Денег за еду:</td><td colspan=4><?php echo"$all_pit_money .р";?></td></tr>
		</table></td></tr></table>
		<br>
	<table width=300px>
		<tr>
			<td colspan=3>
			До 22.01.2016
			</td>
			</tr>
		<tr> <td colspan=3> Всего:
		<?php			
			$query = mysql_query("select sum(summa_opl) from room_us where god = $god_site and predoplata = 1");
			$sum=mysql_result($query,0);	
			echo"$sum р.";
			?>
		</td></tr>
		</table><br>		
		<!--<table  border=1  width=300px>
		<tr>
			<td colspan=3>
			После предоплаты и до базы
			</td>
			</tr>
		<tr> <td colspan=3> Всего:
		<?php
			
		//	$query = mysql_query("select sum(summa_opl) from room_us where god = $god_site and predoplata = 0");
			//$sum=mysql_result($query,0);	
			//echo"$sum р.";
			?>
		</td></tr>
		</table>-->
		<table  border=1 width=300px>
				<tr>
			<td colspan=3>
			На базе оплатили проживание:
			</td>
			</tr>
			<tr> <td colspan=3> Всего:
			<?php			
			$query = mysql_query("select sum(summa_opl) from room_us where god = $god_site and unix_timestamp(changed) > $timestamp3 and predoplata = 0");
			$sum=mysql_result($query,0);	
			echo"$sum р.";
			?>
		</td></tr>
		</table><br>
		<table  border=1 width=300px>
				<tr>
			<td colspan=3>
			Санвзносов сдали
			</td>
			</tr>
			<tr> <td colspan=3> Всего:
			<?php		$sumsan=$sanvzn*200;	
			echo"$sumsan р.";
			?>
		</td></tr>
		</table><br>
		<!--<table width=300px>
		<tr>
			<td>
			Вообще всего:
			</td>
		</tr>
		<tr>
			<td>
			//<?php
			//$query = mysql_query("select sum(summa_opl) from room_us where god = $god_site");
			//$sum=mysql_result($query,0);	
			//echo"$sum р.";
			//?>
			</td>
		</tr>
	</table>
	<br>
	<table width=300px>
		<tr>
			<td>
			Суммарно предполагалось:
			</td>
		</tr>
		<tr>
			<td>
			<?php
			//$query = mysql_query("select sum(summa_opl) from room_us where god = $god_site");
			//$sum=mysql_result($query,0);	
			//echo"$all_money р.";
			?>
			</td>
		</tr>
	</table>-->
	</center>

