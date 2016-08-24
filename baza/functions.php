<?php
//файл настроек проверок и подключений
//Подключаемся к базе данных.
$user = "root";
$db = "db3513b";
mysql_connect("mysql-1", "us3513b", "ghtdtlrhfcfdxtu") or die("Нет подключения к серверу базы данных. Повторите попытку позже.");
mysql_query('SET NAMES utf8');
mysql_select_db($db) or die("Невозможно подключиться к Базе данных");

//получаем данные о сайте.
$site = mysql_query("select * from setting_site");
{
    while ($site_i = mysql_fetch_array($site)) {
        $name_site = $site_i['name_site'];
        $status_site = $site_i['status_site'];
        $status_text = $site_i['status_text'];
        $theme = $site_i['theme'];
        $god_site = $site_i['god'];
        $reg_on = $site_i[reg];
        $menu = $site_i[menu];
        $name_group = $site_i[name_group];
    }
}
function format_date_mes($date) {
    //определяем название месяца из даты
    if ($date > 0) {
        $array = explode('-', $date); //Разбиваем MySQL дату на массив
        //Создаем русские названия месяцев для последующей замены
        $month['01'] = 'января';
        $month['02'] = 'февраля';
        $month['03'] = 'марта';
        $month['04'] = 'апреля';
        $month['05'] = 'мая';
        $month['06'] = 'июня';
        $month['07'] = 'июля';
        $month['08'] = 'августа';
        $month['09'] = 'сентября';
        $month['10'] = 'октября';
        $month['11'] = 'ноября';
        $month['12'] = 'декабря';
        if ($array[2] < 10) { //Если день месяца меньше десяти, то убераем ноль перед числом
            $array[2] = str_replace(0, '', $array[2]);
        }
        $day = date('D', mktime(0, 0, 0, $array[1], $array[2], $array[0])); //Получаем день недели для данной даты
        //Возвращаем отформатированную дату
        return $month[$array[1]];
    }
}

function format_date_html($date) {
    //формат даты для прописи
    $array = explode('-', $date); //Разбиваем MySQL дату на массив
    //Создаем русские названия месяцев для последующей замены
    $month['01'] = 'янв';
    $month['02'] = 'фев';
    $month['03'] = 'мар';
    $month['04'] = 'апр';
    $month['05'] = 'мая';
    $month['06'] = 'июн';
    $month['07'] = 'июл';
    $month['08'] = 'авг';
    $month['09'] = 'сент';
    $month['10'] = 'окт';
    $month['11'] = 'ноя';
    $month['12'] = 'дек';
    if ($array[2] < 10) { //Если день месяца меньше десяти, то убераем ноль перед числом
        $array[2] = str_replace(0, '', $array[2]);
    }
    $day = date('D', mktime(0, 0, 0, $array[1], $array[2], $array[0])); //Получаем день недели для данной даты
    //Возвращаем отформатированную дату
    return $array[2] . ' ' . $month[$array[1]] . ' ' . $array[0] . '';
}

function regpodpos() {
    global $god_site, $id_u;
    $ok_page_s = mysql_query("select * from sibkon where god = $god_site");
    while ($t_page_s = mysql_fetch_array($ok_page_s)) {
        $id_s = $t_page_s['id'];
        $tema_s = $t_page_s['tema'];
        $date_reg = $t_page_s['data_reg'];
        $date_pod = $t_page_s['data_pod'];
        $date_pos = $t_page_s['data_pos'];
    }
    $date_now = date("Ymd");
    $date_reg = date("Ymd", strtotime($date_reg));
    $date_pod = date("Ymd", strtotime($date_pod));
    $date_pos = date("Ymd", strtotime($date_pos));
    if ($date_reg < $date_now) {
        $regpodpos = "1";
    } if ($date_pod < $date_now) {
        $regpodpos = "2";
    } if ($date_pos < $date_now) {
        $regpodpos = "3";
    }
echo "<!-- regpodpos[$regpodpos]: ($date_now) ($date_reg) ($date_pod) ($date_pos) -->";

    return $regpodpos;
}
function status() {
    global $id_u, $god_site;
    $registr = mysql_query("select * from registr where god = $god_site and id_us = $id_u");
    while ($registr_s = mysql_fetch_array($registr)) {
        $reg = $registr_s['reg'];
        $pod = $registr_s['pod'];
    }
    if ($reg == "1") {
        $status = "1";
    } else
    if ($reg == "2") {
        $status = "2";
    } else {
        $status = "0";
    }
    return $status;
}
function user_info($id_us) {
    global $site, $id_user;
    $query = "select * From `us` where `id_us` = '" . $id_us . "'";
    $result = mysql_query($query);
    while ($link = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $tip_us = "$link[tip_us]";
        $nick_us = "$link[nick_us]";
        $master_us = "$link[master]";
        if ($tip_us == "9") {
            $nick_us = "<strike>$nick_us</strike>";
        }
        //$info = "<a href=profile.php?id=$id_us class=underline>$nick_us</a>";
		$info = "$nick_us";
         return $info;
    }
}

function user_inf($id_u) {
    $query = "select * From `us` where `id_us` = '" . $id_u . "'";
    $result = mysql_query($query);
    while ($link = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $tip_us = "$link[tip_us]";
        $nick_us = "$link[nick_us]";
        if ($tip_us == "9") {
            $nick_us = "<strike>$nick_us</strike>";
        }
        $info = "$nick_us";
        return $info;
    }
}

function statusp($id_u) {
    global $id_u, $god_site;
    $registr = mysql_query("select * from registr where god = $god_site and id_us = $id_u");
    while ($registr_s = mysql_fetch_array($registr)) {
        $reg = $registr_s['reg'];
        $pod = $registr_s['pod'];
    }
    if ($reg == "1") {
        $status = "1";
    } else
    if ($reg == "2") {
        $status = "2";
    } else {
        $status = "0";
    }
    return $status;
}

function name_room($id) {
    global $site;
    if (!($id == "")) {

        $ok_page = mysql_query("select * from room where id = $id");
        while ($t_page = mysql_fetch_array($ok_page)) {
            $id = $t_page['id'];
            $name = $t_page['name'];
        }
        $name_sibkon = "$name";

        return $name_sibkon;
    }
}

function name_room_name($id) {
    global $site;
    $ok_page = mysql_query("select * from room where id = $id");
    while ($t_page = mysql_fetch_array($ok_page)) {
        $id = $t_page['id'];
        $name = $t_page['name'];
    }
    $name_sibkon = "$name";
    return $name_sibkon;
}

function room_kolvo($id) {
    global $site;
    $ok_page = mysql_query("select * from room where id = $id");
    while ($t_page = mysql_fetch_array($ok_page)) {
        $id_r = $t_page['id'];
        $kolvo = $t_page['kolvo'];
        $ok_reg = mysql_query("select * From `room_us` where  id_command = $id_r");
        $itog_reg1 = mysql_num_rows($ok_reg);
    }
    $svobodno = $kolvo - $itog_reg1;
    return $svobodno;
}

function poselen($id_u) {
    global $id_u, $god_site;
    $registr = mysql_query("select * from room_us where god = $god_site and id_us = $id_u");
    while ($registr_s = mysql_fetch_array($registr)) {
        $id = $registr_s['id_command'];
    }
    return $id;
}

function registr() {
    global $id_u, $god_site, $id_us_m, $site, $name_site;
    $ok_page_s = mysql_query("select * from sibkon where god = $god_site");
    while ($t_page_s = mysql_fetch_array($ok_page_s)) {
        $ok_page = mysql_query("select * from sibkon where god = $god_site");
        while ($t_page = mysql_fetch_array($ok_page)) {
            $date_in_m = date("m", strtotime($date_in));
            $date_now = date("Ymd");
			$date_god = date("Y", strtotime($date_out));
            $data_reg = format_date_html($t_page['data_reg']);
            $data_pod = format_date_html($t_page['data_pod']);
            $data_pos = format_date_html($t_page['data_pos']);
        }
        $regpodpos = regpodpos();
		        $status = status();
        $ok_page = mysql_query("select * from us where id_us = $id_u");
        while ($t_page = mysql_fetch_array($ok_page)) {
		$ban = $t_page['ban'];
		}
        
		if ($ban == "1")
		            echo "<BR><b><center><strong><font color=red>ПОЛЬЗОВАТЕЛЬ ЗАБЛОКИРОВАН</font></strong></center></b>";
					
        if ($regpodpos == false) {
            echo "<br>начнется $data_reg";
        } else
        if ($regpodpos == "1") {
            if ($status == "1") {
                echo "<div id=green_stat><strong><font color=green>Зарегистрирован</font></strong></div>
				<div id=red_stat><strong><font color=red>Не подтвержден</font></strong><a href=\"http://sibkon.org/baza/registr.php?id=2&id_u=$id_u\">Подтвердить</a></div>
						   <div id=red_stat><strong><font color=red>Не поселен</font></strong><button>Поселить</button></div>";
            } else {
                echo "<div id=red_stat><strong><font color = \"#FE0505\">Не зарегестрирован!</font></strong><a href=\"http://sibkon.org/baza/registr.php?id=1&id_u=$id_u\">Регистрировать</a> </div>
				<div id=red_stat><strong><font color=red>Не подтвержден</font></strong><a href=\"http://sibkon.org/baza/registr.php?id=2&id_u=$id_u\">Подтвердить</a></div>
						   <div id=red_stat><div id=select><select>";spisok_komnat();echo"</select></div><button>Поселить</button></div>";
            }
        } else
        if ($regpodpos == "2") {
            if ($status == "1") {
                 echo "<div id=green_stat><strong><font color=green>Зарегистрирован</font></strong></div>
					   <div id=red_stat><strong><font color=red>Не подтвержден</font></strong><a href=\"http://sibkon.org/baza/registr.php?id=2&id_u=$id_u\">Подтвердить</a></div>";
            } elseif ($status == "2") {
                echo "<div id=green_stat><strong><font color=green>Зарегистрирован</font></strong></div>
					  <div id=green_stat><strong><font color=green>Подтвержден</font></strong></div>";
            } else {
                echo "<div id=red_stat><strong><font color = \"#FE0505\">Не зарегестрирован!</font></strong><a href=\"http://sibkon.org/baza/registr.php?id=1&id_u=$id_u\">Регистрировать</a> </div>";
            }
        } else
        if ($regpodpos == "3") {
            if ($status == "1") {
                     echo "<div id=green_stat><strong><font color=green>Зарегистрирован</font></strong><a href=\"http://sibkon.org/baza/registr.php?id=4&id_u=$id_u\">Отменить</a></div>
						   <div id=red_stat><strong><font color=red>Не подтвержден</font></strong></td><td><a href=\"http://sibkon.org/baza/registr.php?id=2&id_u=$id_u\">Подтвердить</a></div>
						   <div id=red_stat><div id=select><select name=spisok_komant>";spisok_komnat();echo"</select></div><a href=\"admin/poselit.php?id=$id_u\"  onclick=\"return confirm('Точно поселить в "; if(isset($_POST['spisok_komant'])) echo $_POST['spisok_komnat']; echo"')\">Поселить</a></div>";
            } elseif ($status == "2") {
               echo "<div id=green_stat><strong><font color=green>Зарегистрирован</font></strong><a href=\"http://sibkon.org/baza/registr.php?id=4&id_u=$id_u\">Отменить</a></div>
					 <div id=green_stat><strong><font color=green>Подтвержден</font></strong><a href=\"http://sibkon.org/baza/registr.php?id=3&id_u=$id_u\">Отменить</a></div>";
                $poselen = poselen($id_user);
                if ($poselen == "") {
                            echo "<div id=red_stat><div id=select>";?>
							<?echo"<form  action=\"admin/poselit.php?id=$id_u\" method=\"post\">";?>
							<select name="spisok">
							<option value="0">Выберите комнату</option>
							<?spisok_komnat();?>
					"</select><input type=submit value=Поселить  onclick=return confirm('Точно поселить?')></div></div>							
							</form>												
                <?} else {
                    $name_room = name_room($poselen);
                    echo "<div id=green_stat><strong><font color=green>Поселен в: </font></strong>$name_room <br>
					<a href=\"admin/room_del_user.php?id=$id_u\" onclick=\"return confirm('Точно отменить поселение?')\">Отменить поселение</a> </div>";
                }
            } else {
                             echo "<div id=red_stat><strong><font color = \"#FE0505\">Не зарегестрирован!</font></strong><a href=\"http://sibkon.org/baza/registr.php?id=1&id_u=$id_u\">Регистрировать</a> </div>
							 <div id=red_stat><strong><font color=red>Не подтвержден</font></strong></td><!--<td align=right><a href=\"http://sibkon.org/baza/registr.php?id=2&id_u=$id_u\">Подтвердить</a></td>--></tr></table></div>
						   <div id=red_stat><div id=select><select name=spisok>";spisok_komnat();echo"</select></div><a href=\"admin/poselit.php?id=$id_u\"  onclick=\"return confirm('Точно поселить?')\">Поселить</a></div>";
            }
        }
    }	
}


function spisok_komnat()
{
   global $site, $name_site, $god_site;
							   $ok_page = mysql_query("select * from room where id_con = $god_site");
   while ($t_page = mysql_fetch_array($ok_page))
   {
      $id_room = $t_page['id'];
     $name_room = $t_page['name'];
      $kolvo = $t_page['kolvo'];
      $ok_reg = mysql_query("select * From `room_us` where id_command = $id_room");
      $itog_reg1 = mysql_num_rows($ok_reg);
      $svobodno = $kolvo - $itog_reg1;
		if($svobodno > "0") {
      echo "<option value=\"$id_room\">$name_room</option>"; 
		}
	}
		
}

function block_money() {
    global $id_user, $site, $god_site;
    if (isset($_GET['id'])) {
            $id = addslashes($_GET['id']);
        } else {
            echo"none";
        }
        $query = "select * From `us` where `id_us` = '" . $id . "'";

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
 		//статус поселения

        $status = status($id_u);
        if ($status == "2") {
            $poselen = poselen($id_u); {
                if (!($poselen == "")) {
				    $ok_page = mysql_query("select room_us.*, room.tip from room_us JOIN room ON room_us.id_command = room.id where id_us = $id_u and god = $god_site");
                    while ($t_page = mysql_fetch_array($ok_page)) {
                        $id_room = $t_page['id_command'];
						$tip_opl = $t_page['tip_opl'];
						$tip_room = $t_page['tip'];
						$changed = $t_page['changed'];
		$str = $t_page['changed'];// $str - строка		
		$timestamp = strtotime($str);// $timestamp - уже дата
		$summa_opl = $t_page['summa_opl'];
		$new_summa_opl = $t_page['new_summa_opl'];
		$custom_opl = $t_page['custom_opl'];
		$date_opl = '2016-01-05 23:55:00';
		$date_reg = '2016-02-10 23:55:00';
		$null_date = '0000-00-00 00:00:00';
		$predoplata = $t_page['predoplata'];
						$name_room = name_room($id_room);
							$ok_page = mysql_query("select * from sibkon where god = $god_site");
								while ($t_page = mysql_fetch_array($ok_page)) 
								{
									$st_lux = $t_page['st_lux'];
									$st_spa = $t_page['st_spa'];
									$st_kro = $t_page['st_kro'];
									$orgvznos3 = 750;
									if ($predoplata == 1)
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
					
					} $ok_page = mysql_query("select * from room_opros where id = $id_u");
$t_opros = mysql_fetch_array($ok_page);
$chet='0';
$pyat='0';
$subb='0';
$vos='0';
$predop='1350';
if (!empty($t_opros["data"])) {
	$opros = @json_decode($t_opros["data"]);
	if (!empty($opros)) {
	if ($opros->pitanie == "3") {$sum_pit=$predop;} else
		if ($opros->pitanie == "1") {$sum_pit=0;} else
			if ($opros->pitanie == "2") {
			if(in_array("1", $opros->pitanie_choice)) {$chet='400';}
			if(in_array("2", $opros->pitanie_choice)) {$pyat='500';}
			if(in_array("5", $opros->pitanie_choice)) {$subb='500';}
			if(in_array("8", $opros->pitanie_choice)) {$vos='100';}
			$sum_pit=$chet + $pyat + $subb + $vos;
			}}}	
					if($custom_opl == 1) {
						echo "<br>Осталось оплатить: "; $poln =  $new_summa_opl - $summa_opl;  echo "$poln.р";
						} else
					//тип комнаты
					if ($tip_room == 1){			
                    echo "Тип поселения: Кровати<br>";
						echo "Питание: $sum_pit  ";
						if ($tip_opl == 0){							
							echo "Взнос: $orgvznos.р<br>";									
							echo "Проживание: $st_kro.р<br>";
							echo "<b>Полная оплата</b>, осталось внести: "; $poln=$summ_k - $summa_opl + $sum_pit; echo "$poln.р";
							} else {if ($tip_opl == 1) {
								echo "Проживание: $st_kro.р<br>";
								echo "<b>Оплата без взноса</b>, осталось внести: "; $poln=$st_kro - $summa_opl + $sum_pit; echo"$poln.р";
									}else if ($tip_opl == 2) {
									echo "Взнос: $orgvznos.р<br>";
									echo "<b>Оплата без проживания</b>, осталось внести: "; $poln=$orgvznos - $summa_opl + $sum_pit; echo"$poln.р";
											}else if ($tip_opl == 3) {
												}else if ($tip_opl == 5) {$orgvznos = 750;												
										echo "Взнос: $orgvznos.р<br>";
										echo "50% взноса, осталось внести: "; $poln=$st_kro + $orgvznos - $summa_opl + $sum_pit; echo"$poln.р";
											}
									}											
					} else {
							if ($tip_room == 3) {
							echo "Тип поселения: Люкс<br>";	
echo "Питание: $sum_pit  ";							
						if ($tip_opl == 0){
							echo "<b>Полная оплата</b>, осталось внести: "; $poln=$summ_l - $summa_opl + $sum_pit; echo "$poln.р <br>";
							echo "Взнос: $orgvznos.р<br>";									
							echo "Проживание: $st_lux.р";
							} else {if ($tip_opl == 1) {
								echo "Проживание: $st_lux.р";
								echo "<b>Оплата без взноса</b>, осталось внести: "; $poln=$st_lux - $summa_opl + $sum_pit; echo"$poln.р";
									}else if ($tip_opl == 2) {
										echo "Взнос: $orgvznos.р<br>";
										echo "<b>Оплата без проживания</b>, осталось внести: "; $poln=$orgvznos - $summa_opl + $sum_pit; echo"$poln.р";
											}else if ($tip_opl == 3) {
												}else if ($tip_opl == 5) {
												$orgvznos = 750;
										echo "Взнос: $orgvznos.р<br>";
										echo "50% взноса, осталось внести: "; $poln=$st_lux + $orgvznos - $summa_opl + $sum_pit; echo"$poln.р";
											}
									}
							} else 
								{
								if ($tip_room == 2) {
									echo "Тип поселения: Спальник<br>";	
echo "Питание: $sum_pit  ";									
						if ($tip_opl == 0){
							echo "Взнос: $orgvznos.р<br>";									
							echo "Проживание: $st_spa.р<br>";
							echo "<b>Полная оплата</b>, осталось внести: "; $poln=$summ_s - $summa_opl + $sum_pit; echo "$poln.р";
							} else {if ($tip_opl == 1) {
							echo "Проживание: $st_spa.р<br>";
							echo "<b>Оплата без взноса</b>, осталось внести: "; $poln=$st_spa - $summa_opl + $sum_pit; echo"$poln.р";
									}else if ($tip_opl == 2) {
									echo "Взнос: $orgvznos.р<br>";
									echo "<b>Оплата без проживания</b>, осталось внести: "; $poln=$orgvznos - $summa_opl + $sum_pit; echo"$poln.р";
											}else if ($tip_opl == 3) {
												}else if ($tip_opl == 5) {
												$orgvznos = 750;
										echo "Взнос: $orgvznos.р<br>";
										echo "50% взноса, осталось внести: "; $poln=$st_spa + $orgvznos - $summa_opl + $sum_pit; echo"$poln.р";
											}
									}
									}
								}
							}					
                		//сумма оплаты
						
						
							if ($tip_opl == 3)
							echo "<br><center><b>Без суммы взноса и проживния</b></center>";
							 else 
							echo "<br>Оплатил: $summa_opl";
							
					//конец сумма оплаты
					//поменять сумму оплаты
							
							echo "<div style=\"border: 1px solid black; width:33%;
													padding: 5px;
													position: absolute;\">
							Обновить внесенную сумму:
							<form method=post action=opl.php?id=$id>
							<input style=\"width:60px;\" type=text name=summa_opl value = $summa_opl>";
							
							$ok_page = mysql_query("select * from room_us where  id_us=$id_u and god = $god_site");
								while ($t_page = mysql_fetch_array($ok_page))
							   {
								  $tip_opl = $t_page['tip_opl'];
							  echo "
							<SELECT NAME=\"tip_opl\" SIZE=\"1\">
								<OPTION VALUE=\"0\" ";
							if ($tip_opl == 0) {
								echo "selected";
							}
							echo " >Полная оплата</OPTION>
							   <OPTION VALUE=\"1\" ";
							if ($tip_opl == 1) {
								echo "selected";
							}
							echo " >Без суммы взноса</OPTION>
							   <OPTION VALUE=\"2\" ";
							if ($tip_opl == 2) {
								echo "selected";
							}
							echo " >Без суммы проживания</OPTION>
							   <OPTION VALUE=\"3\" ";
							if ($tip_opl == 3) {
								echo "selected";
							}
							echo " >Бесплатно</OPTION>
							<OPTION VALUE=\"5\" ";
							if ($tip_opl == 5) {
								echo "selected";
							}
							echo " >50% взноса</OPTION>
						   </SELECT>";
						   
						   }
						   echo "
							<input type=submit value=Изменить name=submit>
							</form>
							</div>";							
							
					//конец поменять сумму оплаты
				}
            }
        }
		//конец статуса поселения
    }

//pitanie
//////////////////////////////////////////////////////////
// опрос по питанию начало
//////////////////////////////////////////////////////////
function ad_log($mess_log) {
    global $id;
    $date_news = date("Y-m-d H:i");
    mysql_query("insert into `log_baza`(data,name,whot) values('$date_news', '$id', '$mess_log')");
}

function opros2() 
{ 
       if (isset($_GET['id'])) {
            $id = addslashes($_GET['id']);
        } else {
            echo"none";
        }
        $query = "select * From `us` where `id_us` = '" . $id . "'";
   $ok_page = mysql_query("select * from room_opros where id = $id");
	
$t_opros = mysql_fetch_array($ok_page);
$res = 1;

   if (!empty($t_opros))
   {
$res = 1;
	if (1) {
if (!empty($t_opros["data"])) {
	$opros = @json_decode($t_opros["data"]);
	if (!empty($opros)) {

	?>
	<div id="choice_view"><fieldset style="margin-top:10px;">Выбрано: 
	<?php if ($opros->pitanie == "3") { echo "<Strong>Питается по предоплате</Strong>";  }?>

<?php if ($opros->pitanie == "1") { echo "<Strong>Не питается в столовой</Strong>"; } ?>
<?php if ($opros->pitanie == "2") { echo "<Strong>Питается в столовой</Strong>";  ?>
	<div style='margin-left: 10px; margin-top: 10px;'>
<div style='float:left; width: 100px'>
		<strong>Четверг</strong><br />
		<?php if(in_array("1", $opros->pitanie_choice)) { ?>Питается<?php } ?><br />
</div>
<div style='float:left; width: 100px'>
		<strong>Пятница</strong><br />
		<?php if(in_array("2", $opros->pitanie_choice)) { ?>Питается<?php } ?><br />
</div>
<div style='float:left; width: 100px'>
		<strong>Суббота</strong><br />
		<?php if(in_array("5", $opros->pitanie_choice)) { ?>Питается<?php } ?><br />
</div>
<div style='float:left; width: 100px'>
		<strong>Воскресенье</strong><br />
		<?php if(in_array("8", $opros->pitanie_choice)) { ?>Питается<?php } ?><br />
</div>
	</div> 
<?php } ?>
<Br style="clear:both;"/>
<a id='edit_pitanie_choice' href='#'>Изменить</a>
</fieldset>
</div>
<?php
	}

}

	}
}  else {
$res = 2;
}
?>
<?php if (1) { ?>
<div class='form' id="form_choice" style="display: <?php echo ($res == 2)?"block":"none" ?>;">
<form action=pitanie_opros_save.php<?php echo"?id=$id";?> id=opros_form method=post >
   <fieldset><legend>Питание:</legend>
   <input type="radio" name='pitanie' id='pitanie_1' value='1' <?php if(($res == 2) ||  ($opros->pitanie == "1")) { ?>checked<?php } ?>/><label for="pitanie_1" checked>Не питается в столовой!</label><br/>
<!--<input type="radio" name='pitanie' id='pitanie_3' value='3' <?php if(($res == 3) ||  ($opros->pitanie == "3")) { ?>checked<?php } ?>/><label for="pitanie_3" checked>Буду питаться по предоплате</label><br/>-->
   <input type="radio" name='pitanie' id='pitanie_2' value='2' <?php if($opros->pitanie == "2") { ?>checked<?php } ?>/><label for="pitanie_2">Питается в столовой!</label><br/>
	<div id='pitanie_choice' style='margin-left: 10px; margin-top: 10px;display: none;'>
<div style='float:left; width: 100px'>
		<strong>Четверг</strong><br />
		<input type='checkbox' name='pitanie_choice[]' value='1' id='pitanie_choice_1' <?php if(($res == 2) || in_array("1", $opros->pitanie_choice)) { ?>checked<?php } ?>/><label for='pitanie_choice_1'>Питается</label><br />
</div>
<div style='float:left; width: 100px'>
		<strong>Пятница</strong><br />
		<input type='checkbox' name='pitanie_choice[]' value='2' id='pitanie_choice_2' <?php if(($res == 2) || in_array("2", $opros->pitanie_choice)) { ?>checked<?php } ?>/><label for='pitanie_choice_2'>Питается</label><br />
</div>
<div style='float:left; width: 100px'>
		<strong>Суббота</strong><br />
		<input type='checkbox' name='pitanie_choice[]' value='5' id='pitanie_choice_5' <?php if(($res == 2) || in_array("5", $opros->pitanie_choice)) { ?>checked<?php } ?>/><label for='pitanie_choice_5'>Питается</label><br />

</div>
<div style='float:left; width: 100px'>
		<strong>Воскресенье</strong><br />
		<input type='checkbox' name='pitanie_choice[]' value='8' id='pitanie_choice_8' <?php if(($res == 2) || in_array("8", $opros->pitanie_choice)) { ?>checked<?php } ?>/><label for='pitanie_choice_8'>Питается</label><br />
</div>
	</div> 
</fieldset>

<script>
var check_pitanie = function () {
var b = $('#pitanie_2').attr('checked' );

	if (b) {
		$('#pitanie_choice').slideDown();
	} else {
		$('#pitanie_choice').hide();
}
};
$('#pitanie_2, #pitanie_1').click(function () {
check_pitanie();
});
check_pitanie();

$('#opros_form').submit(function () {

});

$('#edit_pitanie_choice').click(function () {
	$('#choice_view').hide();
	$('#form_choice').slideDown();
});
</script>
<input type=submit value="<?php if ($res == "2") { echo "Продолжить";} else {echo "Сохранить";} ?> "/> 
</form>
</div>
<?php
}

return $res;
}
//////////////////////////////////////////////////////////
// опрос по питанию конец
//////////////////////////////////////////////////////////


	
?>