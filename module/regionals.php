<?php
/**
 * @author yerick
 * @copyright 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";

function pages() {
    global $site, $god_site, $id_user;
    $ok_page = mysql_query("SELECT * FROM `module` WHERE `file` = 'regionals'");
    while ($t_page = mysql_fetch_array($ok_page)) {
        $id_modul = $t_page['id'];
        $name_modul = $t_page['name'];
        $file = $t_page['file'];
        $on = $t_page['on'];
    }
    if ($on == "1") {
        echo "<h3 align = \"center\">$name_modul $god_site</h3>";
        $ok_page1 = mysql_query("SELECT *
FROM `regionals` 
WHERE `id_con` =$god_site");
        while ($t_page1 = mysql_fetch_array($ok_page1)) {
            $id_r = $t_page1['id'];
            $id_con = $t_page1['id_con'];
            $text = $t_page1['text'];
            $id_org = $t_page1['id_org'];
        }
        if ($id_r == "") {
            echo "В этом году служба не заведена";
            $dostup_org_god = dostup_org_god($god_site);
            $adm = dostup_adm();
            if ($dostup_org_god == "1" or $adm == "1") {
                echo "<p><a href = \"$site/module/regionals.php?id=1\">Завести службу</a>";
            }
        } else {
            echo "$text";
            $org = user_info($id_org);
            $dostup_org_god = dostup_org_god($god_site);
            $adm = dostup_adm();
            if ($dostup_org_god == "1" or $adm == "1") {
                echo "<div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href = \"$site/module/regionals.php?id=3\">Редактировать</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div><p>  
   ";
            }
            if ($id_org == $id_user or $dostup_org_god == "1" or $adm == "1") {
                echo "<h5>Пригласить в службу пользователя. Необходимо ввести ид пользователя.</h5>";
                echo "<form name=\"form1\" method=\"post\" action=\"regionals_prig.php\">
<table>
<tr><td>ИД пользователя:</td><td><input type=\"text\"  name='id_us' size=\"86\" value = \"$us\"></td></tr>
</table>
";
                echo "<div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"javascript:document.form1.submit()\">Пригласить в службу</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div><p>  
   ";
            }
            echo "<h5>Обсуждения Службы</h5><a href = \"$site/forum/ad_forum.php?t=3&amp;m=$id_modul&amp;id=$id_r\">Добавить новое</a>";
            echo "<table><thead><th></th><th>Дата</th><th>Автор</th><th>Тема</th><th>Коммент</th><th></th></thead>";
            $ok_page = mysql_query("select * from forum where pr_zap = $id_r and m = $id_modul order by date desc ");
            while ($t_page = mysql_fetch_array($ok_page)) {
                $id = $t_page['id'];
                $name = $t_page['name'];
                $com_count = $t_page['com_count'];
                $id_us = $t_page['id_us'];
                $dostup = $t_page['dostup'];
                $avtor = user_info($id_us);
                $date = $t_page['date'];
                $org = $t_page['org'];
                $date = date("d.m.y", strtotime($date));
                $count = count_com($id);
                $id_count_com = id_count_com($id);
                if ($dostup == "1") {
                    $pict = "<img src=\"$site/img/ico/lockoverlay.png\" border=\"0\" alt=\"Закрыто\">";
                } else {
                    $pict = "";
                }
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
                echo "<tr><td>$pict</td><td>$date</td><td>$avtor</td><td><a href = \"$site/forum.php?id=$id\">$name</a></td><td>$count</td><td align = right><a href = \"$site/forum.php?id=$id$id_count_com\"><img src=\"../img/message_reply.png\"  alt=\"К последнему сообщению\" border=\"0\"></a></td></tr>";
            }
            echo "</table>";
        }
    } else {
        echo "Модуль выключен.";
    }
}

function ad() {
    global $site, $god_site;
    $dostup_org_god = dostup_org_god($god_site);
    $adm = dostup_adm();
    if ($dostup_org_god == "1" or $adm == "1") {
        echo "<h4 align = \"center\">Добавление Службы регионалов на текущий проект</h4><form name=\"form1\" method=\"post\" action=\"/module/regionals.php?id=2\">
<table>
<tr><td>Текст главной страницы:</td><td><textarea name='text' rows=\"36\" cols='96' ></textarea></td></tr>
<tr><td>Куратор (ид пользователя):</td><td><input type=\"text\"  name='id_org' size=\"86\"></td></tr>        
</table>
<div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"javascript:document.form1.submit()\">Добавить</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div>
<p><input name = \"kno\" type=\"submit\" value='.' style=\"color:#fff;border:0;padding:0;margin:0;background:#fff;height:6px;width:6px\">   </form>
";
    }
}

function ad_post() {
    global $site, $god_site;
    $dostup_org_god = dostup_org_god($god_site);
    $adm = dostup_adm();
    if ($dostup_org_god == "1" or $adm == "1") {
        $text = addslashes($_POST['text']);
        $id_org = addslashes($_POST['id_org']);
        mysql_query("insert into `regionals`(`text` , `id_org` , `id_con` ) values('$text', '$id_org', '$god_site')");
        $nit = mysql_insert_id();
        $mess_log = "Добавил новую службу регионалов <a href = $site/module/regionals.php>Служба Регионалов $god_site</a>";
        ad_log($mess_log);
        pages();
    }
}

function edit() {
    global $site, $god_site;
    $dostup_org_god = dostup_org_god($god_site);
    $adm = dostup_adm();
    if ($dostup_org_god == "1" or $adm == "1") {
        $ok_page1 = mysql_query("SELECT *
FROM `regionals` 
WHERE `id_con` =$god_site");
        while ($t_page1 = mysql_fetch_array($ok_page1)) {
            $id_r = $t_page1['id'];
            $id_con = $t_page1['id_con'];
            $text = $t_page1['text'];
            $id_org = $t_page1['id_org'];
        }
        echo "<h4 align = \"center\">Редактирование Службы регионалов на текущий проект</h4><form name=\"form1\" method=\"post\" action=\"/module/regionals.php?id=4\">
<table>
<tr><td>Текст главной страницы:</td><td><textarea name='text' rows=\"36\" cols='96' >$text</textarea></td></tr>
<tr><td>Куратор (ид пользователя):</td><td><input type=\"text\"  name='id_org' size=\"86\" value = \"$id_org\"></td></tr>        
</table>
<div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"javascript:document.form1.submit()\">Редактировать</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div>
<p><input name = \"kno\" type=\"submit\" value='.' style=\"color:#fff;border:0;padding:0;margin:0;background:#fff;height:6px;width:6px\">   </form>
";
    }
}

function edit_post() {
    global $site, $god_site;
    $dostup_org_god = dostup_org_god($god_site);
    $adm = dostup_adm();
    if ($dostup_org_god == "1" or $adm == "1") {
        $text = addslashes($_POST['text']);
        $id_org = addslashes($_POST['id_org']);
        mysql_query("UPDATE `regionals` SET `text` ='$text', `id_org` ='$id_org' where `id_con` = '$god_site'");
        pages();
    }
}

function del_user() {
    global $site, $god_site;
    $dostup_org_god = dostup_org_god($god_site);
    $adm = dostup_adm();
    if ($dostup_org_god == "1" or $adm == "1") {
        if (isset($_GET['id_us'])) {
            $id_us = addslashes($_GET['id_us']);
        } else {
            $id_us = 0;
        }
        if (!is_numeric($id_us)) {
            die("Такой записи нет!");
        }
        $id_us = intval($id_us);
        $ok_page1 = mysql_query("SELECT *
FROM `regionals_us` 
WHERE `id` =$id_us");
        while ($t_page1 = mysql_fetch_array($ok_page1)) {
            $id_r = $t_page1['id_us'];
        }
        $user = user_info($id_r);
        echo "Вы хотите удалить $user из Службы регионалов?<br>
       <div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"$site/module/regionals.php?id=6&id_us=$id_us\">Удалить</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div>";
    }
}

function del_user_post() {
    global $site, $god_site;
    $dostup_org_god = dostup_org_god($god_site);
    $adm = dostup_adm();
    if ($dostup_org_god == "1" or $adm == "1") {
        if (isset($_GET['id_us'])) {
            $id_us = addslashes($_GET['id_us']);
        } else {
            $id_us = 0;
        }
        if (!is_numeric($id_us)) {
            die("Такой записи нет!");
        }
        $id_us = intval($id_us);
        $ok_page1 = mysql_query("SELECT *
FROM `regionals_us` 
WHERE `id` =$id_us");
        while ($t_page1 = mysql_fetch_array($ok_page1)) {
            $id_r = $t_page1['id_us'];
        }
        $user = user_info($id_r);
        $mess_log = "Удалил $user из Службы регионалов";
        ad_log($mess_log);
        mysql_query("DELETE FROM regionals_us WHERE   id = '$id_us'");
        echo "Пользователь $user был удален из службы";
    }
}

function edit_user() {
    global $site, $god_site, $id_user;
    if (isset($_GET['id_us'])) {
        $id_us = addslashes($_GET['id_us']);
    } else {
        $id_us = 0;
    }
    if (!is_numeric($id_us)) {
        die("Такой записи нет!");
    }
    $id_us = intval($id_us);
    $ok_page1 = mysql_query("SELECT *
FROM `regionals_us` 
WHERE `id` =$id_us");
    while ($t_page1 = mysql_fetch_array($ok_page1)) {
        $id_r = $t_page1['id_us'];
        $gorod = $t_page1['gorod'];
        $contact = $t_page1['contact'];
        $contact = nl2br($t_page1['contact']);
        $user = user_info($id_r);
        $dostup_org_god = dostup_org_god($god_site);
        $adm = dostup_adm();
        if ($dostup_org_god == "1" or $adm == "1" or $id_r = $id_user) {
            echo "<h4 align = \"center\">Редактирование данных регионала $user </h4>";
            echo "<form name=\"form1\" method=\"post\" action=\"$site/module/regionals.php?id=8&id_us=$id_us\">
          <p>Города (через запятую)<br><textarea name='gorod' rows=\"6\" cols='6' >$gorod</textarea></p>
          <p>Контакты<br><textarea name='contact' rows=\"16\" cols='6' >$contact</textarea></p>
          <div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"javascript:document.form1.submit()\">Изменить</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div>";
        }
    }
}

function edit_user_post() {
    global $site, $god_site, $id_user;
    if (isset($_GET['id_us'])) {
        $id_us = addslashes($_GET['id_us']);
    } else {
        $id_us = 0;
    }
    if (!is_numeric($id_us)) {
        die("Такой записи нет!");
    }
    $id_us = intval($id_us);
    $ok_page1 = mysql_query("SELECT *
FROM `regionals_us` 
WHERE `id` =$id_us");
    while ($t_page1 = mysql_fetch_array($ok_page1)) {
        $gorod = ($_POST['gorod']);
        $contact = ($_POST['contact']);
        $id_r = $t_page1['id_us'];
        $user = user_info($id_r);
        $dostup_org_god = dostup_org_god($god_site);
        $adm = dostup_adm();
        if ($dostup_org_god == "1" or $adm == "1" or $id_r = $id_user) {
            mysql_query(" UPDATE regionals_us SET gorod='$gorod', contact='$contact' where id = '$id_us'");
            echo "<h4 align = \"center\">Редактирование данных регионала $user </h4>";
            echo "
          <p><strong>Города:</strong> $gorod</p>
          <p><strong>Контакты:</strong> $contact
          ";
        }
    }
}

function user_reg_info() {
    global $site, $god_site, $id_user;
    $ok_page1 = mysql_query("SELECT * FROM `regionals_us` WHERE `id_us` =$id_user");
    while ($t_page1 = mysql_fetch_array($ok_page1)) {
        $gorod = $t_page1['gorod'];
        $id_r = $t_page1['id_us'];
        $user = user_info($id_r);
        $dostup_org_god = dostup_org_god($god_site);
        $adm = dostup_adm();
        if ($dostup_org_god == "1" or $adm == "1" or $id_r = $id_user) {
            echo "<h4 align = \"center\">Информация о участниках</h4>";
            $tag = preg_split('~\s*,\s*~', $gorod);
            for ($i = 0; $i < count($tag); $i++) {
                $cur_tag = $tag[$i];
                echo "<h4 align = \"center\">$cur_tag</h4><table>
    <tr><th>Имя/чей подопечный</th><th>Контакты</th><th>статус/участие</th></tr>
    ";
                $query = "select * From `us` where act_us = '1' and gorod_us = '$cur_tag' order by nick_us ";

                $result = mysql_query($query) or die("Query failed : " . mysql_error());
                while ($link = mysql_fetch_array($result, MYSQL_ASSOC)) {
                    $id_us = "$link[id_us]";
                    $telefon_us = "$link[telefon_us]";
                    $name_us = "$link[name_us]";
                    $fam_us = "$link[fam_us]";
                    $contact = "$link[contact]";
                    $master = "$link[master]";
                    if ($master == "0") {
                        $master = "";
                    } else {
                        $master_name = user_info($master);
                        $master = "(подопечный $master_name)";
                    }
                    $user = user_info($id_us);

                    $statusp = statusp($id_us);
                    if ($statusp == "1") {
                        $status = "<font color = \"#117909\">Зарегистрирован</font>";
                    } else if ($statusp == "2") {
                        $status = "<font color = \"#092498\">Подтвержден</font>";
                    } else {
                        $status = "<font color = \"#FB0A0A\">не зареген</font>";
                    }




                    echo "<tr><td width = 200><strong>$user</strong> <br>$fam_us $name_us<br>$master</td><td>$telefon_us<br>$contact</td><td width = 250 px>$status";

                    $poselen = poselen($id_us);
                    if (!($poselen == "")) {
                        $ok_page = mysql_query("select * from room_us where id_us = $id_us and god = $god_site");
                        while ($t_page = mysql_fetch_array($ok_page)) {
                            $id_room = $t_page['id_command'];
                        }
                        $name_room = name_room($id_room);

                        echo " $name_room ";
                    }

                    $mer = "select * From `mer_us` where id_us = $id_us";
                    $mer1 = mysql_query($mer) or die("Query failed : " . mysql_error());
                    while ($me2 = mysql_fetch_array($mer1, MYSQL_ASSOC)) {
                        $id_us = "$me2[id_us]";
                        $id_command = "$me2[id_command]";
                        $tip = "$me2[tip]";
                        $name_mer = name_mer($id_command);
                        if ($tip == "1") {
                            $tip = "Главный";
                        } else if ($tip == "2") {
                            $tip = "Организатор";
                        } else if ($tip == "3") {
                            $tip = "Участник";
                        }
                        //  echo "<li>$name_mer ($tip)";
                    }

                    echo"</td></tr>";
                }
                echo "</table>";
            }
        }
    }
}

function action() {
    if (isset($_GET['id'])) {
        $id = addslashes($_GET['id']);
    } else {
        $id = 0;
    }
    if (!is_numeric($id)) {
        die("Такой записи нет!");
    }
    $id = intval($id);
    //0 - главная страница
    if ($id == "0") {
        pages();
    } else
    if ($id == "1") {
        ad();
    } else
    if ($id == "2") {
        ad_post();
    } else
    if ($id == "3") {
        edit();
    } else
    if ($id == "4") {
        edit_post();
    } else
    if ($id == "5") {
        del_user();
    } else
    if ($id == "6") {
        del_user_post();
    } else
    if ($id == "7") {
        edit_user();
    } else
    if ($id == "8") {
        edit_user_post();
    } else
    if ($id == "9") {
        user_reg_info();
    }
}

function title() {
    global $name_site;
    if (isset($_GET['id'])) {
        $id = addslashes($_GET['id']);
    } else {
        $id = 0;
    }
    if (!is_numeric($id)) {
        die("Такой записи нет!");
    }
    $id = intval($id);
    //0 - главная страница
    if ($id == "0") {
        echo "<title>Служба Регионалов | $name_site</title>";
    } else
    if ($id == "1") {
        echo "<title>Новая Служба Регионалов | $name_site</title>";
    } else
    if ($id == "3") {
        echo "<title>Редактирование Службы Регионалов | $name_site</title>";
    } else {
        echo "<title>Служба Регионалов | $name_site</title>";
    }
}

function right() {
    global $god_site, $id_user, $site;
    $ok_page1 = mysql_query("SELECT * FROM regionals WHERE id_con = $god_site");
    while ($t_page1 = mysql_fetch_array($ok_page1)) {
        $id_r = $t_page1['id'];
        $id_con = $t_page1['id_con'];
        $text = $t_page1['text'];
        $id_org = $t_page1['id_org'];
    }

    if (!($id_user == "")) {
        $reg = mysql_query("SELECT * FROM regionals_us WHERE id_us = $id_user and id_command = $id_r");
        while ($reg1 = mysql_fetch_array($reg)) {
            $id_us_reg = $reg1['id_us'];
            $gorod_reg = $reg1['gorod'];
        }
        if ($id_us_reg == $id_user) {
            echo "<div class=\"pane\">
        <div class=\"pane_p\">
        <div class=\"text_block\">
        Вы регионал города: $gorod_reg
        <p><a href = \"$site/module/regionals.php?id=9\">Просмотр участников</a></p>
        </div></div></div></div>";
        }

        $org = user_info($id_org);
        echo "<p>Куратор: $org";
        if (!($id_user == "")) {
            $ok_page12 = mysql_query("SELECT *
FROM `us` 
WHERE `id_us` = $id_user");
            while ($t_page12 = mysql_fetch_array($ok_page12)) {
                $gorod_us = $t_page12['gorod_us'];
                echo "
        <div class=\"pane\">
        <div class=\"pane_p\">
        <div align = \"center\"><b >Ваш регионал:</b></div><div class=\"text_block\">";
                $x2 = "%$gorod_us%";
                $ok_page13 = mysql_query("SELECT *
FROM `regionals_us` 
WHERE `gorod` LIKE '$x2' and id_command = $id_r");

                if ($ok_page13 == true) {
                    while ($t_page13 = mysql_fetch_array($ok_page13)) {
                        $id_r1 = $t_page13['id_us'];
                        $contact = $t_page31['contact'];
                        $contact = nl2br($t_page13['contact']);
                        $regional = user_info($id_r1);
                        echo "$regional";
                        echo "<br>$contact<br>";
                    }
                }
            }
            echo "</div></div></div>";
        }
        echo "<h5 align = \"center\">Участники</h5>";
        if (!($id_user == "")) {
            $adm = dostup_adm();
            $ok_pageu = mysql_query("select * from regionals_us where id_command = $id_r and id_us = $id_user");
            while ($t_pageu = mysql_fetch_array($ok_pageu)) {
                $id_usu = $t_pageu['id_us'];
            }
            if ($id_usu == $id_user) {
                echo "";
            } else {
                $ok_pagez = mysql_query("select * from query where id_tip = 3 and id_mer = $id_r and id_us = $id_user and ok = 0");
                while ($t_pagez = mysql_fetch_array($ok_pagez)) {
                    $id_usz = $t_pagez['id_us'];
                }
                if ($id_usz == $id_user) {
                    echo "Вы подали уже заявку в эту команду, ожидайте решения.";
                } else {
?>	
                    <script type="text/javascript">
                        jQuery(document).ready(function(){
                            jQuery('#example-1').click(function(){
                                jQuery(this).load('regionals_query.php?id=<?
                    echo "$id_r";
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
        $ok_page = mysql_query("select * from regionals_us where id_command = $id_r");
        {
            while ($t_page = mysql_fetch_array($ok_page)) {
                $id_us = $t_page['id_us'];
                $id_zap_us = $t_page['id'];
                $user = user_info($id_us);
                echo "<tr><td>$user</td>";
                if ($id_us == $id_user or $id_org == $id_user or $adm == 1) {
                    echo "<td><a href=\"$site/module/regionals.php?id=7&id_us=$id_zap_us\" ><img src=\"$site/img/ico/file_edit.png\" border=\"0\" alt=\"Удалить\"></a></td>";
                } else {
                    echo "<td></td>";
                }
                if ($master == 1 or $adm == 1) {
                    echo "<td><a href=\"$site/module/regionals.php?id=5&id_us=$id_zap_us\" ><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"Удалить\"></a></td>";
                }
                echo "</tr>";
            }
        }
        echo "</table>";
        echo "<h5 align = \"center\">Приглашены</h5>";
        echo "<table>";
        $ok_prig = mysql_query("select * from query where id_tip = 3 and id_mer = $id_r  and ok = 5");
        while ($t_prig = mysql_fetch_array($ok_prig)) {
            $id_prig = $t_prig['id_master'];
            $id_pr = $t_prig['id'];
            $user_prig = user_info($id_prig);
            echo "<tr><td>$user_prig</td>";
            $adm = dostup_adm();
            if ($id_org == $id_user or $adm == 1) {
                echo "<td><a href=\"$site/query/ok.php?ok=2&id=$id_pr\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"Удалить\"></a></td>";
            }
        }
        echo "</tr>";
        echo "</table>";
        echo "<h5 align = \"center\">Подали заявки</h5>";
        echo "<table>";
        $ok_prig = mysql_query("select * from query where id_tip = 3 and id_mer = $god_site  and ok = 0");
        while ($t_prig = mysql_fetch_array($ok_prig)) {
            $id_prig = $t_prig['id_us'];
            $id_pr = $t_prig['id'];
            $user_prig = user_info($id_prig);
            echo "<tr><td>$user_prig</td>";
            $adm = dostup_adm();
            if ($id_org == $id_user or $adm == 1) {
                echo "<td><a href=\"$site/query/ok.php?ok=2&id=$id_pr\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"Удалить\"></a></td>";
            }
        }
        echo "</tr>";
        echo "</table>";
    }
}

require ("../theme/$theme/$theme.htm");
?>