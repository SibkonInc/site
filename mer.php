<?php
/**
 * @author Yerick
 * @copyright 2009
 * @name YCMS 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";

function my_mer() {
    global $site, $status_site, $name_group, $god_site, $id_user, $name_site;
    if ($status_site == "2") {
        echo "<h3 align = \"center\">Мое участие на $name_site $god_site</h3>";
        echo "<table><thead><th>Название</th><th>Тип</th><th>Статус</th><th>Куратор</th><th>Участников</th></thead>";
        $ok_page = mysql_query("select * from sibkon where god = $god_site");
        while ($t_page = mysql_fetch_array($ok_page)) {
            $id_con = $t_page['id'];
        }
        $ok_page_u = mysql_query("select * from mer_us where id_us = $id_user");
        while ($t_page_u = mysql_fetch_array($ok_page_u)) {
            $id_us_u = $t_page_u['id_us'];
            $tip_u = $t_page_u['tip'];
            if ($tip_u == "1") {
                $tip_u = "Главный организатор";
            } else
            if ($tip_u == "2") {
                $tip_u = "Организатор";
            } else
            if ($tip_u == "3") {
                $tip_u = "Участник";
            }
            $id_command = $t_page_u['id_command'];
            $ok_page_m = mysql_query("select * from meropriatia where id = $id_command and id_con = $id_con");
            while ($t_page_m = mysql_fetch_array($ok_page_m)) {
                $id_m = $t_page_m['id'];
                $id_con_m = $t_page_m['id_con'];
                $tip_con_m = $t_page_m['tip'];
                $name_mer = name_mer($id_m);
                $tip_con_m = name_tip($tip_con_m);
                $ok_page_u2 = mysql_query("select * from mer_us where id_command = $id_m and tip = 1");
                while ($t_page_u2 = mysql_fetch_array($ok_page_u2)) {
                    $id_us_org = $t_page_u2['id_us'];
                }
                $kurator = user_info($id_us_org);
                $ok_reg = mysql_query("select * from mer_us where id_command = $id_m");
                $itog_reg1 = mysql_num_rows($ok_reg);
            
                 echo "<tr><td>$name_mer</td><td>$tip_con_m</td><td>$tip_u</td><td>$kurator</td><td>$itog_reg1</td></tr>";
            }

        }
        echo "</table>";
    }
}

function news_mer($id) {
    global $site, $status_site, $name_group, $god_site, $id_user, $name_site;
    $dostup = dostup_mer($id);
    if ($dostup == "1") {
        $ok_page = mysql_query("select * from news where tip = 2 and id_id = $id order by id_news desc");
        echo "<table>"; {
            while ($t_page = mysql_fetch_array($ok_page)) {
                $id = $t_page['id_news'];
                $name = $t_page['small_news'];
                $date = $t_page['date_news'];
                $tip = $t_page['tip'];
                $id_id = $t_page['id_id'];
                $date = date("d.m.y", strtotime($date));
                echo "<tr><td>$date</td><td><a href = news.php?id=$id>$name</a></td></tr>";
            }
        }
        echo "</table>";
    } else {
        error(7);
    }
}

function mat_mer($id) {
    global $site, $status_site, $name_group, $god_site, $id_user, $name_site;
    $dostup = dostup_mer($id);
    if ($dostup == "1") {
        echo "<table>";
        $ok_news = mysql_query("select * from page_sibkon where tip = 2 and id_id = $id ");
        while ($t_news = mysql_fetch_array($ok_news)) {
            $id_p = $t_news['id'];
            $name_p = $t_news['name'];
            $dostup_p = $t_news['dostup'];
            if ($dostup_p == "1") {
                $pict_p = "<img src=\"$site/img/ico/lockoverlay.png\" border=\"0\" alt=\"Закрыто\">";
            } else {
                $pict_p = "";
            }
            echo "
            <tr><td>$pict_p</td><td><a href = \"$site/page_sibkon.php?id=$id_p\">$name_p</a></td></tr>";
        }
        echo "</table>";
    } else {
        error(7);
    }
}

//function forum_mer($id) {
//    global $site, $status_site, $name_group, $god_site, $id_user, $name_site;
//    $dostup = dostup_mer($id);
//    if ($dostup == "1") {
//        echo "<table>";
//        $ok_page = mysql_query("select * from forum where org = 2 and pr_zap = $id order by date desc ");
//        while ($t_page = mysql_fetch_array($ok_page)) {
//            $id_f = $t_page['id'];
//            $name = $t_page['name'];
//            $t = $t_page['org'];
//            $dostup = $t_page['dostup'];
//            if ($dostup == "1") {
//                $pict = "<img src=\"$site/img/ico/lockoverlay.png\" border=\"0\" alt=\"Закрыто\">";
//            } else {
//                $pict = "";
//            }
//            $com_count = $t_page['com_count'];
//            $id_us = $t_page['id_us'];
//            $avtor = user_info($id_us);
//            $date = $t_page['date'];
//            $date = date("d.m.y", strtotime($date));
//            $count = count_com($id_f);
//            $id_count_com = id_count_com($id_f);
//            if ($count == "") {
//                $count = "$com_count";
//            } else {
//                $count = $com_count - $count;
//                if ($count > "0") {
//                    $count = "$com_count <font color = \"#FA0808\">+$count</font>";
//                } else {
//                    $count = "$com_count";
//                }
//            }
//            echo "<tr><td>$pict</td><td>$date</td><td>$avtor</td><td><a href = \"$site/forum.php?id=$id_f\">$name</a></td><td>$count </td><td align = right><a href = \"$site/forum.php?id=$id_f$id_count_com\"><img src=\"img/message_reply.png\"  alt=\"К последнему сообщению\" border=\"0\"></a></td></tr>";
//        }
//        echo "</table>";
//    } else {
//        error(7);
//    }
//}

function files_mer($id) {
    global $site, $status_site, $name_group, $god_site, $id_user, $name_site;
    $dostup = dostup_mer($id);
    $adm = dostup_adm();
    if ($dostup == "1" or $adm == "1") {
        echo "<h3 align = \"center\">Прикрепленные файлы</h3>";
        echo "<table>";
        $ok_page = mysql_query("select * from files where id_id = $id and tip = 2");
        while ($t_page = mysql_fetch_array($ok_page)) {
            $id_m = $t_page['id'];
            $name = $t_page['name'];
            $file = $t_page['file'];
            $us = $t_page['us'];
            $user = user_info($us);
            echo "<tr><td><a href = \"$site/files/mat/$id/$file\">$name</td><td>$user</td></tr>";
        }
        echo "</table>";
        $ad = dostup_mer_user($id);
        if ($ad == "1" or $adm == "1") {
            echo "<h4 align = \"center\">Прикрепить файлы</h4>
         <FORM name=\"form\" enctype=\"multipart/form-data\" action=\"upload1.php?id=$id&tip=2\" method=post>
    <TABLE cellspacing=1 cellpadding=0 border=0 align=center>
      <TR>
        <TD align=right>Название:</TD>
        <TD>
          <INPUT type=text size=40 name=\"name\" value=\"new\">
        </TD>
      </TR>
      <TR>
        <TD align=right>Файл:</TD>
        <TD>
        <INPUT size=40 type=\"file\" name=\"matfile\">
        </TD>
      </TR>
      <TR>
        <TD colspan=2 align=center><INPUT type=submit class=\"submit\" value=\"ok\"></TD>
      </TR>
    </TABLE>
  </FORM>";
        }
    } else {
        error(7);
    }
}

function user_mer() {
    global $site, $status_site, $name_group, $god_site, $id_user, $name_site;
    if (isset($_GET['tip'])) {
        $tip = addslashes($_GET['tip']);
    } else {
        $tip = 0;
    }
    if (!is_numeric($tip)) {
        die("Такой записи нет!");
    }
    $tip = intval($tip);
    if (isset($_GET['id'])) {
        $id = addslashes($_GET['id']);
    } else {
        $id = 0;
    }
    if (!is_numeric($id)) {
        die("Такой записи нет!");
    }
    $id = intval($id);
    if ($id == 0) {
        my_mer();
    } else {
        if ($tip == "6") {
            $ok_page = mysql_query("select * from meropriatia where id = $id");
            while ($t_page = mysql_fetch_array($ok_page)) {
                $id = $t_page['id'];
                $name = $t_page['name'];
                $text = nl2br($t_page['text']);
                $id_con = $t_page['id_con'];
                $tip = $t_page['tip'];
                $tip = name_tip($tip);
                $podtip = $t_page['podtip'];
                $podtip = name_podtip($podtip);
                $name_mer = name_mer($id);
                $forum = $t_page['forum'];
                $forum_all = $t_page['forum_all'];
                $anketa = $t_page['anketa'];
                $komand = $t_page['komand'];
            }
            $ok_sibkon = mysql_query("SELECT * FROM `sibkon` WHERE `id` = $id_con");
            while ($t_sibkon = mysql_fetch_array($ok_sibkon)) {
                $id_sibkon = $t_sibkon['id_con'];
                $god = $t_sibkon['god'];
                $tema = $t_sibkon['tema'];
            }
            echo "<h3 align = center>Руководство</h3>";
            echo "<table>";

            $ok_page = mysql_query("select * from mer_us where id_command = $id and tip < 3 "); {
                while ($t_page = mysql_fetch_array($ok_page)) {
                    $id_us_z = $t_page['id_us'];
                    $tip_z = $t_page['tip'];
                    $id_zap_us = $t_page['id'];
                    $user_z = user_info($id_us_z);
                    $query = "select * From `us` where `id_us` = $id_us_z";
                    $result = mysql_query($query);
                    while ($link = mysql_fetch_array($result, MYSQL_ASSOC)) {
                        $tip_us = "$link[tip_us]";
                        $nick_us = "$link[nick_us]";
                        $gorod = "$link[gorod_us]";
                        $name = "$link[name_us]";
                        $fam = "$link[fam_us]";
                    }
                    if ($tip_z == "1") {
                        $pict = "<img src=\"$site/img/ico/admin_icon.png\" border=\"0\" alt=\"Основатель\">";
                    } else
                    if ($tip_z == "2") {
                        $pict = "<img src=\"$site/img/ico/kwifimanager.png\" border=\"0\" alt=\"Командование\">";
                    } else
                    if ($tip_z == "3") {
                        $pict = "<img src=\"$site/img/ico/kuser.png\" border=\"0\" alt=\"Участники\">";
                    } else {
                        $pict = "";
                    }
                    echo "<tr><td>$pict</td><td>$user_z</td><td>$fam $name</td><td>$gorod</td>";

                    $admq = dostup_adm();
                    $orgq = dostup_org();
                    $masterq = dostup_mer_adm($id);
                    //а теперь начинаем ебстись!
                    if ($admq == "1" or $orgq == "1" or $masterq == "1" or $id_us_z == $id_user) {
                        echo "<td><a href=\"$site/mer/edit_user_zai.php?id=$id_zap_us\"><img src=\"$site/img/ico/file_edit.png\" border=\"0\" alt=\"Редактировать\"></a>  <a href=\"$site/mer/del_user.php?id=$id_zap_us\" rel = \"facebox\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"Удалить\"></a></td>";
                    }
                    echo "</tr>";
                }
            }
            echo "</table>";
            echo "<h3 align = center>Участники</h3>";
            $i = "1";
            if ($komand == "0") {
                echo "<table>";
                $ok_page = mysql_query("select * from mer_us where id_command = $id and tip > 2 order by id"); {
                    while ($t_page = mysql_fetch_array($ok_page)) {
                        $id_us_z = $t_page['id_us'];
                        $tip_z = $t_page['tip'];
                        $id_zap_us = $t_page['id'];
                        $user_z = user_info($id_us_z);
                        $query = "select * From `us` where `id_us` = $id_us_z ";
                        $result = mysql_query($query);
                        while ($link = mysql_fetch_array($result, MYSQL_ASSOC)) {
                            $tip_us = "$link[tip_us]";
                            $nick_us = "$link[nick_us]";
                            $gorod = "$link[gorod_us]";
                            $name = "$link[name_us]";
                            $fam = "$link[fam_us]";
                        }
                        if ($tip_z == "1") {
                            $pict = "<img src=\"$site/img/ico/admin_icon.png\" border=\"0\" alt=\"Основатель\">";
                        } else
                        if ($tip_z == "2") {
                            $pict = "<img src=\"$site/img/ico/kwifimanager.png\" border=\"0\" alt=\"Командование\">";
                        } else
                        if ($tip_z == "3") {
                            $pict = "<img src=\"$site/img/ico/kuser.png\" border=\"0\" alt=\"Участники\">";
                        } else {
                            $pict = "";
                        }
                        echo "<tr><td>$i </td><td>$pict</td><td>$user_z</td><td>$fam $name</td><td>$gorod</td>";
                        $i++;
                        $admq = dostup_adm();
                        $orgq = dostup_org();
                        $masterq = dostup_mer_adm($id);
                        //а теперь начинаем ебстись!
                        if ($admq == "1" or $orgq == "1" or $masterq == "1" or $id_us_z == $id_user) {
                            echo "<td><a href=\"$site/mer/edit_user_zai.php?id=$id_zap_us\"><img src=\"$site/img/ico/file_edit.png\" border=\"0\" alt=\"Редактировать\"></a>  <a href=\"$site/mer/del_user.php?id=$id_zap_us\" rel = \"facebox\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"Удалить\"></a></td>";
                        }
                        echo "</tr>";
                    }
                }
                echo "</table>";
                echo "<h5 align = \"center\">Приглашены</h5>";
                echo "<table>";
                $ok_prig = mysql_query("select * from query where id_tip = 2 and id_mer = $id  and ok = 5");
                while ($t_prig = mysql_fetch_array($ok_prig)) {
                    $id_prig = $t_prig['id_master'];
                    $id_pr = $t_prig['id'];
                    $user_prig = user_info($id_prig);
                    $queryp = "select * From `us` where `id_us` = $id_prig";
                    $resultp = mysql_query($queryp);
                    while ($linkp = mysql_fetch_array($resultp, MYSQL_ASSOC)) {
                        $tip_usp = "$linkp[tip_us]";
                        $nick_usp = "$linkp[nick_us]";
                        $gorodp = "$linkp[gorod_us]";
                        $namep = "$linkp[name_us]";
                        $famp = "$linkp[fam_us]";
                    }
                    echo "<tr><td>$user_prig</td><td>$famp $namep</td><td>$gorodp</td>";
                    $adm = dostup_adm();
                    $org = dostup_org();
                    $master = dostup_mer_adm($id);
                    if ($adm == "1" or $org == "1" or $master == "1" or $id_prig == $id_user) {
                        echo "<td><a href=\"$site/mer/edit_user_zai.php?id=$id_pr&t=2\"><img src=\"$site/img/ico/file_edit.png\" border=\"0\" alt=\"Редактировать\"></a>  <a href=\"$site/query/ok.php?ok=2&id=$id_pr\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"Удалить\"></a></td>";
                    }
                }
                echo "</tr>";
                echo "</table>";
                echo "<h5 align = \"center\">Подали заявки</h5>";
                echo "<table>";
                $ok_prig = mysql_query("select * from query where id_tip = 2 and id_mer = $id  and ok = 0");
                while ($t_prig = mysql_fetch_array($ok_prig)) {
                    $id_prig = $t_prig['id_us'];
                    $id_pr = $t_prig['id'];
                    $user_prig = user_info($id_prig);
                    $queryz = "select * From `us` where `id_us` = $id_prig";
                    $resultz = mysql_query($queryz);
                    while ($linkz = mysql_fetch_array($resultz, MYSQL_ASSOC)) {
                        $tip_usz = "$linkz[tip_us]";
                        $nick_usz = "$linkz[nick_us]";
                        $gorodz = "$linkz[gorod_us]";
                        $namez = "$linkz[name_us]";
                        $famz = "$linkz[fam_us]";
                    }
                    echo "<tr><td>$user_prig</td><td>$famz $namez</td><td>$gorodz</td>";
                    $adm = dostup_adm();
                    $org = dostup_org();
                    $master = dostup_mer_adm($id);
                    if ($adm == "1" or $org == "1" or $master == "1" or $id_prig == $id_user) {
                        echo "<td><a href=\"$site/mer/edit_user_zai.php?id=$id_pr&t=2\"><img src=\"$site/img/ico/file_edit.png\" border=\"0\" alt=\"Редактировать\"></a>  <a href=\"$site/query/ok.php?ok=2&id=$id_pr\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"Удалить\"></a></td>";
                    }
                }
                echo "</tr>";
                echo "</table>";
            }
            if ($komand == "1" or $komand == "2") {
                $ok_prig = mysql_query("select * from mer_command where id_mer = $id group by name");
                while ($t_prig = mysql_fetch_array($ok_prig)) {
                    $name_komand = $t_prig['name'];
                    if ($name_komand == "") {
                        echo "<h4 align = \"center\">Неоформленные</h4>";
                    } else {
                        echo "<h4>$name_komand</h4>";
                    }
                    echo "<table>";
                    $ok_prig1 = mysql_query("SELECT * FROM `mer_command` WHERE `id_mer` =$id AND `name` = '$name_komand'");
                    while ($t_prig1 = mysql_fetch_array($ok_prig1)) {
                        $us_komand = $t_prig1['id_us'];
                        $user_prig = user_info($us_komand);
                        $queryq = "select * From `us` where `id_us` = $us_komand";
                        $resultq = mysql_query($queryq);
                        while ($linkq = mysql_fetch_array($resultq, MYSQL_ASSOC)) {
                            $tip_usq = "$linkq[tip_us]";
                            $nick_usq = "$linkq[nick_us]";
                            $gorodq = "$linkq[gorod_us]";
                            $nameq = "$linkq[name_us]";
                            $famq = "$linkq[fam_us]";
                        }
                        $ok_prig12 = mysql_query("SELECT * FROM mer_us WHERE id_command =$id AND id_us = $us_komand and tip >2");
                        while ($t_prig12 = mysql_fetch_array($ok_prig12)) {
                            $mer_id = $t_prig12['id'];
                            $tip_us_m = $t_prig12['tip'];
                            $us_us_m = $t_prig12['id_us'];
                            echo "<tr><td>$user_prig</td><td>$famq $nameq</td><td>$gorodq</td>";
                            $adm = dostup_adm();
                            $org = dostup_org();
                            $master = dostup_mer_adm($id);
                            if ($adm == "1" or $org == "1" or $master == "1" or $us_komand == $id_user) {
                                echo "<td><a href=\"$site/mer/edit_user_zai.php?id=$mer_id\"><img src=\"$site/img/ico/file_edit.png\" border=\"0\" alt=\"Редактировать\"></a>  <a href=\"$site/mer/del_user.php?id=$mer_id\" rel = \"facebox\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"Удалить\"></a></td>";
                            }
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                echo "<h4>Вне команд</h4>";
                echo "<table>";
                $ok_page_u = mysql_query("select * from mer_us where id_command = $id and tip >1");
                while ($t_page_u = mysql_fetch_array($ok_page_u)) {
                    $id_us_u = $t_page_u['id_us'];
                    $ok_prig1 = mysql_query("SELECT * FROM `mer_command` WHERE `id_mer` =$id AND `id_us` = '$id_us_u'");
                    while ($t_prig1 = mysql_fetch_array($ok_prig1)) {
                        $id_us_b = $t_prig1['id_us'];
                    }
                    if (!($id_us_b == "$id_us_u")) {
                        $user_prig_b = user_info($id_us_u);
                        $queryq = "select * From `us` where `id_us` = $id_us_u";
                        $resultu = mysql_query($queryq);
                        while ($linku = mysql_fetch_array($resultu, MYSQL_ASSOC)) {
                            $tip_usu = "$linku[tip_us]";
                            $nick_usu = "$linku[nick_us]";
                            $gorodu = "$linku[gorod_us]";
                            $nameu = "$linku[name_us]";
                            $famu = "$linku[fam_us]";
                        }
                        $ok_prig12 = mysql_query("SELECT * FROM mer_us WHERE id_command =$id AND id_us = $id_us_u and tip >2");
                        while ($t_prig12 = mysql_fetch_array($ok_prig12)) {
                            $mer_id = $t_prig12['id'];
                            $tip_us_m = $t_prig12['tip'];
                            $us_us_m = $t_prig12['id_us'];
                            echo "<tr><td>$user_prig_b</td><td>$famu $nameu</td><td>$gorodu</td>";
                            $adm = dostup_adm();
                            $org = dostup_org();
                            $master = dostup_mer_adm($id);
                            if ($adm == "1" or $org == "1" or $master == "1" or $id_us_u == $id_user) {
                                echo "<td><a href=\"$site/mer/edit_user_zai.php?id=$mer_id\"><img src=\"$site/img/ico/file_edit.png\" border=\"0\" alt=\"Редактировать\"></a>  <a href=\"$site/mer/del_user.php?id=$mer_id\" rel = \"facebox\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"Удалить\"></a></td>";
                            }
                            echo "</tr>";
                        }
                    }
                }
                echo "</table>";
                echo "<p><h5 align = \"center\">Приглашены</h5>";
                echo "<table>";
                $ok_prig = mysql_query("select * from query where id_tip = 2 and id_mer = $id  and ok = 5");
                while ($t_prig = mysql_fetch_array($ok_prig)) {
                    $id_prig = $t_prig['id_master'];
                    $id_pr = $t_prig['id'];
                    $user_prig = user_info($id_prig);
                    $queryp = "select * From `us` where `id_us` = $id_prig";
                    $resultp = mysql_query($queryp);
                    while ($linkp = mysql_fetch_array($resultp, MYSQL_ASSOC)) {
                        $tip_usp = "$linkp[tip_us]";
                        $nick_usp = "$linkp[nick_us]";
                        $gorodp = "$linkp[gorod_us]";
                        $namep = "$linkp[name_us]";
                        $famp = "$linkp[fam_us]";
                    }
                    echo "<tr><td>$user_prig</td><td>$famp $namep</td><td>$gorodp</td>";
                    $adm = dostup_adm();
                    $org = dostup_org();
                    $master = dostup_mer_adm($id);
                    if ($adm == "1" or $org == "1" or $master == "1" or $id_prig == $id_user) {
                        echo "<td><a href=\"$site/mer/edit_user_zai.php?id=$id_pr&t=2\"><img src=\"$site/img/ico/file_edit.png\" border=\"0\" alt=\"Редактировать\"></a>  <a href=\"$site/query/ok.php?ok=2&id=$id_pr\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"Удалить\"></a></td>";
                    }
                }
                echo "</tr>";
                echo "</table>";
                echo "<h5 align = \"center\">Подали заявки</h5>";
                echo "<table>";
                $ok_prig = mysql_query("select * from query where id_tip = 2 and id_mer = $id  and ok = 0");
                while ($t_prig = mysql_fetch_array($ok_prig)) {
                    $id_prig = $t_prig['id_us'];
                    $id_pr = $t_prig['id'];
                    $user_prig = user_info($id_prig);
                    $queryz = "select * From `us` where `id_us` = $id_prig";
                    $resultz = mysql_query($queryz);
                    while ($linkz = mysql_fetch_array($resultz, MYSQL_ASSOC)) {
                        $tip_usz = "$linkz[tip_us]";
                        $nick_usz = "$linkz[nick_us]";
                        $gorodz = "$linkz[gorod_us]";
                        $namez = "$linkz[name_us]";
                        $famz = "$linkz[fam_us]";
                    }
                    echo "<tr><td>$user_prig</td><td>$famz $namez</td><td>$gorodz</td>";
                    $adm = dostup_adm();
                    $org = dostup_org();
                    $master = dostup_mer_adm($id);
                    if ($adm == "1" or $org == "1" or $master == "1" or $id_prig == $id_user) {
                        echo "<td><a href=\"$site/mer/edit_user_zai.php?id=$id_pr&t=2\"><img src=\"$site/img/ico/file_edit.png\" border=\"0\" alt=\"Редактировать\"></a>  <a href=\"$site/query/ok.php?ok=2&id=$id_pr\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"Удалить\"></a></td>";
                    }
                }
                echo "</tr>";
                echo "</table>";
            }
        }
    }
}

function comand_mer() {

}

function action() {
    global $site, $status_site, $name_group, $god_site, $id_user, $name_site;
    if (isset($_GET['tip'])) {
        $tip = addslashes($_GET['tip']);
    } else {
        $tip = 0;
    }
    if (!is_numeric($tip)) {
        die("Такой записи нет!");
    }
    $tip = intval($tip);
    if (isset($_GET['id'])) {
        $id = addslashes($_GET['id']);
    } else {
        $id = 0;
    }
    if (!is_numeric($id)) {
        die("Такой записи нет!");
    }
    $id = intval($id);
    if ($id == 0) {
        my_mer();
    } else {
        if ($tip == "0") {
            $ok_page = mysql_query("select * from meropriatia where id = $id");
            while ($t_page = mysql_fetch_array($ok_page)) {
                $id = $t_page['id'];
                $name = $t_page['name'];
                $text = nl2br($t_page['text']);
                $id_con = $t_page['id_con'];
                $tip = $t_page['tip'];
                $tip = name_tip($tip);
                $podtip = $t_page['podtip'];
                $podtip = name_podtip($podtip);
                $name_mer = name_mer($id);
                $forum = $t_page['forum'];
                $forum_all = $t_page['forum_all'];
            }
            $ok_sibkon = mysql_query("SELECT * FROM `sibkon` WHERE `id` = $id_con");
            while ($t_sibkon = mysql_fetch_array($ok_sibkon)) {
                $id_sibkon = $t_sibkon['id_con'];
                $god = $t_sibkon['god'];
                $tema = $t_sibkon['tema'];
            }
            echo "
<p>
	<a href = \"$site/sibkon.php?id=$god\">$name_site $god: $tema</a> | $name_mer | $tip
	";
            echo "
    <h2 align=\"center\">$name</h2>
    ";
            echo "$text";
            $adm = dostup_adm();
            $god_org = dostup_org_god($god);
            $upravlenie = dostup_mer_adm($id);
            if ($adm == 1 or $god_org == 1 or $upravlenie == 1) {
                echo "
<div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"$site/mer/edit.php?id=$id\">Редактировать</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div><p>";
            }
			
			// начало вывода форума


		//include('mer/comments/comments.php');

            if ($forum == "1") {
                echo "
<div class=\"pane\">
	<div class=\"pane_p\">
		<div class=\"nccp\">
		<div class=\"pl\" align=\"left\"><strong>Обсуждения</strong></div>
        <div class=\"pr\" align=\"right\">";
                echo "</div>
		<br></div>
		<div class=\"text_block\">";
                echo "<table>";
                $ok_page = mysql_query("select * from forum where org = 2 and pr_zap = $id order by date desc");
                while ($t_page = mysql_fetch_array($ok_page)) {
                    $id_f = $t_page['id'];
                    $name = $t_page['name'];
                    $t = $t_page['org'];
                    $dostup = $t_page['dostup'];
                    if ($dostup == "1") {
                        $pict = "<img src=\"$site/img/ico/lockoverlay.png\" border=\"0\" alt=\"Закрыто\">";
                    } else {
                        $pict = "";
                    }
                    $com_count = $t_page['com_count'];
                    $id_us = $t_page['id_us'];
                    $avtor = user_info($id_us);
                    $date = $t_page['date'];
                    $date = date("d.m.y", strtotime($date));
                    $count = count_com($id_f);
                    $id_count_com = id_count_com($id_f);
                    if ($count == "") {
                        $count = "$com_count";
                    } else {
                        $count = $com_count - $count;
                        if ($count > "0") {
                            $count = "$com_count <font color = \"#FA0808\">+$count</font>";
                        } else {
                            $count = "$com_count";
                        }
                    }
                    echo "<tr><td>$pict</td><td>$date</td><td>$avtor</td><td><a href = \"$site/forum.php?id=$id_f\">$name</a></td><td>$count </td><td align = right><a href = \"$site/forum.php?id=$id_f$id_count_com\"><img src=\"img/message_reply.png\"  alt=\"К последнему сообщению\" border=\"0\"></a></td></tr>";
                }
                echo "</table>";
                $dostup_mer_user = dostup_mer_user($id);
                if ($forum_all == "1") {
                    echo "<br><div align = \"right\"><a href = \"$site/mer/ad_forum.php?id=$id\">Добавить Обсуждение</a></div>";
                } else {
                    if ($dostup_mer_user == 1) {
                        echo "<br><div align = \"right\"><a href = \"$site/mer/ad_forum.php?id=$id\">Добавить Обсуждение</a></div>";
                    }
                }
                echo "</div>
	</div>
</div>";
            }
			// конец вывода форума.
            //блок для прошлогодних. получается что те, которые сделаны до 2010 года открыты для всех. начиная с 2010 будет отслеживание был человек в группе или нет.
            if (!($god == $god_site)) {
                echo "
<div class=\"pane\">
	<div class=\"pane_p\">
		<div class=\"nccp\">
		<div class=\"pl\" align=\"left\"><strong>Обсуждения</strong></div>
        <div class=\"pr\" align=\"right\">Все</div>
		<br></div>
		<div class=\"text_block\">";
                echo "<table>";
                $ok_page = mysql_query("select * from forum where org = 0 and pr_zap = $id order by date desc LIMIT 0,3");
                while ($t_page = mysql_fetch_array($ok_page)) {
                    $id_f = $t_page['id'];
                    $name = $t_page['name'];
                    $t = $t_page['org'];
                    $com_count = $t_page['com_count'];
                    $id_us = $t_page['id_us'];
                    $avtor = user_info($id_us);
                    $date = $t_page['date'];
                    $date = date("d.m.y", strtotime($date));
                    $count = count_com($id);
                    $id_count_com = id_count_com($id);
                    if ($count == "") {
                        $count = "$com_count";
                    } else {
                        $count = $com_count - $count;
                        if ($count > "0") {
                            $count = "$com_count <font color = \"#FA0808\">+$count</font>";
                        } else {
                            $count = "$com_count";
                        }
                    }
                    echo "<tr><td>$date<br>$avtor</td><td><a href = \"$site/forum.php?id=$id\">$name</a></td><td>$count </td><td align = right><a href = \"$site/forum.php?id=$id$id_count_com\"><img src=\"img/message_reply.png\"  alt=\"К последнему сообщению\" border=\"0\"></a></td></tr>";
                }
                echo "</table>";
                echo "</div>
	</div>
</div>";
            }
        } else {
            $ok_page = mysql_query("select * from meropriatia where id = $id");
            while ($t_page = mysql_fetch_array($ok_page)) {
                $id_con = $t_page['id_con'];
            }
            $ok_sibkon = mysql_query("SELECT * FROM `sibkon` WHERE `id` = $id_con");
            while ($t_sibkon = mysql_fetch_array($ok_sibkon)) {
                $id_sibkon = $t_sibkon['id_con'];
                $god = $t_sibkon['god'];
                $tema = $t_sibkon['tema'];
            }
            $name_mer = name_mer($id);
            $dostup = dostup_mer_user($id);
            if ($tip == "1") {
                $func = "news_mer";
                $name_tip = "Новости";
            } else
            if ($tip == "2") {
                $func = "mat_mer";
                $name_tip = "Материалы";
            } else
            if ($tip == "3") {
                $func = "files_mer";
                $name_tip = "Файлы";
            } else
            if ($tip == "4") {
                $func = "forum_mer";
                $name_tip = "Обсуждения";
            } else
            if ($tip == "6") {
                $func = "user_mer";
                $name_tip = "Участники";
            } else
            if ($tip == "5") {
                $func = "comand_mer";
                $name_tip = "Команды";
            }
            echo "<p><a href = \"$site/sibkon.php?id=$god\">$name_site  $god: $tema</a> | $name_mer | $name_tip</p>";
            $func($id);
        }
    }
}

function title() {
    global $name_site, $status_site;
    if (isset($_GET['id'])) {
        $id = addslashes($_GET['id']);
    } else {
        $id = 0;
    }
    if (!is_numeric($id)) {
        die("Такой записи нет!");
    }
    $id = intval($id);
    $ok_page = mysql_query("select * from meropriatia where id = $id"); {
        while ($t_page = mysql_fetch_array($ok_page)) {
            $name = $t_page['name'];
        }
    }
    echo "
<title>$name | $name_site</title>";
    echo "
<script src=\"$site/js/jquery.autocomplete.js\" type=\"text/javascript\"></script>
<link type=\"text/css\" rel=\"stylesheet\" href=\"$site/js/jtip.css\" media=\"all\">
";
}

function block_mer() {
    global $site, $status_site, $name_group, $god_site, $id_user;
    if (isset($_GET['id'])) {
        $id = addslashes($_GET['id']);
    } else {
        $id = 0;
    }
    if (!is_numeric($id)) {
        die("Такой записи нет!");
    }
    $id = intval($id);
    $ok_page = mysql_query("select * from meropriatia where id = $id");
    while ($t_page = mysql_fetch_array($ok_page)) {
        $id = $t_page['id'];
        $yes = $t_page['yes'];
        $forum = $t_page['forum'];
        $files = $t_page['files'];
        $news = $t_page['news'];
        $mat = $t_page['mat'];
        $zakrito = $t_page['zakrito'];
        $id_con = $t_page['id_con'];
        $uprav = $t_page['uprav'];
        $komand = $t_page['komand'];
        $us = $t_page['us'];
        $anketa = $t_page['anketa'];
        $ok = $t_page['yes'];
    }
    $ok_page = mysql_query("select * from sibkon where id = $id_con");
    while ($t_page = mysql_fetch_array($ok_page)) {
        $id_con_god = $t_page['god'];
    }
    if (!($id_user == "")) {
        if ($id_con_god == $god_site) {
            $ok_page_u = mysql_query("select * from mer_us where id_us = $id_user and id_command = $id");
            while ($t_page_u = mysql_fetch_array($ok_page_u)) {
                $id_us_u = $t_page_u['id_us'];
                $tip_u = $t_page_u['tip'];
                $id_cn = $t_page_u['id'];
            }
            echo "
<div class=\"pane\">
	<div class=\"pane_p\">
		<div class=\"nccp\">
		<div class=\"pl\" align=\"left\"><strong>Ваше участие:</strong></div>
        <div class=\"pr\" align=\"right\">";
            if ($id_us_u == $id_user) {
                echo "<a href = no>отказаться</a>";
            }
            echo "</div>
		<br></div>
		<div class=\"text_block\">";
            if ($id_us_u == $id_user) {
                echo "<br>Вы участвуете в качестве ";
                if ($tip_u == "1") {
                    echo "главного организатора";
                } else
                if ($tip_u == "2") {
                    echo "организатора";
                } else
                if ($tip_u == "3") {
                    echo "участника";
                }
                $upravlenie = dostup_mer_adm($id);
                if ($upravlenie == "1") {
                    if (!($anketa == "0")) {
                        echo "<p align = \"center\"><a href = \"$site/mer/ed_anketa.php?id=$id\">Управление анкетой</a></p>";
                    }
                }
            } else {
                if ($us == "0") {
                    $status_user = status();
                    $status_reg = regpodpos();
                    if ($status_reg == "2" or $status_reg == "3") {
                        if ($status_user == "2") {
                            if ($ok == "0") {
                                if ($komand == "0") {
                                    $ok_pagez = mysql_query("select * from query where id_tip = 2 and id_mer = $id and id_us = $id_user and ok = 0");
                                    while ($t_pagez = mysql_fetch_array($ok_pagez)) {
                                        $id_usz = $t_pagez['id_us'];
                                    }
                                    if ($id_usz == $id_user) {
                                        echo "Вы подали уже заявку на это мероприятие, ожидайте решения.";
                                    } else {
                                        if ($anketa == "0") {
?>	
                                            <script type="text/javascript">
                                                jQuery(document).ready(function(){
                                                    jQuery('#example-1').click(function(){
                                                        jQuery(this).load('query/ad_mer_op.php?id=<?
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
                                            <div class="example cursor" id="example-1" align="center"><a>Подать заявку на участие</a></div>
                                            <div  id="loading">Ждите ответа в следующей серии...</div>
                                            <style type="text/css">#loading {display:none;}</style>
<?
                                        } else {
                                            echo "Для участия необходимо заполнить анкету.";
                                            echo "<form id=\"formID\" class=\"formular\" method=\"post\" action=\"$site/mer/ad_komand.php?id=$id\">";
                                            echo "	<textarea name= \"vopros\" rows=\"15\" cols=\"49\">";
                                            $orgkom5 = mysql_query("SELECT * FROM `anketa` WHERE `id_id` =$id");
                                            while ($orgkom15 = mysql_fetch_array($orgkom5)) {
                                                $vopros = $orgkom15['vopros'];
                                                echo "$vopros
";
                                            }
                                            echo "</textarea>";
                                            echo "<p align=\"right\">
<input type=\"submit\" value=\"Подать заявку\" ></p>
</form>";
                                        }
                                    }
                                } else {
                                    $ok_pagez = mysql_query("select * from query where id_tip = 2 and id_mer = $id and id_us = $id_user and ok = 0");
                                    while ($t_pagez = mysql_fetch_array($ok_pagez)) {
                                        $id_usz = $t_pagez['id_us'];
                                    }
                                    if ($id_usz == $id_user) {
                                        echo "Вы подали уже заявку на это мероприятие, ожидайте решения.";
                                    } else {
                                        if ($anketa == "0") {
                                            if ($komand == "1") {
                                                echo "Выберите название команды или введите новое<br>Допускается только командное участие";
                                            } else
                                            if ($komand == "2") {
                                                echo "Выберите название команды или введите новое. При участии без команды оставьте поле пустым";
                                            }
                                            echo "<form id=\"formID\" class=\"formular\" method=\"post\" action=\"$site/mer/ad_komand.php?id=$id\">";
                                            echo "<p><input type=\"text\" name=\"komand\"  id=\"example\" class=\"validate[required]\" size = \"50\">";
                                            echo "<p align=\"right\">
<input type=\"submit\" value=\"Подать заявку\" ></p>
</form>";
                                        } else {
                                            echo "<form id=\"formID\" class=\"formular\" method=\"post\" action=\"$site/mer/ad_komand.php?id=$id\">";
                                            if ($komand == "1") {
                                                echo "Выберите название команды или введите новое<br>Допускается только командное участие";
                                            } else
                                            if ($komand == "2") {
                                                echo "Выберите название команды или введите новое. При участии без команды оставьте поле пустым";
                                            }
                                            echo "<p><input type=\"text\" name=\"komand\"  id=\"example\" class=\"validate[required]\" size = \"50\">";
                                            echo "Для участия необходимо заполнить анкету.";
                                            echo "	<textarea name= \"vopros\" rows=\"15\" cols=\"49\">";
                                            $orgkom5 = mysql_query("	SELECT * FROM `anketa` WHERE `id_id` =$id");
                                            while ($orgkom15 = mysql_fetch_array($orgkom5)) {
                                                $vopros = $orgkom15['vopros'];
                                                echo "$vopros
";
                                            }
                                            echo "</textarea>";
                                            echo "<p align=\"right\">
<input type=\"submit\" value=\"Подать заявку\" ></p>
</form>";
                                        }
                                    }
                                }
                            } else {
                                echo "Мероприятие не одобрено, регистрация невозможна.";
                            }
                        } else {
                            echo "Вы не можете зарегистрироваться, так как не подтверждены.";
                        }
                    } else {
                        echo "Регистрация пока не началась";
                    }
                } else {
                    echo "<br>$name_group не требует регистрации";
                }
            }
            echo "</div>
	</div>
</div>";
        }
    }
    if ($komand == "1" or $komand == "2") {
        echo "
<div class=\"pane\">
	<div class=\"pane_p\">
		<div class=\"nccp\">
		<div class=\"pl\" align=\"left\"><strong>Команды</strong></div>
        <div class=\"pr\" align=\"right\"><a href = \"$site/mer.php?id=$id&tip=5\">Все</a></div>
		<br></div>
		<div class=\"text_block\">";
        echo "</div>
	</div>
</div>";
    }
    if ($us == "0") {
        echo "
<div class=\"pane\">
	<div class=\"pane_p\">
		<div class=\"nccp\">
		<div class=\"pl\" align=\"left\"><strong>Участники</strong></div>
        <div class=\"pr\" align=\"right\">";
        $ok_reg = mysql_query("select * from mer_us where id_command = $id and tip >2");
        $itog_reg1 = mysql_num_rows($ok_reg);
        echo "<a href = \"$site/mer.php?id=$id&tip=6\">Все ($itog_reg1)</a>";
        echo "</a></div>
		<br></div>
		<div class=\"text_block\">";
        echo "<table>";
        $ok_page = mysql_query("select * from mer_us where id_command = $id  and tip >2 order by tip limit 0, 5;"); {
            while ($t_page = mysql_fetch_array($ok_page)) {
                $id_us_u = $t_page['id_us'];
                $tip = $t_page['tip'];
                $id_zap_us = $t_page['id'];
                $user_u = user_info($id_us_u);
                if ($tip == "1") {
                    $pict = "<img src=\"$site/img/ico/admin_icon.png\" border=\"0\" alt=\"Основатель\">";
                } else
                if ($tip == "2") {
                    $pict = "<img src=\"$site/img/ico/kwifimanager.png\" border=\"0\" alt=\"Командование\">";
                } else
                if ($tip == "3") {
                    $pict = "<img src=\"$site/img/ico/kuser.png\" border=\"0\" alt=\"Участники\">";
                } else {
                    $pict = "";
                }
                echo "<tr><td>$pict</td><td>$user_u</td>";
                $master = dostup_mer_adm($id);
                $adm = dostup_adm();
                if ($master == 1 or $adm == 1) {
                    echo "<td><a href=\"$site/mer/del_user.php?id=$id_zap_us\" rel = \"facebox\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"Удалить\"></a></td>";
                }
                echo "</tr>";
            }
        }
        echo "</table>";
        echo "</div>
	</div>
</div>";
?>
        <script type="text/javascript">
            $(document).ready(function(){
                // --- Автозаполнение ---
                $("#example").autocompleteArray([
<?
        $rows = mysql_query("SELECT name FROM `mer_command` where id_mer = $id GROUP BY name");
        while ($st_mail_us_reg = mysql_fetch_array($rows)) {
            $kto1 = $st_mail_us_reg['name'];
            echo "'$kto1',\n";
        }
        echo "
";
?>
                ],
                {
                    delay:10,
                    minChars:1,
                    matchSubset:1,
                    autoFill:true,
                    maxItemsToShow:10
                }
            );
            });
        </script>
<? ?>
        <script type="text/javascript">
            $(function () {
                $('form').submit(function () {
                    $('input[type="submit"]', this).replaceWith('<p><strong>Ждите ответа в следующей серии...</strong></p>');
                });
            });
        </script>
<?
    }
    if ($news == "1") {
        echo "
<div class=\"pane\">
	<div class=\"pane_p\">
		<div class=\"nccp\">
		<div class=\"pl\" align=\"left\"><strong>Новости</strong></div>
        <div class=\"pr\" align=\"right\">";
        $ok_reg = mysql_query("select * from news where tip = 2 and id_id = $id");
        $itog_reg1 = mysql_num_rows($ok_reg);
        if ($itog_reg1 > "3") {
            echo "<a href = \"$site/mer.php?id=$id&tip=1\">Все</a>";
        }
        echo "</div>
		<br></div>
		<div class=\"text_block\">";
        echo "<table>";
        $ok_news = mysql_query("select * from news where tip = 2 and id_id = $id order by id_news desc limit 0, 3;");
        while ($t_news = mysql_fetch_array($ok_news)) {
            $id_news = $t_news['id_news'];
            $name_news = $t_news['small_news'];
            $time = $t_news['date_news'];
            $time1 = date("d.m.y", strtotime($time));
            echo "
            <tr><td>$time1</td><td><a href = \"$site/news.php?id=$id_news\">$name_news</a></td></tr>";
        }
        echo "</table>";
        $dostup_mer_tip = dostup_mer_tip($id);
        if ($id_con_god == $god_site) {
            $upravlenie1 = dostup_mer_adm($id);
            if ($upravlenie1 == "1") {
                echo "<br><div align = \"right\"><a href = \"$site/mer/ad_news.php?id=$id\">Добавить Новость</a></div>";
            }
        }
        echo "</div>
	</div>
</div>";
    }
    if ($mat == "1") {
        echo "
<div class=\"pane\">
	<div class=\"pane_p\">
		<div class=\"nccp\">
		<div class=\"pl\" align=\"left\"><strong>Материалы</strong></div>
        <div class=\"pr\" align=\"right\">";
        $ok_reg = mysql_query("select * from page_sibkon where tip = 2 and id_id = $id");
        $itog_reg1 = mysql_num_rows($ok_reg);
        if ($itog_reg1 > "3") {
            echo "<a href = \"$site/mer.php?id=$id&tip=2\">Все</a>";
        }
        echo "</div>
		<br></div>
		<div class=\"text_block\">";
        echo "<table>";
        $ok_news = mysql_query("select * from page_sibkon where tip = 2 and id_id = $id limit 0, 3;");
        while ($t_news = mysql_fetch_array($ok_news)) {
            $id_p = $t_news['id'];
            $name_p = $t_news['name'];
            $dostup_p = $t_news['dostup'];
            if ($dostup_p == "1") {
                $pict_p = "<img src=\"$site/img/ico/lockoverlay.png\" border=\"0\" alt=\"Закрыто\">";
            } else {
                $pict_p = "";
            }
            echo "
            <tr><td><a href = \"$site/page_sibkon.php?id=$id_p\">$name_p</a></td><td>$pict_p</td></tr>";
        }
        echo "</table>";
        $dostup_mer_tip = dostup_mer_tip($id);
        if ($id_con_god == $god_site) {
            $upravlenie2 = dostup_mer_adm($id);
            if ($upravlenie2 == "1") {
                echo "<br><div align = \"right\"><a href = \"$site/mer/ad_mat.php?id=$id\">Добавить Материал</a></div>";
            }
        }
        echo "</div>
	</div>
</div>";
    }
    if ($files == "1") {
        echo "
<div class=\"pane\">
	<div class=\"pane_p\">
		<div class=\"nccp\">
		<div class=\"pl\" align=\"left\"><strong>Файлы:</strong></div>
        <div class=\"pr\" align=\"right\">";
        $ok_reg = mysql_query("select * from files where id_id = $id and tip = 2");
        $itog_reg1 = mysql_num_rows($ok_reg);
        if ($itog_reg1 > "3") {
            echo "<a href = \"$site/mer.php?id=$id&tip=3\">Все</a>";
        }
        echo "</div>
		<br></div>
		<div class=\"text_block\">";
        echo "<table>";
        $ok_page = mysql_query("select * from files where id_id = $id and tip = 2 limit 0, 3;");
        while ($t_page = mysql_fetch_array($ok_page)) {
            $id_m = $t_page['id'];
            $name = $t_page['name'];
            $file = $t_page['file'];
            $us = $t_page['us'];
            $user = user_info($us);
            echo "<tr><td><a href = \"$site/files/mat/$id/$file\">$name</td></tr>";
        }
        echo "</table>";
        $upravlenie3 = dostup_mer_user($id);
        if ($upravlenie3 == "1") {
            echo "<br><div align = \"right\"><a href = \"$site/mer.php?id=$id&tip=3\">Добавить Файлы</a></div>";
        }
        echo "</div>
	</div>
</div>";
    }
}

function right() {
    global $site, $status_site, $name_group, $id_user, $god_site, $name_site;
    if (isset($_GET['id'])) {
        $id = addslashes($_GET['id']);
    } else {
        $id = 0;
    }
    if (!is_numeric($id)) {
        die("Такой записи нет!");
    }
    $id = intval($id);
    if ($id == "0") {
        if ($status_site == "2") {
            $site2 = mysql_query("select * from sibkon where god = $god_site"); {
                while ($site_i = mysql_fetch_array($site2)) {
                    $id = $site_i['id'];
                }
            }
            $status = status();
            if ($status > "0") {
              //  echo "<!--<p align = \"center\"><a href = \"$site/mer/ad.php?id=$id\" >Предложить свое $name_group</a></p>-->";
            } else {
                echo "<p align = \"center\">Вы не можете предлагать свое $name_group. Вам необходмио <a href = \"$site/registr.php\">Зарегистрироваться</a> для участия на $name_site $god_site</p>";
            }
        }
    } else {
        if ($status_site == "2") {
            echo "
<div class=\"pane\">
	<div class=\"pane_p\">
		<div class=\"nccp\">
		<strong>Организация</strong>
		</div><br>
		<div class=\"text_block\">";
            $ok_page = mysql_query("select * from mer_us where id_command = $id  and tip = 1");
            while ($t_page = mysql_fetch_array($ok_page)) {
                $id_us = $t_page['id_us'];
                $tip = $t_page['tip'];
                $id_zap_us = $t_page['id'];
                $user = user_info($id_us);
                echo "$user";
            }
            if ($user == "") {
                echo "Предложить свою кандидатуру организатора";
            }
            echo "</div>
	</div>
</div>";
            $ok_page = mysql_query("select * from meropriatia where id = $id"); {
                while ($t_page = mysql_fetch_array($ok_page)) {
                    $id = $t_page['id'];
                    $yes = $t_page['yes'];
                    $forum = $t_page['forum'];
                    $files = $t_page['files'];
                    $news = $t_page['news'];
                    $mat = $t_page['mat'];
                    $zakrito = $t_page['zakrito'];
                    if ($yes == "1") {
                        echo "<p align = \"center\"><font color = \"#FA0A0A\"><strong>Это $name_group находится в стадии рассмотрения</strong></font></p>";
                    }
                    $dostup_mer_user = dostup_mer_user($id);
                    if ($zakrito == "1") {
                        if ($dostup_mer_user == "0")
                            echo "$name_group закрытое. Ван надо подать заявку на участие или ожидать приглашения.";
                        else {
                            block_mer();
                        }
                    } else {
                        block_mer();
                    }
                }
            }
        } else {
            $ok_page = mysql_query("select * from meropriatia where id = $id");
            if (!mysql_num_rows($ok_page))
                die("error(12).<p>");
            else {
                while ($t_page = mysql_fetch_array($ok_page)) {
                    $podtip = $t_page['podtip'];
                    $tip = $t_page['tip'];
                }
            }
            if ($status_site == "2") {
                
            } else {
                echo "<div id=\"accordion\"><h3><a href=\"#\">В разные годы происходили: </a></h3><div><p>";
                $ok_page_s = mysql_query("select * from meropriatia where podtip = $podtip");
                if (!mysql_num_rows($ok_page_s))
                    die("Ничего в базе данных не обнаружено.<p>");
                else {
                    while ($t_page_s = mysql_fetch_array($ok_page_s)) {
                        $id_page = $t_page_s['id'];
                        $name_page = $t_page_s['name'];
                        $id_con = $t_page_s['id_con'];
                        $ok_page_si = mysql_query("select * from sibkon where id = $id_con"); {
                            while ($t_page_si = mysql_fetch_array($ok_page_si)) {
                                $god = $t_page_si['god'];
                            }
                            echo "<a href =\"$site/mer.php?id=$id_page\" >$name_page</a> (<a href = \"$site/sibkon.php?id=$god\">$god</a>) <br><br>";
                        }
                    }
                }
                echo "</div>";
                echo "<h3><a href=\"#\">Материалы</a></h3><div>";
                $ok_page_s = mysql_query("select * from page_sibkon where id_con = $id_con"); {
                    while ($t_page_s = mysql_fetch_array($ok_page_s)) {
                        $id_page = $t_page_s['id'];
                        $name_page = $t_page_s['name'];
                        global $site;
                        echo "<a href =\"$site/page_sibkon.php?id=$id_page\" >$name_page</a><br><br>";
                    }
                }
                echo "</div>";
                $ok_page_t = mysql_query("select * from tip_mer");
                while ($t_page_t = mysql_fetch_array($ok_page_t)) {
                    $id_tip = $t_page_t['id'];
                    $name_tip = $t_page_t['name'];
                    echo "<h3><a href=\"#\">$name_tip</a></h3><div>";
                    $ok_page_m = mysql_query("select * from meropriatia where id_con = $id_con and tip = $id_tip");
                    while ($t_page_m = mysql_fetch_array($ok_page_m)) {
                        $id_mer = $t_page_m['id'];
                        $name_mer = $t_page_m['name'];
                        echo "<a href = \"$site/mer.php?id=$id_mer\">$name_mer</a><br><br>";
                    }
                    echo "</div>";
                }
                echo "</div>";
            }
        }
    }
}

require ("theme/$theme/$theme.htm");
?>
