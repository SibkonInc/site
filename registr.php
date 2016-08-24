<?php

/**
 * @author нукшсл
 * @copyright 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";

//проверяем пользователя зареген он или нет
//проверяем что именно идет в данный момент
//проверям что именно у человека - его состояние на данный момент
//если не зареген - регистрируем
//если не подтвержден - проверяем регистрацию
//если не зареген - отправляем на регистрацию
//если зареген - подтверждаем
function reg() {
    global $id_user, $site, $name_site, $god_site;
    echo "<h3 align = \"center\">Регистрация</h3>";
    $ok_page = mysql_query("select * from sibkon where god = $god_site");
    while ($t_page = mysql_fetch_array($ok_page)) {
        $id_con = $t_page['id'];
        $god = $t_page['god'];
        $tema = $t_page['tema'];
        $text = nl2br($t_page['text']);
        $date_in = $t_page['date_in'];
        $date_out = $t_page['date_out'];
        $date_in1 = date("d", strtotime($date_in));
        $date_out1 = date("d", strtotime($date_out));
        $date_in_m = date("m", strtotime($date_in));
        $date_out1_m = date("m", strtotime($date_out));
        $date_out2 = format_date_mes($date_out);
        $date_out23 = format_date_mes($date_in);
        $date_god = date("Y", strtotime($date_out));
        $ob = $t_page['ob'];
        $den = $t_page['den'];
        $noc = $t_page['noc'];
        $lux = $t_page['lux'];
        $krov = $t_page['krov'];
        $spal = $t_page['spal'];
        $orgvzos = $t_page['orgvzos'];
        $st_lux = $t_page['st_lux'];
        $st_spa = $t_page['st_spa'];
        $st_kro = $t_page['st_kro'];
        $data_reg = $t_page['data_reg'];
        $data_pod = $t_page['data_pod'];
        $data_pos = $t_page['data_pos'];
        $reg_text = $t_page['reg_text'];
        $pod_text = $t_page['pod_text'];
    }
    echo "<h4 align = \"center\">$name_site $god_site: ";
    if ($date_in_m == $date_out1_m) {
        $data = "$date_in1-$date_out1 $date_out2 $date_god";
    } else {
        $data = "$date_in1 $date_out23 - $date_out1 $date_out2 $date_out3";
    }
    echo "$tema</h4>";
    echo "<div align = \"center\">$data</div><p>$reg_text</p>";
    echo "<div align=\"center\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"$site/registr.php?id=1\">Зарегистрироваться на $name_site</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div>";
}

function pod() {
    global $id_user, $site, $name_site, $god_site;
    echo "<h3 align = \"center\">Подтверждение</h3>";
    global $id_user, $site, $name_site, $god_site;
    $ok_page = mysql_query("select * from sibkon where god = $god_site");
    while ($t_page = mysql_fetch_array($ok_page)) {
        $id_con = $t_page['id'];
        $god = $t_page['god'];
        $tema = $t_page['tema'];
        $text = nl2br($t_page['text']);
        $date_in = $t_page['date_in'];
        $date_out = $t_page['date_out'];
        $date_in1 = date("d", strtotime($date_in));
        $date_out1 = date("d", strtotime($date_out));
        $date_in_m = date("m", strtotime($date_in));
        $date_out1_m = date("m", strtotime($date_out));
        $date_out2 = format_date_mes($date_out);
        $date_out23 = format_date_mes($date_in);
        $date_god = date("Y", strtotime($date_out));
        $ob = $t_page['ob'];
        $den = $t_page['den'];
        $noc = $t_page['noc'];
        $lux = $t_page['lux'];
        $krov = $t_page['krov'];
        $spal = $t_page['spal'];
        $orgvzos = $t_page['orgvzos'];
        $st_lux = $t_page['st_lux'];
        $st_spa = $t_page['st_spa'];
        $st_kro = $t_page['st_kro'];
        $data_reg = $t_page['data_reg'];
        $data_pod = $t_page['data_pod'];
        $data_pos = $t_page['data_pos'];
        $reg_text = $t_page['reg_text'];
        $pod_text = $t_page['pod_text'];
    }
    echo "<h4 align = \"center\">$name_site $god_site: ";
    if ($date_in_m == $date_out1_m) {
        $data = "$date_in1-$date_out1 $date_out2 $date_god";
    } else {
        $data = "$date_in1 $date_out23 - $date_out1 $date_out2 $date_out3";
    }
    echo "$tema</h4>";
    echo "<div align = \"center\">$data</div><p>$pod_text</p>";
    echo "<div align=\"center\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"$site/registr.php?id=2\">Подтвердиться на $name_site</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div>";
}

function status_reg() {
    global $id_user, $site, $name_site, $god_site;
    $ok_page = mysql_query("select * from sibkon where god = $god_site");
    while ($t_page = mysql_fetch_array($ok_page)) {
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
        $ob = $t_page['ob'];
        $den = $t_page['den'];
        $noc = $t_page['noc'];
        $lux = $t_page['lux'];
        $krov = $t_page['krov'];
        $spal = $t_page['spal'];
        $orgvzos = $t_page['orgvzos'];
        $st_lux = $t_page['st_lux'];
        $st_spa = $t_page['st_spa'];
        $st_kro = $t_page['st_kro'];
        $data_reg = $t_page['data_reg'];
        $data_pod = $t_page['data_pod'];
        $data_pos = $t_page['data_pos'];
        $reg_text = $t_page['reg_text'];
        $pod_text = $t_page['pod_text'];
    }
    echo "<h4 align = \"center\">Статус регистрации $name_site $god_site</h4> ";
    echo "<table><thead><th></th><th>Пользователь</th><th>Статус</th><th>Участие</th></thead>";
    $status = status();
    $query = "select * From `us` where `id_us` = $id_user ";
    $result = mysql_query($query);
    while ($link = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $tip_us = "$link[tip_us]";
        $nick_us = "$link[nick_us]";
        $gorod = "$link[gorod_us]";
        $name = "$link[name_us]";
        $fam = "$link[fam_us]";
        if ($tip_us == "9") {
            $nick_us = "<strike>$nick_us</strike>";
        }
        $info = "<a href = \"$site/profile.php?id=$id_us\">$nick_us</a>";
        $adm = dostup_adm();
        if ($adm == 1) {
            $info = "$info <a href = \"$site/log_per.php?id=$id_us\">П</a>";
        }
    }
    $pict = "user/photo/$id_user.jpg";
    if (file_exists($pict)) {
        list($width, $height, $type, $attr) = getimagesize($pict);
        if ($height > $width) {
            $vis1 = height;
        } else {
            $vis1 = width;
        }
    } else {
        $pict = "img/no.jpg";
    }
    echo "<tr><td width = \"60\"><img src= \"$site/$pict\" $vis1=\"60\" border=\"0\" alt=\"Инфо\" align=\"left\" ></td><td>$info<br><font color=\"#676666\">$name $fam<br>$gorod</font></td>";
    if ($status == "1") {
        echo "<td> <h4>Зарегистрирован</h4> <a href = \"$site/registr_off.php\">Отказаться от регистрации</a></td>";
    } else
    if ($status == "2") {
        echo "<td> <h4>Подтвержден</h4> [<a href = \"$site/registr_off.php\">Отказаться</a>]</td>";
    }

    //учет участия в мероприятиях и вообще
    echo "<td>";

    $sibkon = mysql_query("select * from sibkon where god = $god_site");
    while ($sib = mysql_fetch_array($sibkon)) {
        $id_con = $sib['id'];
    }
    $mer_s = mysql_query("select * from meropriatia where id_con = $id_con");
    while ($mer_s_m = mysql_fetch_array($mer_s)) {
        $id_mer = $mer_s_m['id'];
        $ok_page = mysql_query("select * from mer_us where id_command = $id_mer and id_us = $id_user");
        while ($t_page = mysql_fetch_array($ok_page)) {
            $id_us_m = $t_page['id_us'];
            $tip_us_m = $t_page['tip'];
            if ($tip_us_m == "1") {
                $tip_us_m = "Главный";
            } else if ($tip_us_m == "2") {
                $tip_us_m = "Организатор";
            } else if ($tip_us_m == "3") {
                $tip_us_m = "Участник";
            }
            if (!($id_us_m == "")) {
                $merop = name_mer($id_mer);
                echo "<li>$merop ($tip_us_m)</li> ";
            }
        }
    }
    echo "</td></tr>";
    //подопечные
    $queryp = "select * From `us` where `master` = $id_user ";
    $resultp = mysql_query($queryp);
    while ($linkp = mysql_fetch_array($resultp, MYSQL_ASSOC)) {
        $id_usp = "$linkp[id_us]";
        $tip_usp = "$linkp[tip_us]";
        $nick_usp = "$linkp[nick_us]";
        $gorodp = "$linkp[telefon_us]";
        $namep = "$linkp[name_us]";
        $famp = "$linkp[fam_us]";
        if ($tip_usp == "9") {
            $nick_us = "<strike>$nick_usp</strike>";
        }
        $infop = "<a href = \"$site/profile.php?id=$id_usp\">$nick_usp</a>";
        $adm = dostup_adm();
        if ($adm == 1) {
            $info = "$info <a href = \"$site/log_per.php?id=$id_usp\">П</a>";
        }
        $pictp = "user/photo/$id_usp.jpg";
        if (file_exists($pictp)) {
            list($width, $height, $type, $attr) = getimagesize($pictp);
            if ($height > $width) {
                $vis1 = height;
            } else {
                $vis1 = width;
            }
        } else {
            $pictp = "img/no.jpg";
        }
        echo "<tr><td width = \"60\"><img src= \"$site/$pictp\" $vis1=\"60\" border=\"0\" alt=\"Инфо\" align=\"left\" ></td><td>$infop (<font color=\"#676666\">$namep $famp</font>)<br>$gorodp<br><a href = \"$site/profile/del_podop.php?id=731\">удалить из подопечных</a></td>";
        $statusp = statusp($id_usp);
        if ($statusp == "1") {
            $regpodpos = regpodpos();
            if ($regpodpos == "1") {
                echo "<td> <h4>Зарегистрирован</h4> [<a href = \"$site/registr_off.php?id_us=$id_usp\">Отказаться</a>]</td>";
            } else
            if ($regpodpos == "2") {
                 echo "<td> <h4>Зарегистрирован</h4> [<a href = \"$site/registr.php?id_us=$id_usp&id=2\">Подтвердить</a>] [<a href = \"$site/registr_off.php?id_us=$id_usp\">Отказаться</a>]</td>";
            } else
            if ($regpodpos == "3") {
                    echo "<td> <h4>Зарегистрирован</h4> [<a href = \"$site/registr.php?id_us=$id_usp&id=2\">Подтвердить</a>] [<a href = \"$site/registr_off.php?id_us=$id_usp\">Отказаться</a>]</td>";
            }
        } else
        if ($statusp == "2") {
            echo "<td> <h4>Подтвержден</h4> [<a href = \"$site/registr_off.php?id_us=$id_usp\">Отказаться</a>]</td>";
        } else {

            echo "<td><a href = \"$site/registr.php?id_us=$id_usp&id=1\">Зарегистрировать</a></td>";
        }
        //учет участия в мероприятиях и вообще
        echo "<td>";

        $sibkonp = mysql_query("select * from sibkon where god = $god_site");
        while ($sibp = mysql_fetch_array($sibkonp)) {
            $id_conp = $sibp['id'];
        }
        $mer_sp = mysql_query("select * from meropriatia where id_con = $id_conp");
        while ($mer_s_mp = mysql_fetch_array($mer_sp)) {
            $id_merp = $mer_s_mp['id'];
            $ok_pagep = mysql_query("select * from mer_us where id_command = $id_mer and id_us = $id_usp");
            while ($t_pagep = mysql_fetch_array($ok_pagep)) {
                $id_us_mp = $t_pagep['id_us'];
                $tip_us_mp = $t_pagep['tip'];
                if ($tip_us_mp == "1") {
                    $tip_us_mp = "Главный";
                } else if ($tip_us_mp == "2") {
                    $tip_us_mp = "Организатор";
                } else if ($tip_us_mp == "3") {
                    $tip_us_mp = "Участник";
                }
                if (!($id_us_mp == "")) {
                    $meropp = name_mer($id_merp);
                    echo "<li>$meropp ($tip_us_mp)</li> ";
                }
            }
        }
        echo "</td></tr>";
    }
    echo "</table>";
}

function action() {
    global $id_user, $site, $name_site, $god_site;
    if ($id_user == "") {
        error(6);
    } else {
        if (isset($_GET['id'])) {
            $id = addslashes($_GET['id']);
        } else {
            $id = 0;
        }
        if (!is_numeric($id)) {
            die("Такой записи нет!");
        }
        $id = intval($id);
        if (isset($_GET['id_us'])) {
            $id_us = addslashes($_GET['id_us']);
        } else {
            $id_us = $id_user;
        }
        if (!is_numeric($id_us)) {
            die("Такой записи нет!");
        }
        $id_us = intval($id_us);
        $regpodpos = regpodpos();
        $status = statusp($id_us);
        if ($regpodpos == "1") {
            if ($status == "0") {
                if ($id == "1") {
                    mysql_query("insert into `registr`(god,id_us,reg) values('$god_site', '$id_us','1')");
                    $nit = mysql_insert_id();
                    if ($id_us == $id_user) {
                        $mess_log = "Зарегистрировался на $name_site $god_site";
                    } else {
                        $test_podop = test_podop($id_us);
                        if ($test_podop == "0") {
                            status_reg();
                        } else {
                            $nit = mysql_insert_id();
                            $user = user_info($id_us);
                            $mess_log = "Зарегистрировал подопечного $user на $name_site $god_site";
                            ad_log($mess_log);
                            status_reg();
                        }
                    }
                    ad_log($mess_log);
                    status_reg();
                } else {
                    reg();
                }
            } else {
                status_reg();
            }
        } else
        if ($regpodpos == "2") {
            if ($status == "0") {
                if ($id == "1") {
                    mysql_query("insert into `registr`(god,id_us,reg) values('$god_site', '$id_us','1')");
                    $nit = mysql_insert_id();
                    if ($id_us == $id_user) {
                        $mess_log = "Зарегистрировался на $name_site $god_site";
                    } else {
                        $test_podop = test_podop($id_us);
                        if ($test_podop == "0") {
                            status_reg();
                        } else {
                            $nit = mysql_insert_id();
                            $user = user_info($id_us);
                            $mess_log = "Зарегистрировал подопечного $user на $name_site $god_site";
                            ad_log($mess_log);
                            status_reg();
                        }
                    }
                    ad_log($mess_log);
                    status_reg();
                } else {
                    reg();
                }
            } else
            if ($status == "1") {
                if ($id == "2") {
                    mysql_query(" UPDATE registr SET reg=2 where god = '$god_site' and id_us = $id_us");
                    $nit = mysql_insert_id();


                    $test_podop = test_podop($id_us);
                    if ($test_podop == "0") {
                        status_reg();
                        $mess_log = "Подтвердился на $name_site $god_site";
                        ad_log($mess_log);
                    } else {
                        $nit = mysql_insert_id();
                        $user = user_info($id_us);
                        $mess_log = "Подтвердил подопечного $user на $name_site $god_site";
                        ad_log($mess_log);
                        status_reg();
                    }
                } else {
                    pod();
                }
            } else {
                status_reg();
            }
        } else
        if ($regpodpos == "3") {
            if ($status == "0") {
                if ($id == "1") {
                    mysql_query("insert into `registr`(god,id_us,reg) values('$god_site', '$id_us','1')");
                    $nit = mysql_insert_id();
                    if ($id_us == $id_user) {
                        $mess_log = "Зарегистрировался на $name_site $god_site";
                    } else {
                        $test_podop = test_podop($id_us);
                        if ($test_podop == "0") {
                            status_reg();
                        } else {
                            $nit = mysql_insert_id();
                            $user = user_info($id_us);
                            $mess_log = "Зарегистрировал подопечного $user на $name_site $god_site";
                            ad_log($mess_log);
                            status_reg();
                        }
                    }
                    ad_log($mess_log);
                    status_reg();
                } else {
                    reg();
                }
            } else
            if ($status == "1") {
                if ($id == "2") {
                    mysql_query(" UPDATE registr SET reg=2 where god = '$god_site' and id_us = $id_us");
                    $nit = mysql_insert_id();


                    $test_podop = test_podop($id_us);
                    if ($test_podop == "0") {
                        status_reg();
                        $mess_log = "Подтвердился на $name_site $god_site";
                        ad_log($mess_log);
                    } else {
                        $nit = mysql_insert_id();
                        $user = user_info($id_us);
                        $mess_log = "Подтвердил подопечного $user на $name_site $god_site";
                        ad_log($mess_log);
                        status_reg();
                    }
                } else {
                    pod();
                }
            } else {
                status_reg();
            }
        } else {
            error(17);
        }
    }
}

function title() {
    global $name_site, $site, $god_site;
    echo "
<title>Регистрация на $name_site $god_site | $name_site</title>
";
}

function right() {

}

require ("theme/$theme/$theme 2.htm");
?>