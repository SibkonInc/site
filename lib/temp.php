<?php

/**
 * @author Yerick
 * @copyright 2009
 */
//ïîëó÷àåì äàííûå î ñàéòå, îñíîâíûå ïåðåìåííûå
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
$sit = $_SERVER['HTTP_HOST'];
$site = "http://$sit";
//ïîëó÷àåì äàííûå î ïîëüçîâàòåëå è åãî íàñòðîéêàõ
$id_user = $_COOKIE['id_us'];
$kus = $_COOKIE['ktip_us'];
$id_us_m = $_COOKIE['id_us_m'];
if (isset($id_user)) {
    $user_inf = mysql_query("select * From `us` where `id_us` = '$id_user'") or die("Äàííûå î ïîëüçîâàòåëå íå ïîëó÷åíû");
    while ($user_info = mysql_fetch_array($user_inf, MYSQL_ASSOC)) {
        $act_us = "$user_info[act_us]";
        $k = "$user_info[k]";
        $id_us_pr = "$user_info[id_us]";
        $tip_user = "$user_info[tip_us]";
    }
}
if (!($k == $kus)) {
    header("Location: $site/error.php?i=2");
}
if (!($id_us_pr == "$id_user")) {
    header("Location: $site/logout.php");
}
//ñòàâèì âðåìÿ ïðåáûâàíèÿ íà ñàéòå è âûÿñíÿåì ñêîëüêî ëþäåé íà ñàéòå
if (!($id_user == "")) {
    $timeonline = date("YmdHi");
    $online1 = mysql_query("select * From `online` where `id_us` = '$id_user'");
    while ($online2 = mysql_fetch_array($online1, MYSQL_ASSOC)) {
        $online = $online2[time];
    }
    if ($online == "") {
        mysql_query("insert into `online`(id_us,time) values('$id_user', '$timeonline')");
    } else {
        mysql_query(" UPDATE online SET time='$timeonline' where id_us = '$id_user'");
    }
}

//îïðåäåëåíèå ìåòà òåãîâ
function meta() {
    //ìåòà òåãè îáùèå
    global $name_site, $theme, $site;
    echo "
<link rel=\"alternate\" type=\"application/rss+xml\" href=\"rss.php\" title=\"Íîâîñòè\">
<link type=\"text/css\" rel=\"stylesheet\" href=\"$site/theme/$theme/$theme.css\">
<link type=\"text/css\" rel=\"stylesheet\" href=\"$site/css/global.css\">
<script type=\"text/javascript\" src=\"$site/js/jquery.js\"></script>
<link type=\"text/css\" href=\"/js/css/le-frog/jquery-ui-1.7.2.custom.css\" rel=\"stylesheet\" >
<script type=\"text/javascript\" src=\"$site/js/fun.js\"></script>
<script type=\"text/javascript\" src=\"$site/js/jquery.cookie.js\"></script>
<link href=\"$site/js/facebox/facebox.css\" media=\"screen\" rel=\"stylesheet\" type=\"text/css\">
<script src=\"$site/js/facebox/facebox.js\" type=\"text/javascript\"></script>
";
    echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=windows-1251\">";
    title();
    echo "
<meta name=\"keywords\" content=\"$name_site\">
";
}

function format_date_mes($date) {
    //îïðåäåëÿåì íàçâàíèå ìåñÿöà èç äàòû
    if ($date > 0) {
        $array = explode('-', $date); //Ðàçáèâàåì MySQL äàòó íà ìàññèâ
        //Ñîçäàåì ðóññêèå íàçâàíèÿ ìåñÿöåâ äëÿ ïîñëåäóþùåé çàìåíû
        $month['01'] = 'ÿíâàðÿ';
        $month['02'] = 'ôåâðàëÿ';
        $month['03'] = 'ìàðòà';
        $month['04'] = 'àïðåëÿ';
        $month['05'] = 'ìàÿ';
        $month['06'] = 'èþíÿ';
        $month['07'] = 'èþëÿ';
        $month['08'] = 'àâãóñòà';
        $month['09'] = 'ñåíòÿáðÿ';
        $month['10'] = 'îêòÿáðÿ';
        $month['11'] = 'íîÿáðÿ';
        $month['12'] = 'äåêàáðÿ';
        if ($array[2] < 10) { //Åñëè äåíü ìåñÿöà ìåíüøå äåñÿòè, òî óáåðàåì íîëü ïåðåä ÷èñëîì
            $array[2] = str_replace(0, '', $array[2]);
        }
        $day = date('D', mktime(0, 0, 0, $array[1], $array[2], $array[0])); //Ïîëó÷àåì äåíü íåäåëè äëÿ äàííîé äàòû
        //Âîçâðàùàåì îòôîðìàòèðîâàííóþ äàòó
        return $month[$array[1]];
    }
}

function format_date_html($date) {
    //ôîðìàò äàòû äëÿ ïðîïèñè
    $array = explode('-', $date); //Ðàçáèâàåì MySQL äàòó íà ìàññèâ
    //Ñîçäàåì ðóññêèå íàçâàíèÿ ìåñÿöåâ äëÿ ïîñëåäóþùåé çàìåíû
    $month['01'] = 'ÿíâ';
    $month['02'] = 'ôåâ';
    $month['03'] = 'ìàð';
    $month['04'] = 'àïð';
    $month['05'] = 'ìàÿ';
    $month['06'] = 'èþí';
    $month['07'] = 'èþë';
    $month['08'] = 'àâã';
    $month['09'] = 'ñåíò';
    $month['10'] = 'îêò';
    $month['11'] = 'íîÿ';
    $month['12'] = 'äåê';
    if ($array[2] < 10) { //Åñëè äåíü ìåñÿöà ìåíüøå äåñÿòè, òî óáåðàåì íîëü ïåðåä ÷èñëîì
        $array[2] = str_replace(0, '', $array[2]);
    }
    $day = date('D', mktime(0, 0, 0, $array[1], $array[2], $array[0])); //Ïîëó÷àåì äåíü íåäåëè äëÿ äàííîé äàòû
    //Âîçâðàùàåì îòôîðìàòèðîâàííóþ äàòó
    return $array[2] . ' ' . $month[$array[1]] . ' ' . $array[0] . '';
}

function time_zone($date) {
    global $id_user;
    if (!($id_user == "")) {
        $time = date("H:i", strtotime($date));
        $time1 = date("H", strtotime($date));
        $time2 = date("i", strtotime($date));
        $query_s = "select * From `us_config` where `id_us` = $id_user";
        $result_s = mysql_query($query_s);
        while ($link_s = mysql_fetch_array($result_s, MYSQL_ASSOC)) {
            $time_zone = "$link_s[time_zone]";
        }
        $time_s = $time_zone;
        $time1 = $time1 + $time_s;
        if ($time1 >= 24) {
            $time1 = $time1 - 24;
        }
        $time = "$time1:$time2";
        return $time;
    }
}

function dostup_adm() {
    //ïðîâåðêà òèïà ïîëçîâàòåëÿ äëÿ ðàçðåøåíèÿ àäìèíèñòðèðîâàíèÿ.
    global $id_user;
    if (isset($id_user)) {
        $user_inf = mysql_query("select * From `us` where `id_us` = '$id_user'") or die("Äàííûå î ïîëüçîâàòåëå íå ïîëó÷åíû");
        while ($user_info = mysql_fetch_array($user_inf, MYSQL_ASSOC)) {
            $act_us = "$user_info[act_us]";
            $k = "$user_info[k]";
            $tip_user = "$user_info[tip_us]";
            $theme = "$user_info[theme]";
        }
    }
    return $tip_user;
}

function dostup_org() {
    //ïðîâåðêà îáùåãî äîñòóïà äëÿ îðãîâ
    global $id_user;
    if (!($id_user == "")) {
        $ok_tip = mysql_query("SELECT * FROM org where id_org = $id_user");
        while ($t_tip = mysql_fetch_array($ok_tip)) {
            $id_o = $t_tip['id'];
            $id_org = $t_tip['id_org'];
            $god = $t_tip['god'];
        }
        if (!($id_o == "")) {
            $dostup_org = "1";
            return $dostup_org;
        }
    }
}

function dostup_org_god($god) {
    //ïðîâåðêà îáùåãî äîñòóïà äëÿ îðãîâ
    global $id_user;
    if (!($id_user == "")) {
        $ok_tip = mysql_query("SELECT * FROM org where id_org = $id_user and god = $god");
        while ($t_tip = mysql_fetch_array($ok_tip)) {
            $id_o = $t_tip['id'];
            $id_org = $t_tip['id_org'];
            $god = $t_tip['god'];
        }
        if (!($id_o == "")) {
            $dostup_org = "1";
            return $dostup_org;
        }
    }
}

function status_site() {
    //âûñâå÷èâàåò ìåíþ â çàâèñèìîñòè îò ñòàòóñà ñàéòà
    global $site, $tip_user, $id_us_m, $id_user, $menu;
    $site1 = mysql_query("select * from setting_site");
    {
        while ($site_i = mysql_fetch_array($site1)) {
            $name_site = $site_i['name_site'];
            $status_site = $site_i['status_site'];
            $status_text = $site_i['status_text'];
            $theme = $site_i['theme'];
            $god_site = $site_i['god'];
            $reg_on = $site_i['reg'];
            $forum = $site_i['forum'];
            $module = $site_i['module'];
            $arhiv = $site_i['arhiv'];
        }
    }
    $ktip_us_m = $_COOKIE['ktip_m'];
    ;
    if ($status_site == "0") {
        //0 - ñàéò çàêðûò
        echo "
<div align=\"center\"><h1>$name_site</h1><br><b>$status_text</div>";
        $adm = dostup_adm();
        if (!($adm == "1")) {
            echo "
<div align=\"center\">
<form method=\"post\" name=\"login\" action=\"$site/login.php\">Ëîãèí:
<input class=\"inputText\" type=\"text\" name=\"login\" id=\"login_us\" size = 30 />
<br>Ïàðîëü:<input class=\"inputText\" type=\"password\" name=\"pass_us\" id=\"pass_us\"  size = 30/>
<br>×óæîé&nbsp;êîìïüþòåð&nbsp;<input type=\"checkbox\" name=\"aliens\">
<div style=\"height:20px;margin-top:5px;\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\"><li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"javascript:document.login.kno.submit()\">Âõîä</a></span>
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div>
<input name = \"kno\" type=\"submit\" value='.' style=\"color:#fff;border:0;padding:0;margin:0;background:#fff;height:6px;width:6px\"/>
</form>
";
            exit();
        }
    } else
    if ($status_site == "1") {
        // 1 - ñàéò ìåæäó ñèáêîíàìè
        echo "<a href = \"$site/index.php\">Ãëàâíàÿ</a> |
				<a href = \"$site/forum.php\">Ôîðóì</a>";
        $adm = dostup_adm();
        $god_org = dostup_org_god($god_site);
        if ($adm == 1 or $god_org == 1) {
            echo " | <a href = \"$site/orgforum.php\">Îðã ôîðóì</a>";
        }
    } else
    if ($status_site == "2") {
        if ($menu == "0") {
            // 2 - ñàéò ñàìîãî ñèáêîíà
            if (isset($_GET['id'])) {
                $id = addslashes($_GET['id']);
            } else {
                $id = 0;
            }
            if (!is_numeric($id)) {
                die("Òàêîé çàïèñè íåò!");
            }
            $id = intval($id);
            echo "
<div id=\"tabs\">
<ul>
<li><a href=\"#sibkon\">$name_site $god_site</a></li>";
            $ok_page_s = mysql_query("select * from sibkon where god = $god_site");
            while ($t_page_s = mysql_fetch_array($ok_page_s)) {
                $id_s = $t_page_s['id'];
                $tema_s = $t_page_s['tema'];
                $date_in = $t_page_s['date_in'];
                $date_out = $t_page_s['date_out'];
                $date_in1 = date("d", strtotime($date_in));
                $date_out1 = date("d", strtotime($date_out));
                $date_in_m = date("m", strtotime($date_in));
                $date_out1_m = date("m", strtotime($date_out));
                $date_out2 = format_date_mes($date_out);
                $date_out23 = format_date_mes($date_in);
                $date_god = date("Y", strtotime($date_out));
            }
            echo "
<li><a href = \"#info\">Èíôîðìàöèÿ</a></li>";
            $ok_page_t = mysql_query("select * from tip_mer");
            while ($t_page_t = mysql_fetch_array($ok_page_t)) {
                $id_tip = $t_page_t['id'];
                $name_tip = $t_page_t['name'];
                echo "<li><a href = \"#mer$id_tip\">$name_tip</a></li>";
            }
            if ($arhiv == "1") {
                echo "<li><a href = \"#arhiv\">Àðõèâ</a></li>";
            }
            if ($module == "1") {
                echo "<li><a href = \"#moduls\">Ìîäóëè</a></li>";
            }
            if ($forum == "1") {
                echo "<li><a href = \"#forums\">Ôîðóìû</a></li>";
            }
            echo "</ul>";
            echo "
<div id = \"sibkon\">";
            echo "<b>$tema_s</b><br>";
            if ($date_in_m == $date_out1_m) {
                $data = "$date_in1-$date_out1 $date_out2 $date_god";
            } else {
                $data = "$date_in1 $date_out23 - $date_out1 $date_out2 $date_out3";
            }
            echo "$data";
            echo "</div>";
            echo "
<div id = \"info\">";
            if (isset($id_s)) {
                $ok_page_s = mysql_query("select * from page_sibkon where id_con = $id_s and id_id = 0 order by name");
                {
                    while ($t_page_s = mysql_fetch_array($ok_page_s)) {
                        $id_page = $t_page_s['id'];
                        $name_page = $t_page_s['name'];
                        global $site;
                        if ($id_page == $id) {
                            echo "
<b>$name_page</b>  |  ";
                        } else {
                            echo "
<a href = \"$site/page_sibkon.php?id=$id_page\">$name_page</a>  |  ";
                        }
                    }
                }
            }
            echo "
</div>";
            $ok_page_tm = mysql_query("select * from tip_mer");
            while ($t_page_tm = mysql_fetch_array($ok_page_tm)) {
                $id_tipm = $t_page_tm['id'];
                $name_tipm = $t_page_tm['name'];
                echo "
<div id = \"mer$id_tipm\">";
                $ok_page_tmm = mysql_query("select * from meropriatia where tip = $id_tipm and id_con = $id_s and yes = 0 order by name");
                while ($t_page_tmm = mysql_fetch_array($ok_page_tmm)) {
                    $id_tipmm = $t_page_tmm['id'];
                    $name_tipmm = $t_page_tmm['name'];
                    if ($id_tipmm == $id) {
                        echo "
<b>$name_tipmm</b> |  ";
                    } else {
                        echo "
<a href = \"$site/mer.php?id=$id_tipmm\">$name_tipmm</a> |  ";
                    }
                }
                echo "
</div>";
            }
            if ($arhiv == "1") {
                echo "
<div id = \"arhiv\">";
                $ok_god = mysql_query("select * from sibkon order by god desc");
                while ($t_god = mysql_fetch_array($ok_god)) {
                    $god = $t_god['god'];
                    if ($god == $id) {
                        echo "<b>$god</b>  |  ";
                    } else {
                        echo "<a href=\"$site/sibkon.php?id=$god\">$god</a> | ";
                    }
                }
                echo "
</div>";
            }
            if ($forum == "1") {
                echo "
<div id = \"forums\">";
                echo "
				<a href = \"$site/forum.php\">Îáùèé</a>";
                echo " | <a href = \"$site/forum.php?f=1\">Êîìàíäû</a>";
                echo " | <a href = \"$site/forum.php?f=3\">Äîñòóïíûå</a>";
                echo " | <a href = \"$site/forum.php?f=2\">Ïîäïèñàííûå</a>";
                $adm = dostup_adm();
                $god_org = dostup_org_god($god_site);
                if ($adm == 1 or $god_org == 1) {
                    echo " | <a href = \"$site/orgforum.php\">Îðã ôîðóì</a>";
                }
                echo "</div>";
            }
            if ($module == "1") {
                echo "
				<div id = \"moduls\">";
                $ok_page = mysql_query("select * from module WHERE `on` =1");
                while ($t_page = mysql_fetch_array($ok_page)) {
                    $id_modul = $t_page['id'];
                    $name_modul = $t_page['name'];
                    $file = $t_page['file'];
                    echo "<a href = \"$site/module/$file.php\">$name_modul</a> | ";
                }
                echo "</div>";
            }
            echo "
</div>";
?>
            <script type="text/javascript">
                $(function(){
                    $("#tabs").tabs();
                });
                $("#tabs").tabs({ cookie: { expires: 30 } });
            </script>
<?

        } else {
            echo "
                 <script type=\"text/javascript\" src=\"$site/js/jquery.dropDown.pack.js\"></script>
	<script type=\"text/javascript\">
		$(document).ready(function(){
			$('ul#nav').NavDropDown();
		});
	</script>
 ";
            $ok_page_s = mysql_query("select * from sibkon where god = $god_site");
            while ($t_page_s = mysql_fetch_array($ok_page_s)) {
                $id_s = $t_page_s['id'];
                $tema_s = $t_page_s['tema'];
                $date_in = $t_page_s['date_in'];
                $date_out = $t_page_s['date_out'];
                $date_in1 = date("d", strtotime($date_in));
                $date_out1 = date("d", strtotime($date_out));
                $date_in_m = date("m", strtotime($date_in));
                $date_out1_m = date("m", strtotime($date_out));
                $date_out2 = format_date_mes($date_out);
                $date_out23 = format_date_mes($date_in);
                $date_god = date("Y", strtotime($date_out));
            }
            echo "
    <ul id=\"nav\" class=\"example1\">
        <li class = \"pod\">";
            echo "<a href = \"#\" >Èíôîðìàöèÿ</a>
            <div>
                <ul class = \"poda\">";
            if (isset($id_s)) {
                $ok_page_s = mysql_query("select * from page_sibkon where id_con = $id_s and id_id = 0 order by name");
                {
                    while ($t_page_s = mysql_fetch_array($ok_page_s)) {
                        $id_page = $t_page_s['id'];
                        $name_page = $t_page_s['name'];
                        global $site;
                        echo "
<li><a href = \"$site/page_sibkon.php?id=$id_page\">$name_page</a></li>";
                    }
                }
            }
            echo "<li>&nbsp;</li></ul>
           </div>
           </li>";
            $ok_page_t = mysql_query("select * from tip_mer");
            while ($t_page_t = mysql_fetch_array($ok_page_t)) {
                $id_tip = $t_page_t['id'];
                $name_tip = $t_page_t['name'];

           if (!($name_tip=="Ðè áëîê")){
                echo "<li  class = \"pod\">
           <a href = \"$site/tip.php?id=$id_tip\" >$name_tip</a>
              <div>
                <ul class = \"poda\">";
                $ok_page_tmm = mysql_query("select * from meropriatia where tip = $id_tip and id_con = $id_s and yes = 0 order by name");
                while ($t_page_tmm = mysql_fetch_array($ok_page_tmm)) {
                    $id_tipmm = $t_page_tmm['id'];
                    $name_tipmm = $t_page_tmm['name'];
                    echo "
<li><a href = \"$site/mer.php?id=$id_tipmm\">$name_tipmm</a></li>";
                }
                echo "<li>&nbsp;</li>
                </ul>
           </div></li>";
            }}
            $neod = mysql_query("select * from meropriatia where id_con = $id_s and yes = 1 order by name");
            $itog_neod = mysql_num_rows($neod);
            if ($itog_neod > "0") {
                echo "<li  class = \"pod\">
           <a href = \"#\" >Íà ðàññìîòðåíèè</a>
              <div>
                <ul class = \"poda\">";
                $ok_page_tmm = mysql_query("select * from meropriatia where id_con = $id_s and yes = 1 order by name");
                while ($t_page_tmm = mysql_fetch_array($ok_page_tmm)) {
                    $id_tipmm = $t_page_tmm['id'];
                    $name_tipmm = $t_page_tmm['name'];
                    echo "
<li><a href = \"$site/mer.php?id=$id_tipmm\">$name_tipmm</a></li>";
                }
                echo "<li>&nbsp;</li>
                </ul>
           </div></li>";
            }
            if ($arhiv == "1") {
                echo "<li class = \"pod\">
           <a href = \"#\"  >Àðõèâ</a><div>
                <ul class = \"poda\">";
                $ok_god = mysql_query("select * from sibkon order by god desc");
                while ($t_god = mysql_fetch_array($ok_god)) {
                    $god = $t_god['god'];
                    echo "<li><a href=\"$site/sibkon.php?id=$god\">$god</a></li>";
                }
                echo "<li>&nbsp;</li>
                </ul>
           </div></li>";
            }
            if ($module == "1") {
                echo "<li class = \"pod\">
           <a href = \"#\"  >Ìîäóëè</a><div>
                <ul class = \"poda\">";
                $ok_page = mysql_query("select * from module WHERE `on` =1");
                while ($t_page = mysql_fetch_array($ok_page)) {
                    $id_modul = $t_page['id'];
                    $name_modul = $t_page['name'];
                    $file = $t_page['file'];
                    echo "<li><a href = \"$site/module/$file.php\">$name_modul</a></li>";
                }
                echo "<li>&nbsp;</li>
                </ul>
           </div></li>";
            }
            if ($forum == "1") {
                echo "<li  class = \"pod\">
           <a href = \"#\" >Ôîðóìû</a><div>
                <ul class = \"poda\">";
                echo "<li><a href = \"$site/forum.php\">Îáùèé</a></li>";
                echo "<li><a href = \"$site/forum.php?f=1\">Êîìàíäû</a></li>";
                echo "<li><a href = \"$site/forum.php?f=3\">Äîñòóïíûå</a></li>";
                echo "<li><a href = \"$site/forum.php?f=2\">Ïîäïèñàííûå</a></li>";
                $adm = dostup_adm();
                $god_org = dostup_org_god($god_site);
                if ($adm == 1 or $god_org == 1) {
                    echo "<li><a href = \"$site/orgforum.php\">Îðã ôîðóì</a></li>";
                }
                echo "<li>&nbsp;</li>
                </ul>
           </div></li>";
            }
            echo "
    </ul>
    ";
        }
    }
    if (!($id_us_m == "")) {
        echo "<div align=\"center\"><h3><b>Âû íàõîäèòåñü â ðåæèìå ïåðåõâàòà óïðàâëåíèåì âàøèì ïîäîïå÷íûì ";
        $user = user_info($id_user);
        echo "$user <a href = \"$site/logout.php\">Âûéòè èç ðåæèìà</a></b></h3></div>";
    }
    if ($id_user == "533") {
        //echo "<div align=\"center\"><h3><font color = #FA0505 >Êíîïêà - Áÿêà!!!!</font></h3></div> ";
    }
    if ($id_user == "806") {
        // echo "<div align=\"center\"><h3><font color = #FA0505 >Îëüêà - òîðìîç!</font></h3></div> ";
    }
    //echo "<div align=\"center\"><h1><font color = #FA0505 >Ñ Íîâûì Ãîäîì!!!</font></h1></div>";
}
function opros() {
    echo "<!-- funccms:553 function opros() file: theme/def/opros.html --> ";
    if (file_exists('theme/def/opros.html')) {
        //echo 'exists';
        //require_once "theme/def/opros.html";
    } else {
        //echo 'not found';
    }

}


function left_menu() {
    global $site, $id_user, $name_group;
    //îáùåå ìåíþ, îñíîâíîå.
    echo "<br><div align = \"center\"><strong>Ìåíþ</strong></div>";
    echo "<ul>";
    echo "<li><a href = \"$site/profile.php\">Ìîè äàííûå</a></li>";
    echo "<li><a href = \"$site/pager.php\">";
    $ok_reg = mysql_query("select * from pager  WHERE `in` =  '$id_user' AND `st_in` =  '0'");
    $itog_reg1 = mysql_num_rows($ok_reg);
    if ($itog_reg1 > "0") {
        echo "<b>Ïåéäæåð ($itog_reg1</b>)";
    } else {
        echo "Ïåéäæåð";
    }
    echo "</a></li>";
    echo "<li><a href = \"$site/query.php\">";
    $query = mysql_query("select * from query  WHERE id_master = $id_user and `ok` = '0' ");
    $itog_query = mysql_num_rows($query);
    $query2 = mysql_query("select * from query  WHERE id_master = $id_user and `ok` = '5' ");
    $itog_query2 = mysql_num_rows($query2);
    $summa_query = $itog_query + $itog_query2;
    if ($summa_query > "0") {
        echo "<b>Çàïðîñû ($summa_query</b>)";
    } else {
        echo "Çàïðîñû";
    }
    echo "</a></li>";
    echo "<li><a href = \"$site/command.php\">Êîìàíäû</a></li>";
    echo "<li><a href = \"$site/mer.php\">$name_group</a></li>";
    echo "<li><a href = \"$site/users.php\">Ïîëüçîâàòåëè</a></li>";
    echo "<li><a href = \"$site/logout.php\">Âûõîä</a></li>";
    echo "</ul>";
}

function admin_menu() {
    //ìåíþ äëÿ àäìèíèñòðàòîðà. ïî ëîãèêå âõîä â àäìèíêó, óêàçàíèå, ÷òî åñòü íîâûå äëÿ ðåãèñòðàöèè
    global $id_user, $site, $god_site, $name_group;
    $site2 = mysql_query("select * from sibkon where god = $god_site");
    {
        while ($site_i = mysql_fetch_array($site2)) {
            $id = $site_i['id'];
        }
    }
    $dostup_adm = dostup_adm();
    $dostup_org = dostup_org();
    if ($dostup_adm == '1' or $dostup_org == '1') {
        echo "<br><div align = \"center\"><strong>Àäìèíêà</strong></div>";
        echo "<ul>";
        echo "<li><a href = \"$site/admin.php\" >Àäìèíèñòðèðîâàíèå</a></li>";
        echo "<li><a href = \"$site/news/ad.php\" >Äîáàâèòü íîâîñòü</a></li>";
        echo "<li><a href = \"$site/mer/ad.php?id=$id\" >Äîáàâèòü $name_group</a></li>";
    }
    if ($dostup_adm == '1' or $id_user == "539") {
        $query = "select * From `us` where `act_us` = 0 ";
        $result = mysql_query($query);
        $itog_reg = mysql_num_rows($result);
        if ($itog_reg > "0") {
            echo "<b>$itog_reg Îæèäàþò àêòèâàöèè:</b>";
            while ($link = mysql_fetch_array($result, MYSQL_ASSOC)) {
                $id_us = "$link[id_us]";
                $nick_us = "$link[nick_us]";
                echo "<br><a href = \"$site/profile.php?id=$id_us\">$nick_us</a>";
            }
        }
    }
    if ($dostup_adm == '1' or $dostup_org == '1') {
        echo "</ul>";
    }
}

function regpodpos() {
    global $god_site;
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
    $regpodpos = 1;
    if ($date_reg < $date_now) {
        $regpodpos = "1";
    } if ($date_pod < $date_now) {
        $regpodpos = "2";
    } if ($date_pos < $date_now) {
        $regpodpos = "3";
    }

    return $regpodpos;
}

function status() {
    global $id_user, $god_site;
    $registr = mysql_query("select * from registr where god = $god_site and id_us = $id_user");
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

function statusp($id_us) {
    global $id_user, $god_site;
    $registr = mysql_query("select * from registr where god = $god_site and id_us = $id_us");
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
        $name_sibkon = "<a href = \"$site/room.php?id=$id\">$name</a>";

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

function poselen($id_us) {
    global $id_user, $god_site;
    $registr = mysql_query("select * from room_us where god = $god_site and id_us = $id_us");
    while ($registr_s = mysql_fetch_array($registr)) {
        $id = $registr_s['id_command'];
    }
    return $id;
}

function registr() {
    global $id_user, $god_site, $id_us_m, $site, $name_site;
    echo "<br><div align = \"center\">";
    echo "<strong>Ðåãèñòðàöèÿ íà <br>$name_site $god_site</strong>";
    $ok_page_s = mysql_query("select * from sibkon where god = $god_site");
    while ($t_page_s = mysql_fetch_array($ok_page_s)) {
        $ok_page = mysql_query("select * from sibkon where god = $god_site");
        while ($t_page = mysql_fetch_array($ok_page)) {
            $date_in_m = date("m", strtotime($date_in));
            $date_god = date("Y", strtotime($date_out));
            $data_reg = format_date_html($t_page['data_reg']);
            $data_pod = format_date_html($t_page['data_pod']);
            $data_pos = format_date_html($t_page['data_pos']);
        }
        $regpodpos = regpodpos();
        $status = status();
        if ($regpodpos == false) {
            echo "<br>íà÷íåòñÿ $data_reg";
        } else
        if ($regpodpos == "1") {
            if ($status == "1") {
                echo "<br><a href = \"$site/registr.php\">Çàðåãèñòðèðîâàí</a><br><a href = \"$site/registr_off.php\">Ñíÿòü ðåãèñòðàöèþ</a><br>Ïîäòâåðæäåíèå ñ <br>$data_pod";
            } else {
                echo "<br><a href = \"$site/registr.php\"><strong><font color = \"#FE0505\">Çàðåãèñòðèðîâàòüñÿ</font></strong></a><br>";
            }
        } else
        if ($regpodpos == "2") {
            if ($status == "1") {
                echo "<br><a href = \"$site/registr.php\">Çàðåãèñòðèðîâàí</a><br><a href = \"$site/registr_off.php\">Ñíÿòü ðåãèñòðàöèþ</a><br>
     <a href = \"$site/registr.php\"><strong><font color = \"#FE0505\">Ïîäòâåðäèòüñÿ</font></strong></a><br>";
            } elseif ($status == "2") {
                echo "<br><a href = \"$site/registr.php\">Ïîäòâåðæäåí</a><br>Ïîñåëåíèå ñ <br>$data_pos";
            } else {
                echo "<br><a href = \"$site/registr.php\"><strong><font color = \"#FE0505\">Çàðåãèñòðèðîâàòüñÿ</font></strong></a><br>";
            }
        } else
        if ($regpodpos == "3") {
            if ($status == "1") {
                   echo "<br><a href = \"$site/registr.php\">Çàðåãèñòðèðîâàí</a><br><a href = \"$site/registr_off.php\">Ñíÿòü ðåãèñòðàöèþ</a><br>
                 <a href = \"$site/registr.php\"><strong><font color = \"#FE0505\">Ïîäòâåðäèòüñÿ</font></strong></a><br>";
            } elseif ($status == "2") {
                echo "<br><a href = \"$site/registr.php\">Ïîäòâåðæäåí</a><br><a href = \"$site/registr_off.php\">Ñíÿòü ðåãèñòðàöèþ</a><br>";
                $poselen = poselen($id_user);
                if ($poselen == "") {
                            echo "<a href = \"$site/room.php\"><strong><font color = \"#FE0505\">Ïîñåëèòüñÿ</font></strong></a><br>
                    		";
                } else {
                    $name_room = name_room($poselen);
                    echo "Ïîñåëåí â $name_room";
                    echo "<br><a href = \"$site/room.php\">Ñïèñîê êîìíàò</a>";
                }
            } else {
                      echo "<br><a href = \"$site/registr.php\"><strong><font color = \"#FE0505\">Çàðåãèñòðèðîâàòüñÿ</font></strong></a><br>";
            }
        }
        // echo "<br>Ðåãèñòðàöèÿ è ïîñåëåíèå çàêîí÷åíî. Óâèäèìñÿ íà Ñèáêîíå!<br>
        echo" <br><a href = \"$site/registr/registr_info.php\">Ñïèñîê ðåãèñòðàöèè</a>";
          echo" <br><a href = \"$site/registr/registr_room.php\">Ñïèñîê ïîñåëåíèÿ</a>";



        echo "<table>";
 //  ";
        $ok_reg = mysql_query("select * from registr  WHERE `reg` =  '1' and `god` = '$god_site'");
        $itog_reg1 = mysql_num_rows($ok_reg);
        $ok_reg2 = mysql_query("select * from registr  WHERE `reg` =  '2' and `god` = '$god_site'");
        $itog_reg12 = mysql_num_rows($ok_reg2);
        $ok_reg3 = mysql_query("select * from room_us  WHERE `god` = '$god_site'");
        $itog_reg13 = mysql_num_rows($ok_reg3);
        $itog_reg123 = $itog_reg1 + $itog_reg12;
        echo "<tr><td align=\"left\" >Çàðåãèñòðèðîâàíî</td><td align=\"left\" >$itog_reg123</td></tr>";
        $ok_reg = mysql_query("select * from registr  WHERE `reg` =  '2' and `god` = '$god_site'");
        $itog_reg1 = mysql_num_rows($ok_reg);
            echo "<tr><td align=\"left\" >Ïîäòâåðæäåíî</td><td align=\"left\" >$itog_reg1</td></tr>";
            echo "<tr><td align=\"left\" >Ïîñåëåíî</td><td align=\"left\" >$itog_reg13</td></tr>";
        echo "</table>";
        echo "</div>";
    }
}

function online() {
    global $site, $sit;
    $timeonline = date("YmdHi");
    $timeonline = $timeonline - 5;
    $online = mysql_query("select * from online  WHERE `time` > $timeonline");
    $itog_reg1 = mysql_num_rows($online);
    echo "<p><a href = \"$site/online.php\">Ñåé÷àñ íà ñàéòå: $itog_reg1</a>";
    echo "<table>";
    $online1 = mysql_query("select * from online  WHERE `time` > $timeonline LIMIT 5");
    while ($online_s = mysql_fetch_array($online1)) {
        $id_us = $online_s['id_us'];
        $query = "select * From `us` where `id_us` = $id_us ";
        $result = mysql_query($query);
        while ($link = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $tip_us = "$link[tip_us]";
            $nick_us = "$link[nick_us]";
            $gorod = "$link[gorod_us]";
            if ($tip_us == "9") {
                $nick_us = "<strike>$nick_us</strike>";
            }
            $info = "<a href = \"$site/profile.php?id=$id_us\">$nick_us</a>";
            $adm = dostup_adm();
            if ($adm == 1) {
                $info = "$info <a href = \"$site/log_per.php?id=$id_us\">Ï</a>";
            }
        }
        $pict = "user/photo/$id_us.jpg";
        if (file_exists($pict)) {
            list($width, $height, $type, $attr) = getimagesize($pict);
            if ($height > $width) {
                $vis1 = height;
            } else {
                $vis1 = width;
            }
        } else {
            $pict = "../user/photo/$id_us.jpg";
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
        }
        echo "<tr><td><img src= \"$site/$pict\" $vis1=\"40\" border=\"0\" alt=\"Èíôî\" align=\"left\" ></td><td>$info<br><font color=\"#676666\">$gorod</font></td></tr>";
    }
    echo "</table>";
}

function left_block() {
    global $id_user, $site, $reg_on, $status_site;
    if (!($id_user == "")) {
        admin_menu();
        left_menu();
        opros();
        if ($status_site == "2") {
            registr();
        }
        online();
    }
}

function login() {
    global $id_user, $site, $reg_on;
    if ($id_user == "") {
        echo "
<form method=\"post\" name=\"login\" action=\"$site/login.php\">
Ëîãèí:
<input class=\"inputText\" type=\"text\" name=\"login\" id=\"login_us\" size = 25>
Ïàðîëü:
<input class=\"inputText\" type=\"password\" name=\"pass_us\" id=\"pass_us\"  size = 25>
×óæîé&nbsp;êîìïüþòåð&nbsp;<input type=\"checkbox\" name=\"aliens\">
<div style=\"height:150px;margin-top:5px;\">
<ul class='nNav' style=\"width:150px;padding:0px;margin:0px;\"><li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"javascript:document.login.submit()\">Âõîä</a></span>
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>";
        if ($reg_on == "1") {
            echo "<li style=\"margin:0px\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"$site/reg.php\">Ðåãèñòðàöèÿ</a></span>
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>";
        }
        echo "</ul>
<a href = \"$site/profile/lost.php\">Çàáûëè ïàðîëü?</a>
</div>
<input name = \"kno\" type=\"submit\" value='.' style=\"color:#fff;border:0;padding:0;margin:0;background:#fff;height:6px;width:6px\">
</form>
";
    }
}

function user_information($id_u) {
    global $site;
    $query = "select * From `us` where `id_us` = '" . $id_u . "'";
    $result = mysql_query($query);
    while ($link = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $tip_us = "$link[tip_us]";
        $nick_us = "$link[nick_us]";
        if ($tip_us == "9") {
            $nick_us = "<strike>$nick_us</strike>";
        }
        echo "<a href = \"$site/profile.php?id=$id_u\"><b>$nick_us</b></a>";
    }
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
        $info = "<a href = \"$site/profile.php?id=$id_us\">$nick_us</a>";
        $adm = dostup_adm();
        if ($adm == 1) {
            $info = "$info <a href = \"$site/log_per.php?id=$id_us\">Ï</a>";
        }
        if ($master_us == $id_user) {
            $info = "$info <a href = \"$site/log_per_pod.php?id=$id_us\">Ï</a>";
        }
        return $info;
    }
}

function user_inf($id_us) {
    global $site;
    $query = "select * From `us` where `id_us` = '" . $id_us . "'";
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

function tip($tip) {
    global $site;
    $query = "select * From `tip_mer` where `id` = $tip";
    $result = mysql_query($query);
    while ($link = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $id = "$link[id]";
        $name = "$link[name]";
        $text = "<a href = \"$site/tip.php?tip=$id\">$name</a>";
        return $text;
    }
}

function podtip($podtip) {
    global $site;
    $query = "select * From `podtip_mer` where `id` = $podtip";
    $result = mysql_query($query);
    while ($link = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $id = "$link[id]";
        $name = "$link[name]";
        $text = "<a href = \"$site/tip.php?podtip=$id\">$name</a>";
        return $text;
    }
}

function error($i) {
    global $name_us, $fam_us, $gorod_us;
    $i = intval($i);
    $ok_er = mysql_query("select * from error where id = '" . $i . "'");
    while ($t_er = mysql_fetch_array($ok_er)) {
        $text = $t_er['text'];
    }
    echo "
<div align=\"center\"><h2>Îé,îøèáî÷êà âûøëà!</h2>
Ïðè÷èíà îøèáêè:
<br><h2><font color = red>$text </font></h2>
</div>
";
}

function baner() {
    global $site;
    require_once "baners.php";
}

function mailer($to, $tit, $mess) {
    global $name_site, $sit;
    $query = "select * From `us` where `id_us` = $to";
    $result = mysql_query($query);
    while ($link = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $mail_us = "$link[mail_us]";
        $nick_us = "$link[nick_us]";
    }
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=windows-1251' . "\r\n";
    $headers .= "To: $nick_us <$mail_us>" . "\r\n";
    $headers .= "From: Àâòîèíôîðìàòîð $name_site <autobot@$sit>" . "\r\n";
    $mess = "
$mess
<p>
Ýòî ïèñüìî ñîçäàííî àâòîìàòè÷åñêè è íå òðåáóåò îòâåòà.
";
    mail($mail_us, $tit, $mess, $headers);
}

function ad_log($mess_log) {
    global $id_user;
    $date_news = date("Y-m-d H:i");
    mysql_query("insert into `log`(data,name,whot) values('$date_news', '$id_user', '$mess_log')");
}

function name_sibkon($id) {
    global $site;
    $ok_sibkon = mysql_query("SELECT * FROM `sibkon` WHERE `id` = $id");
    while ($t_sibkon = mysql_fetch_array($ok_sibkon)) {
        $id_sibkon = $t_sibkon['id_con'];
        $god = $t_sibkon['god'];
        $tema = $t_sibkon['tema'];
    }
    $name_sibkon = "<a href = \"$site/sibkon.php?id=$id\">$god: $tema</a>";
    return $name_sibkon;
}

function name_comand($id) {
    global $site;
    $ok_page = mysql_query("select * from command where id = $id");
    while ($t_page = mysql_fetch_array($ok_page)) {
        $id = $t_page['id'];
        $name = $t_page['name'];
    }
    $name_sibkon = "<a href = \"$site/command.php?id=$id\">$name</a>";
    return $name_sibkon;
}

function name_mer($id) {
    global $site;
    $ok_page = mysql_query("select * from meropriatia where id = $id");
    while ($t_page = mysql_fetch_array($ok_page)) {
        $id = $t_page['id'];
        $name = $t_page['name'];
    }
    $name_sibkon = "<a href = \"$site/mer.php?id=$id\">$name</a>";
    return $name_sibkon;
}

function name_tip($id) {
    global $site;
    $ok_page_t = mysql_query("select * from tip_mer where id = $id");
    while ($t_page_t = mysql_fetch_array($ok_page_t)) {
        $id_tip = $t_page_t['id'];
        $name_tip = $t_page_t['name'];
    }
    $name_tip = "<a href = \"$site/tip.php?id=$id\">$name_tip</a>";
    return $name_tip;
}

function name_podtip($id) {
    global $site;
    $ok_page_t = mysql_query("select * from podtip_mer where id = $id");
    while ($t_page_t = mysql_fetch_array($ok_page_t)) {
        $id_tip = $t_page_t['id'];
        $name_tip = $t_page_t['name'];
    }
    $name_tip = "<a href = \"$site/podtip.php?id=$id\">$name_tip</a>";
    return $name_tip;
}

function dostup_comand($id) {
    global $id_user;
    if (!($id_user == "")) {
        $ok_page = mysql_query("select * from comand_us where id_command = $id and id_us = $id_user");
        while ($t_page = mysql_fetch_array($ok_page)) {
            $id_us = $t_page['id_us'];
            $tip = $t_page['tip'];
        }
        $ok_page1 = mysql_query("select adm from command where id = $id");
        {
            while ($t_page1 = mysql_fetch_array($ok_page1)) {
                $adm = $t_page1['adm'];
            }
            if ($adm == "0") {
                if ($tip == "1") {
                    $master = "1";
                } else {
                    $master = "0";
                }
            } else
            if ($adm == "1") {
                if ($tip == "1" or $tip == "2") {
                    $master = "1";
                } else {
                    $master = "0";
                }
            } else {
                $master = "0";
            }
            return $master;
        }
    }
}

function dostup_comand_user($id) {
    global $id_user;
    if (!($id_user == "")) {
        $ok_page = mysql_query("select * from comand_us where id_command = $id and id_us = $id_user");
        while ($t_page = mysql_fetch_array($ok_page)) {
            $id_us = $t_page['id_us'];
        }
        if ($id_us == "") {
            $master = "0";
        } else {
            $master = "1";
        }
        return $master;
    }
}

function dostup_room_glav($id) {
    global $id_user;
    $ok_page = mysql_query("select * from room where id = $id");
    while ($t_page = mysql_fetch_array($ok_page)) {
        $id = $t_page['id'];
        $glav = $t_page['glav'];
        if ($glav == "$id_user") {
            $ok = "1";
        } else {
            $ok = "0";
        }
    }
    return $ok;
}

function dostup_room_glav_room($id) {
    global $id_user;
    $ok_page = mysql_query("select * from room_us where id_command = $id and tip = 1");
    while ($t_page = mysql_fetch_array($ok_page)) {
        $id_us = $t_page['id_us'];
        if ($id_us == "$id_user") {
            $ok = "1";
        } else {
            $ok = "0";
        }
    }
    return $ok;
}

function dostup_mer_user($id) {
    global $id_user;
    if (!($id_user == "")) {
        $ok_page = mysql_query("select * from mer_us where id_command = $id and id_us = $id_user");
        while ($t_page = mysql_fetch_array($ok_page)) {
            $id_us = $t_page['id_us'];
        }
        if ($id_us == "$id_user") {
            $master = "1";
        } else {
            $master = "0";
        }
        return $master;
    }
}

function dostup_mer_tip($id) {
    global $id_user;
    if (!($id_user == "")) {
        $ok_page = mysql_query("select * from mer_us where id_command = $id and id_us = $id_user");
        while ($t_page = mysql_fetch_array($ok_page)) {
            $tip_us = $t_page['tip'];
        }
        return $tip_us;
    }
}

function dostup_mer_adm($id) {
    global $id_user;
    $ok_page = mysql_query("select * from meropriatia where id = $id");
    while ($t_page = mysql_fetch_array($ok_page)) {
        $id = $t_page['id'];
        $uprav = $t_page['uprav'];
    }
    if (!($id_user == "")) {
        $ok_page = mysql_query("select * from mer_us where id_command = $id and id_us = $id_user");
        while ($t_page = mysql_fetch_array($ok_page)) {
            $id_us = $t_page['id_us'];
            $tip_us = $t_page['tip'];
        }
        if ($id_us == $id_user) {
            if ($uprav == "0") {
                if ($tip_us == "1") {
                    $ok = "1";
                } else {
                    $ok = "0";
                }
            } else
            if ($uprav == "1") {
                if ($tip_us == "1" or $tip_us == "2") {
                    $ok = "1";
                } else {
                    $ok = "0";
                }
            } else {
                $ok = "0";
            }
            return $ok;
        }
    }
}

function dostup_mer($id) {
    global $id_user;
    if (!($id_user == "")) {
        $ok_page_m = mysql_query("select * from meropriatia where id = $id");
        while ($t_page_m = mysql_fetch_array($ok_page_m)) {
            $zakrito = $t_page_m['zakrito'];
            if ($zakrito == "0") {
                $ok = 1;
            } else {
                $ok = dostup_mer_user($id);
            }
        }
        return $ok;
    }
}

function dostup_module_user($id_module, $pr_zap) {
    global $id_user;
    if (!($id_user == "")) {
        $ok_page = mysql_query("SELECT * FROM `module` WHERE `id` = '$id_module'");
        while ($t_page = mysql_fetch_array($ok_page)) {
            $id_modul = $t_page['id'];
            $name_modul = $t_page['name'];
            $file = $t_page['file'];
            $on = $t_page['on'];
            $forum = $t_page['forum'];
            $only_us = $t_page['only_us'];
            $table_us = $t_page['table_us'];
        }
        $ok_page = mysql_query("SELECT * FROM `$table_us` WHERE `id_us` = '$id_user' and id_command = $pr_zap");
        while ($t_page = mysql_fetch_array($ok_page)) {
            $id_us_reg = $t_page['id_us'];
        }
        $ok_page2 = mysql_query("SELECT * FROM `$file` WHERE `id` = '$pr_zap'");
        while ($t_page2 = mysql_fetch_array($ok_page2)) {
            $id_org = $t_page2['id_org'];
        }
        if ($id_us_reg == $id_user or $id_org == $id_user) {
            $master = "1";
        } else {
            $master = "0";
        }
        return $master;
    }
}

function dostup_query($id) {
    global $id_user;
    $query = mysql_query("select * from query  WHERE `id` = $id");
    while ($query_i = mysql_fetch_array($query)) {
        $id = $query_i['id'];
        $id_master = $query_i['id_master'];
        $id_us = $query_i['id_us'];
        $id_tip = $query_i['id_tip'];
        $id_mer = $query_i['id_mer'];
    }
    if ($id_master == $id_user) {
        $master = "1";
    } else
    if ($id_us == $id_user) {
        $master = "2";
    } else {
        if ($id_tip == "1") {
            $master = dostup_comand($id_mer);
        }
    }
    return $master;
}

function count_com($id) {
    global $id_user;
    if (!($id_user == "")) {
        $ok_page = mysql_query("select * from forum where id = $id");
        while ($t_page = mysql_fetch_array($ok_page)) {
            $id = $t_page['id'];
            $com_count = $t_page['com_count'];
        }
        $ok_news_nabl = mysql_query("select * from posech where id_us = $id_user and id_forum = $id");
        while ($t_news_nabl = mysql_fetch_array($ok_news_nabl)) {
            $comment = $t_news_nabl['comment'];
        }
        return $comment;
    }
}

function id_count_com($id) {
    $q = "SELECT count(*) FROM `comment` where `id_page` = $id";
    $res = mysql_query($q);
    $row = mysql_fetch_row($res);
    $total_rows = $row[0];
    $per_page = 20;
    $num_pages = ceil($total_rows / $per_page);
    $ok_com = mysql_query("select * from `comment` where `id_page` = $id");
    while ($row = mysql_fetch_array($ok_com)) {
        $id_com_zakl = $row['id_com'];
    }
    $comment = "&str=$num_pages#$id_com_zakl";
    return $comment;
}

function name_module($id_module) {
    $ok_page = mysql_query("SELECT * FROM `module` WHERE `file` = '$id_module'");
    while ($t_page = mysql_fetch_array($ok_page)) {
        $id_modul = $t_page['id'];
        $name_modul = $t_page['name'];
        $file = $t_page['file'];
        $on = $t_page['on'];
    }
    return $name_modul;
}

function name_module_id($id_module) {
    global $site;
    $ok_page = mysql_query("SELECT * FROM `module` WHERE `id` = '$id_module'");
    while ($t_page = mysql_fetch_array($ok_page)) {
        $id_modul = $t_page['id'];
        $name_modul = $t_page['name'];
        $file = $t_page['file'];
        $on = $t_page['on'];
        $name_modul = "<a href = \"$site/module/$file.php\">$name_modul</a>";
    }
    return $name_modul;
}

function test_podop($id_us) {
    global $id_user;
    $queryp = "select * From `us` where `master` = $id_user ";
    $resultp = mysql_query($queryp);
    while ($linkp = mysql_fetch_array($resultp, MYSQL_ASSOC)) {
        $master = "$linkp[master]";
    }
    if ($master == $id_user) {
        $ok = "1";
    } else {
        $ok = "0";
    }
    return $ok;
}

function getHtml($str) {
    $bb[] = "#\[b\](.*?)\[/b\]#si";
    $html[] = "<b>\\1</b>";
    $bb[] = "#\[i\](.*?)\[/i\]#si";
    $html[] = "<i>\\1</i>";
    $bb[] = "#\[u\](.*?)\[/u\]#si";
    $html[] = "<u>\\1</u>";
    $bb[] = "#\[hr\]#si";
    $html[] = "<hr>";
    $str = preg_replace($bb, $html, $str);
    $patern = "#\[url href=([^\]]*)\]([^\[]*)\[/url\]#i";
    $replace = '<a href="\\1" target="_blank" rel="nofollow">\\2</a>';
    $str = preg_replace($patern, $replace, $str); //ïðåîáðàçîâàíèå ññûëîê
    $patern = "#\[img\]([^\[]*)\[/img\]#i";
    $replace = '<img src="\\1" alt=""/>';
    $str = preg_replace($patern, $replace, $str); //ïðåîáðàçîâàíèå êàðòèíîê
    return $str;
}

function pager_post($in, $out, $text, $tip, $nit) {
    global $id_user;
    $query = "select master,nick_us From `us` where `id_us` = '" . $in . "'";
    $result = mysql_query($query);
    while ($link = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $master = "$link[master]";
        $nick_us = "$link[nick_us]";
    }
    $dat = date("Y-m-d H:i");
    if ($nit == 0) {
        mysql_query("INSERT INTO `nit` ( `id` , `id_pager` )VALUES ('', '$id_peg');");
        $nit = mysql_insert_id();
    }
    mysql_query("
INSERT INTO `pager` ( `in` , `out` , `date` , `text`, `tip`, `nit` )
VALUES (
$in, '$id_user', '$dat', '$text', '$tip', '$nit' ''
)
");
    $user = user_info($in);
    if (!($master == "0")) {
        $text = "Ñîîáùåíèå âàøåìó ïîäîïå÷íîìó $user: <br>$text";
        mysql_query("
	INSERT INTO `pager` ( `in` , `out` , `date` , `text`, `tip`, `nit` )
	VALUES (
	$master, '$id_user', '$dat', '$text', '$tip', '$nit' ''
	)
	");
    }
    $query_s = "select * From `us_config` where `id_us` = $in";
    $result_s = mysql_query($query_s);
    while ($link_s = mysql_fetch_array($result_s, MYSQL_ASSOC)) {
        $pager_on = "$link_s[pager_on]";
    }
    if ($pager_on == "") {
        $pager_on = "1";
    }
    if ($pager_on == "1") {
        $query2 = "select * From `us` where `id_us` = $id_user";
        $result2 = mysql_query($query2);
        while ($link2 = mysql_fetch_array($result2, MYSQL_ASSOC)) {
            $nick_us2 = "$link2[nick_us]";
        }
        $tit = "Cîîáùåíèå íà ïåéäæåð íà ñàéòå $name_site";
        $mess = "Âàì ïðèøëî ñîîáùåíèå íà ïåéäæåð îò ïîëüçîâàòåëÿ $nick_us2.
	<br>Òåìà ñîîáùåíèÿ: $tip
	<br>Ñîîáùåíèå: $text
	";
        mailer($in, $tit, $mess);
    }
    $d = mysql_insert_id();
    mysql_query(" UPDATE pager SET st_in = 1 WHERE `id` = '" . $id_peg . "' ");
    mysql_query(" UPDATE pager SET st_out = 1 WHERE `id` = '" . $d . "' ");
}
?>
