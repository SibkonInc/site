<?
//������ ��������
include "funycms.php";
//������� ��������
function action()
{
    menu_all();
    action_modul();
}
?>
<?
function upr()
{
    include "dos.php";
}
?>
<?
//������ ������ �����
function b()
{
    global $id_us_r, $tip_us_r;
    include "dos.php";
    if ($chenie == 1) {
        if (isset($_GET['us']))
            $us = addslashes($_GET['us']);
        else {
            $us = "$id_us_r";
        }
        if (!is_numeric($us)) {
            die("����� ������ ���!");
        }
        $us = intval($us);
        $ok_news1 = mysql_query("select nick_us from us where id_us = $us") or die("��� ����� ������");
        if (!mysql_num_rows($ok_news1)) {
            echo "��� ����� ������";
        } else {
            while ($t_news1 = mysql_fetch_array($ok_news1)) {
                $name_us_autor = $t_news1['nick_us'];
            }

            echo "<div align=/center/><h3><a href = mod.php?m=blogs>�����:</a> $name_us_autor</h3></div>";
            if (isset($_GET['str'])) {
                $str = ($_GET['str']);
            } else {
                $str = "0";
            }
            if (!is_numeric($str)) {
                die("����� ������ ���!");
            }
            $str = intval($str);
            $q = "SELECT count(*) from news where   autor_news = $us";
            $res = mysql_query($q);
            $row = mysql_fetch_row($res);
            $total_rows = $row[0];
            $per_page = 10;
            $num_pages = ceil($total_rows / $per_page);
            echo "<p align=\"center\"><div class = 'news_text'><a>��������</a>";
            for ($i = 1; $i <= $num_pages; $i++) {
                if ($str == $i) {
                    echo "<a><b>$i</b></a>";
                } else {
                    echo "<a href=mod.php?m=blogs&f=b&str=$i>$i</a>";
                }
            }
            echo "</p></div><br><br>";
            if (isset($_GET['str'])) {
                $str = ($_GET['str'] - 1);
            } else {
                $str = "0";
            }
            if (!is_numeric($str)) {
                die("����� ������ ���!");
            }
            $str = intval($str);
            $start = abs($str * $per_page);
            $ok_news = mysql_query("select * from news where  autor_news = $us order by id_news desc LIMIT $start,$per_page");
            while ($t_news = mysql_fetch_array($ok_news)) {
                $id = $t_news['id_news'];
                $date = $t_news['date_news'];
                $date = date("Y-m-d", strtotime($date));
                $date1 = format_date_html($date);
                $autor = $t_news['autor_news'];
                $name = $t_news['small_news'];
                $text = $t_news['full_news'];
                $tip = $t_news['tip_news'];
                $adm_on = $t_news['adm_on'];
                $tip_zap = $t_news['tip_zap'];
                $comment_on = $t_news['comment_on'];
                $cou = $t_news['cou'];
                $ok_news1 = mysql_query("select nick_us from us where id_us = $autor");
                while ($t_news1 = mysql_fetch_array($ok_news1)) {
                    $name_us_autor = $t_news1['nick_us'];
                }


                if ($adm_on == '2') {
                    if ($autor == "$id_us_r") {
                        $show12 = explode('<div style="page-break-after: always"><span style="DISPLAY:none">&nbsp;</span></div>',
                            $text, 2);
                        list($chast1, $chast2) = $show12;
                        if ($tip_zap == 0) {
                            $tip_zap = "�������";
                        } else
                            if ($tip_zap == 1) {
                                $tip_zap = "������ ����";
                            } else
                                if ($tip_zap == 2) {
                                    $tip_zap = "������";
                                } else {
                                    $tip_zap = "";
                                }
                                echo "
						  <div id='news'>
						  <div class = 'news_head'>
						  <div class = 'news_blok_l'><font size = 3 color=red>������ ������<a href = mod.php?m=blogs&f=p&id=$id><b>$name</b></a></font> <br><font size = 1>������������� � $tip_zap</font>
							<br>$chast1<br>";
                        if (!($chast2 == "")) {
                            echo "<font size = 2><i><a href = mod.php?m=blogs&f=p&id=$id>������ �����</a></i></font><p>";
                        }
                        $ok_news_com123 = mysql_query("select * from comment where id_page = $id");
                        while ($t_news_com123 = mysql_fetch_array($ok_news_com123)) {
                            $id_page = $t_news_com123['id_page'];
                        }
                        $itog_com123 = mysql_num_rows($ok_news_com123);
                        echo "<div class = 'news_text'><a href title='���� �������'>$date1</a>";
                        if ($autor == "$id_us_r") {
                            echo "<a href = mod.php?m=blogs&f=ed&n=$id>�������������</a>";
                            echo "<a href = mod.php?m=blogs&f=del&n=$id>�������</a>";
                        }
                        echo "</div>
							</div>
							</div>
							</div><br>";
                    }
                } else {
                    $show12 = explode('<div style="page-break-after: always"><span style="DISPLAY:none">&nbsp;</span></div>',
                        $text, 2);
                    list($chast1, $chast2) = $show12;
                    if ($tip_zap == 0) {
                        $tip_zap = "�������";
                    } else
                        if ($tip_zap == 1) {
                            $tip_zap = "������ ����";
                        } else                            if ($tip_zap == 2) {
                                $tip_zap = "������";
                            } 
                            else                             if ($tip_zap == 3) {
                                $tip_zap = "�������";
                            } 
							else if ($tip_zap == 4) {
                                $tip_zap = "�����������";
                            }
							else {
                                $tip_zap = "";
                            }
                            
							echo "
				  <div class=\"block\">
<span class=\"tleft\"></span>
<span class=\"tright\"></span>
<div class=\"blockcontent_text\">
<h3>$name</h3>
							
							<br><font size = 1>������������� � $tip_zap</font>
							<br>$chast1<br>";
                    if (!($chast2 == "")) {
                        echo "<font size = 2><i><a href = mod.php?m=blogs&f=p&id=$id>������ �����</a></i></font><p>";
                    }
                    $ok_news_com123 = mysql_query("select * from comment where id_page = $id");
                    while ($t_news_com123 = mysql_fetch_array($ok_news_com123)) {
                        $id_page = $t_news_com123['id_page'];
                    }
                    $itog_com123 = mysql_num_rows($ok_news_com123);
                    echo "<div class = 'news_text'><a href title='���� �������'>$date1</a><a href title='��������� ���'>$cou</a>";
                    $mod = "news";
                    $resul = mysql_query("select sum(oc) as summ From `plus_minus` where `mod` = '" .
                        $mod . "' and `id_s` = '" . $id . "'");
                    $summ = mysql_result($resul, 0);
                    echo "<a href title='������'>$summ</a>";
                    if ($comment_on == '1') {
                        echo "<a href = mod.php?m=blogs&f=b&id=$id#com title='�����������������'>�������������� ($itog_com123)</a>";
                    }
                    if ($autor == "$id_us_r" or $tip_us_r == "2") {
                        echo "<a href = mod.php?m=blogs&f=ed&n=$id>�������������</a>";
                        echo "<a href = mod.php?m=blogs&f=del&n=$id>�������</a>";
                    }
                    echo "</div></div>
				<span class=\"bleft\"></span>
<span class=\"bright\"></span>
				</div><br>";
                }
            }
            if (isset($_GET['str'])) {
                $str = ($_GET['str']);
            } else {
                $str = "0";
            }
            if (!is_numeric($str)) {
                die("����� ������ ���!");
            }
            $str = intval($str);
            $q = "SELECT count(*) from news where   autor_news = $us";
            $res = mysql_query($q);
            $row = mysql_fetch_row($res);
            $total_rows = $row[0];
            $per_page = 10;
            $num_pages = ceil($total_rows / $per_page);
            echo "<p align=\"center\"><div class = 'news_text'><a>��������</a>";
            for ($i = 1; $i <= $num_pages; $i++) {
                if ($str == $i) {
                    echo "<a><b>$i</b></a>";
                } else {
                    echo "<a href=mod.php?m=blogs&f=b&str=$i>$i</a>";
                }
            }
            echo "</p></div><br>";
        }
    } else {
        echo "�� �� ������ ������ � ���� ����������";
    }
}

function ad()
{
    // ����� �������
    function ad_news_form()
    {
        global $id_us_r, $tip_us_r;
        if ((!$id_us_r == "")) {
            if ($tip_us_r < "7") {
                if (isset($_GET['pr'])) {
                    $pr = addslashes($_GET['pr']);
                } else {
                    $pr = 0;
                }
                if (!is_numeric($pr)) {
                    die("����� ������ ���!");
                }
                $pr = intval($pr);

                $ok_news = mysql_query("select * from news where id_news = '" . $pr .
                    "' ");
                while ($t_news = mysql_fetch_array($ok_news)) {
                    $id = $t_news['id_news'];
                    $name = $t_news['small_news'];
                }


                $date_news = date("Y-m-d H:i:s");
                $autor_news = $id_us_r;
?>
<title>������: ���������� ������ � ����</title>
<div class="block">
<span class="tleft"></span>
<span class="tright"></span>
<div class="blockcontent_text">
<form action="" method=post>
			<p>����: <input type="text" id="example" name="date_news" value="<? echo "$date_news"; ?>">  <? echo
""; ?> ������:<select name="adm_on" size="1">
    <option selected value="0">����</option>
    <option value="2">������ ���</option>
</select></p>
        	<? if (!($pr == "")) { ?>
        	<p>��������� �<? 
			echo "$name"; ?>
			<p>��������
        	<p><input type="text" name='small_news' size="86"  rows="2" cols="87"></p>
			</p>
		    <? } else { ?>
		    <p>��������
        	<p><input type="text" name='small_news' size="86"  rows="2" cols="87"></p>
		     <? } ?>
		    <p><textarea name='full_news' rows="36" cols='96' value= $full_news></textarea></p>
		    <p><input type=checkbox name="comment_on" checked> ����������� ��������
		    <p><input type=checkbox name="mail_on"> �������� ��������� � �������������</p>
<p>����: (����������� �������) <input type="text" name='tags' ></p>
		    <input type="submit" value="���������" name="submit"> </p>
			</form>
			<p></div>
			<script type="text/javascript" src="fckeditor/fckeditor.js"></script>
    <script type="text/javascript" src="js/text.js"></script>
		</div>
				<span class="bleft"></span>
<span class="bright"></span>
				</div>
			<?
            } else {
                pages();
            }

        }
    }
    // ����� �����
    //������ �������� ����������
    function ad_news()
    {
        global $id_us_r, $tip_us_r;
        if ((!$id_us_r == "")) {
            if (isset($_GET['pr'])) {
                $pr = addslashes($_GET['pr']);
            } else {
                $pr = 0;
            }
            if (!is_numeric($pr)) {
                die("����� ������ ���!");
            }
            $pr = intval($pr);

            $ok_news = mysql_query("select * from news where id_news = '" . $pr .
                "'");
            while ($t_news = mysql_fetch_array($ok_news)) {
                $id = $t_news['id_news'];
                $name = $t_news['small_news'];
            }
            if ($pr == "") {
                $tip_news = ($_POST['tip']);
                $small_news = addslashes($_POST['small_news']);
            } else {
                $small_news1 = addslashes($_POST['small_news']);
				$tip_news = "����";
                $small_news = "$name: $small_news1";
            }
            $full_news = ($_POST['full_news']);
            $date_news = ($_POST['date_news']);
            $date_news = date("Y-m-d", strtotime($date_news));
            $date_time = date("H:i:s");
            ;
            $date_news = "$date_news $date_time";
            $autor_news = $id_us_r;
            $tags = ($_POST['tags']);		
			
			$comment_on = ($_POST['comment_on']);
            $mail_on = ($_POST['mail_on']);
            $adm_on = ($_POST['adm_on']);
            $tip_zap = '1';
            if ($comment_on == "on") {
                $comment_on = 1;
            } else {
                $comment_on = 0;
            }
            ;
            if ($mail_on == "on") {
                $mail_on = 1;
            } else {
                $mail_on = 0;
            }
            ;
            if ($tip_news == "") {
                $tip_news = "1";
            }
            if ($pr == "") {
                mysql_query("insert into `news`(tip_news,small_news,full_news,date_news,autor_news,comment_on,mail_on,adm_on,tags,tip_zap) values('$tip_news', '$small_news', '$full_news' , '$date_news', '$autor_news', '$comment_on', '$mail_on', '$adm_on', '$tags', '$tip_zap')");
            } else {
                mysql_query("insert into `news`(tip_news,small_news,full_news,date_news,autor_news,comment_on,mail_on,adm_on,tags,tip_zap,  pr_zap ) values('$tip_news', '$small_news', '$full_news' , '$date_news', '$autor_news', '$comment_on', '$mail_on', '$adm_on', '$tags', '$tip_zap', '$pr')");
            }
            $nit = mysql_insert_id();
            $tags = ($_POST['tags']);
$tag =  preg_split('~\s*,\s*~', $tags);
for ($i=0; $i<count($tag); $i++) 

{$cur_tag = $tag[$i]; 
mysql_query("INSERT INTO `tags` (`tag` ,`id_zap` ,`mod`)VALUES ('$cur_tag', '$nit', '1');");	}
            echo "������� �� <a href = mod.php?m=blogs&f=p&id=$nit>������</a>";
            //����� �������� ����������
            //�������
        }
    }
    if (!empty($_POST['submit']))
        ad_news();
    else
        ad_news_form();
}
//����� ����������
function pages()
{
    global $id_us_r, $tip_us_r;
    include "dos.php";
    if ($chenie == 1) {
        echo "<div align=\"center\"><h3>��� �����</h3></div>";
        if (isset($_GET['str'])) {
            $str = ($_GET['str']);
        } else {
            $str = "0";
        }
        if (!is_numeric($str)) {
            die("����� ������ ���!");
        }
        $str = intval($str);
        $q = "SELECT count(*) from news where tip_zap=1";
        $res = mysql_query($q);
        $row = mysql_fetch_row($res);
        $total_rows = $row[0];
        $per_page = 10;
        $num_pages = ceil($total_rows / $per_page);
        echo "<p align=\"center\"><div class = 'news_text'><a>��������</a>";
        for ($i = 1; $i <= $num_pages; $i++) {
            if ($str == $i) {
                echo "<a><b>$i</b></a>";
            } else {
                echo "<a href=mod.php?m=blogs&str=$i>$i</a>";
            }
        }
        echo "</p></div><br>";
        if (isset($_GET['str']))
            $str = ($_GET['str'] - 1);
        else
            $str = 0;

        if (!is_numeric($str)) {
            die("����� ������ ���!");
        }
        $str = intval($str);
        $start = abs($str * $per_page);
        $ok_news = mysql_query("select * from news where tip_zap=1   order by id_news desc LIMIT $start,$per_page");
        while ($t_news = mysql_fetch_array($ok_news)) {
            $id = $t_news['id_news'];
            $date = $t_news['date_news'];
            $date1 = date("Y-m-d", strtotime($date));
            $date2 = format_date_html($date1);
            $date3 = date("H:i", strtotime($date));
            $autor = $t_news['autor_news'];
            $name = $t_news['small_news'];
            $text = $t_news['full_news'];
            $tip = $t_news['tip_news'];
            $adm_on = $t_news['adm_on'];
            $tip_zap = $t_news['tip_zap'];
            $comment_on = $t_news['comment_on'];
            $cou = $t_news['cou'];
            $com_count = $t_news['com_count'];
            $ok_news2 = mysql_query("select name_tip from tip where id_tip = $tip");

            if ($adm_on == 2) {
                if ($autor == "$id_us_r") {
                    $show12 = explode('<div style="page-break-after: always"><span style="DISPLAY:none">&nbsp;</span></div>',
                        $text, 2);
                    list($chast1, $chast2) = $show12;
                    echo "
						<div class=\"block\">
<span class=\"tleft\"></span>
<span class=\"tright\"></span>
<div class=\"blockcontent_text\">
						<font color='red' size = 3><a href = mod.php?m=blogs&f=p&id=$id><b></a>$name</b></font><br>$date1/$name_tip
						 ";
                    echo "$chast1";
                    echo "
					<div class = 'news_text'>
					<a href = mod.php?m=blogs&f=p&id=$id>������ ����� ($cou)</a>
					";
                    if ($comment_on == '1')
                        echo "<a href = mod.php?m=blogs&f=p&id=$id#com>�������������� ($com_count)</a>";
                    $mod = "news";
                    $resul = mysql_query("select sum(oc) as summ From `plus_minus` where `mod` = '" .
                        $mod . "' and `id_s` = '" . $id . "'");
                    $summ = mysql_result($resul, 0);
                    echo "$summ";
                    if ($autor == "$id_us_r" or $tip_us_r == "2") {
                        echo "<a href = mod.php?m=blogs&f=ed&n=$id>�������������</a>";
                        echo "<a href = mod.php?m=blogs&f=del&n=$id>�������</a>";

                    }
                    echo "</div></div>
				<span class=\"bleft\"></span>
<span class=\"bright\"></span>
				</div>";
                }
            } else {
                $show12 = explode('<div style="page-break-after: always"><span style="DISPLAY:none">&nbsp;</span></div>',
                    $text, 2);
                list($chast1, $chast2) = $show12;
                if ($tip_zap == 0) {
                    $tip_zap = "�������";
                } else
                    if ($tip_zap == 1) {
                        $tip_zap = "<a href = mod.php?m=blogs&f=b&us=$autor>������ ����</a>";
                    } else {
                        $tip_zap = "";
                    }
                    echo " <p>
				  <div class=\"block\">
<span class=\"tleft\"></span>
<span class=\"tright\"></span>
<div class=\"blockcontent_text\">";

                echo "<h3><a href = mod.php?m=blogs&f=p&id=$id>$name</a></h3>";


                echo "<div class = 'text'>$chast1</div>";
                if (!($chast2 == "")) {
                    echo "<font size = 2><i><a href = mod.php?m=blogs&f=p&id=$id>������ �����</a></i></font><p>";
                }
                $ok_news_com123 = mysql_query("select * from comment where id_page = $id");

                echo "<div class = 'news_text'>";
                user_info($autor);
                echo "<a href title='���� �������'>$date2 ($date3)</a><a href title='��������� ���'>$cou</a>";
                $mod = "blogs";
                //$resul = mysql_query("select sum(oc) as summ From `plus_minus` where `mod` = '".$mod."' and `id_s` = '".$id."'");
                //$summ = mysql_result($resul, 0);
                //echo "<a href title='������'>$summ</a>";
                if ($comment_on == '1') {
                    echo "<a href = mod.php?m=blogs&f=p&id=$id#com title='�����������������'>�������������� ($com_count)</a>";
                }
                if ($autor == "$id_us_r" or $tip_us_r == "2") {
                    echo "<a href = mod.php?m=blogs&f=ed&n=$id>�������������</a>";
                    echo "<a href = mod.php?m=blogs&f=del&n=$id>�������</a>";

                }

                echo "</div></div>
				<span class=\"bleft\"></span>
<span class=\"bright\"></span>
				</div>";
            }
        }


    } else {
        echo "�� �� ������ ������ � ���� ����������";
    }
}
function p()
{
    global $id_us_r, $tip_us_r;
    if (isset($_GET['id'])) {
        $id = ($_GET['id']);
    } else {
        $id = "0";
    }
    if (!is_numeric($id)) {
        die("����� ������ ���!");
    }
    $id = intval($id);
    // ��������� ��������� ��������. ���� �������� ���� � ����� �� - ������ ������� �����.
    $ok_news = mysql_query("select date_izbr from izbrannoe where us_isbr = '$id_us_r' and is_st = '" .
        $id . "'") or die("��� ����� ������");
    while ($t_news = mysql_fetch_array($ok_news)) {
        echo "<br><a href = \"mod.php?m=isbr\"><img src=\"images/star_emoticon.gif\" border=\"0\"> ��� �������� � ����� ���������</a><br>";
        $dat = date("Y-m-d H:i");
        $ok_news1 = mysql_query("select com_count from news where id_news = '" . $id .
            "'");
        while ($t_news = mysql_fetch_array($ok_news1)) {
            $com_count = $t_news['com_count'];
        }
        mysql_query(" UPDATE izbrannoe SET date_izbr='$dat', com='$com_count' where is_st = '$id' and us_isbr = $id_us_r");
    }
    // ��������� ��������
    
    $ok_news = mysql_query("select * from news  where `id_news` = '" . $id . "'");
    while ($t_news = mysql_fetch_array($ok_news)) {
        $id = $t_news['id_news'];
        $date = $t_news['date_news'];
        $date = date("Y-m-d", strtotime($date));
        $date1 = format_date_html($date);
        $autor = $t_news['autor_news'];
        $name = $t_news['small_news'];
        $text = $t_news['full_news'];
        $tip = $t_news['tip_news'];
        $adm_on = $t_news['adm_on'];
        $tip_zap = $t_news['tip_zap'];
        $comment_on = $t_news['comment_on'];
        $cou = $t_news['cou'];
        $pr_zap = $t_news['pr_zap'];

        $ok_news1 = mysql_query("select nick_us from us where id_us = $autor");
        while ($t_news1 = mysql_fetch_array($ok_news1)) {
            $name_us_autor = $t_news1['nick_us'];
        }
    }
    $cou1 = $cou + 1;
    mysql_query(" UPDATE news SET cou='$cou1' where id_news = '$id'");
    if ($adm_on == 2) {
        if ($autor == "$id_us_r") {
            $show12 = explode("<!-- pagebreak -->", $text, 2);
            list($chast1, $chast2) = $show12;
            echo "
						<div id='news'>
						<div class = 'news_head'>
						<div class = 'news_blok_l'>
						<font color='red' size = 3><a href = mod.php?m=blogs&f=b&id=$id><b></a>$name</b></font><br>$date1/$name_tip
						 ";
            echo "$chast1";
            $ok_news_com123 = mysql_query("select * from comment where id_page = $id");
            while ($t_news_com123 = mysql_fetch_array($ok_news_com123)) {
                $id_page = $t_news_com123['id_page'];
            }
            $itog_com123 = mysql_num_rows($ok_news_com123);
            echo "
					<div class = 'news_text'>
									";


            if ($autor == "$id_us_r") {
                echo "<a href = mod.php?m=blogs&f=ed&n=$id>�������������</a>";
                echo "<a href = mod.php?m=blogs&f=del&n=$id>�������</a>";
            }
            echo "</div></div></div></div>";
        }
    } else {
        $show12 = explode('<!-- pagebreak -->', $text, 2);
        list($chast1, $chast2) = $show12;
        if ($tip_zap == 0) {
            $tip_zap = "�������";
        } else
            if ($tip_zap == 1) {
                $tip_zap = "������ ����";
            } else {
                $tip_zap = "";
            }
            echo "
				  <div class=\"block\">
<span class=\"tleft\"></span>
<span class=\"tright\"></span>
<div class=\"blockcontent_text\">
<h3>$name</h3>";

        if ($pr_zap > "0") {
            $ok_news1 = mysql_query("select * from news  where `id_news` = '" . $pr_zap .
                "'");
            while ($t_news1 = mysql_fetch_array($ok_news1)) {
                $id1 = $t_news1['id_news'];

                $name1 = $t_news1['small_news'];

                $pr_zap1 = $t_news1['pr_zap'];
                $tip_zap1 = $t_news1['tip_zap'];

                $ok_news5 = mysql_query("select * from games where id_g = $id1");
                while ($t_news5 = mysql_fetch_array($ok_news5)) {
                    $date_in = $t_news5['date_in'];
                    $date_out = $t_news5['date_out'];
                    $date_in = date("d.m.y", strtotime($date_in));
                    $date_out = date("d.m.y", strtotime($date_out));
                    $gorod_g = $t_news5['gorod_g'];
                    $poligon_g = $t_news5['poligon_g'];
                    $mir_g = $t_news5['mir_g'];
                    $shanr_g = $t_news5['shanr_g'];
                }
                if ($date_g == "") {
                    $date_g = "�� ��������";
                }
                if ($gorod_g == "") {
                    $gorod_g = "�� ��������";
                }
                if ($poligon_g == "") {
                    $poligon_g = "�� ��������";
                }


            }

            echo "<a href = mod.php?m=games&f=p&id=$pr_zap>$name1</a>";

        }


        echo "	<br>$text<br>
					<div class = 'news_text'><a href title='���� �������'>$date1</a>";
        user_info($autor);
        echo "<a href title='��������� ���'>$cou</a>";
        $mod = "news";
        //$resul = mysql_query("select sum(oc) as summ From `plus_minus` where `mod` = '".$mod."' and `id_s` = '".$id."'");
        //$summ = mysql_result($resul, 0);
        //echo "<a href title='������'>$summ</a>";
        if ($comment_on == '1') {
            echo "<a href = mod.php?m=blogs&f=b&id=$id#com title='�����������������'>�������������� ($itog_com123)</a>";
        }
        if ($autor == "$id_us_r" or $tip_us_r == "2" or $tip_us_r == "1") {
            echo "<a href = mod.php?m=blogs&f=ed&n=$id>�������������</a>";
            echo "<a href = mod.php?m=blogs&f=del&n=$id>�������</a>";
        }
        blok_user_up();
        echo "</div>
				</div>
				<span class=\"bleft\"></span>
<span class=\"bright\"></span>
				</div>";
    }

    echo "<p>";
    $id_page = "$id";
    $name_mod = "news";
    if ($comment_on == 1) {
        echo "<div class = 'come'><b>�����������:</b>";
        include "comment.php";
        echo "</div>";
        
//���������� ��������� � ������������� ����� ���������
    //��������� ���� ������ � �������� � ����������
    if (!($id_us_r == "")) {
        $ok_news_pos = mysql_query("select date_izbr from posesh where us_isbr = '$id_us_r' and is_st = '" .
            $id . "'");

        while ($t_news_pos = mysql_fetch_array($ok_news_pos)) {
            $date_izbr_pos = $t_news_pos['date_izbr'];
        }
        if ($date_izbr_pos == "") {
            $date_news = date("Y-m-d H:i");
         
            if (isset($_GET['m']))
                $m = ($_GET['m']);
            else
                $m = 0;
            if (isset($_GET['id']))
                $id = ($_GET['id']);
            else
                $id = 0;
            if (!($id == 0)) {
                $ok_news_com123 = mysql_query("select * from comment where id_page = $id");
                while ($t_news_com123 = mysql_fetch_array($ok_news_com123)) {
                    $id_page = $t_news_com123['id_page'];
                }
                $itog_com123 = mysql_num_rows($ok_news_com123);

                mysql_query("insert into `posesh`(date_izbr,us_isbr,id_mod,is_st,com) values('$date_news', '$id_us_r', '$m', '$id', '$itog_com123')");
            }
        } else {
            $dat = date("Y-m-d H:i");
            $ok_news1 = mysql_query("select com_count from news where id_news = '" . $id .
                "'");
            while ($t_news = mysql_fetch_array($ok_news1)) {
                $com_count = $t_news['com_count'];
            }
            mysql_query(" UPDATE posesh SET date_izbr='$dat', com='$com_count' where is_st = '$id' and us_isbr = $id_us_r");
        }
    }
    //����� ����� ���������        
        
        
        
        
        
    } else {
        echo "����������� ���������.";
    }


}
function del()
{
    global $id_us_r, $tip_us_r;
    if (isset($_GET['n'])) {
        $n = addslashes($_GET['n']);
    } else {
        $n = 0;
    }
    if (!is_numeric($n)) {
        die("����� ������ ���!");
    }
    $n = intval($n);
    $query = "select autor_news From `news` where `id_news` = '" . ($_GET['n']) .
        "'";
    $result = mysql_query($query) or die("Query failed : " . mysql_error());
    while ($link = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $id_us = "$link[id_news]";
        $autor = $link['autor_news'];
    }
    if ($autor == "$id_us_r" or $tip_us_r == '2') {
        //��� � ���� �� ������� �����

?>
<CENTER>
    <H3>��������</H3>
</CENTER>
<BR><?
?>
<div style="text-align:justify;">
���� �� ������������� ������� ������� ������, �� �������������� ������� ����.</div>
<BR><BR><?
        if (isset($_GET['n'])) {
            $n = addslashes($_GET['n']);
        } else {
            $n = 0;
        }
        if (!is_numeric($n)) {
            die("����� ������ ���!");
        }
        $n = intval($n);        {
            $query = "select * From `news` where `id_news` = '" . ($_GET['n']) . "'";
            $result = mysql_query($query) or die("Query failed : " . mysql_error());
            while ($link = mysql_fetch_array($result, MYSQL_ASSOC)) {
                $id_us = "$link[id_news]";
                $small_news = "$link[small_news]";
            }
            echo "<A href=mod.php?m=blogs&f=dell&id_us=$id_us>�� ������ ������� $small_news ?";
        }
    } else {
        pages();
    }
}
function dell()
{
    global $id_us_r, $tip_us_r;
    if (isset($_GET['id_us'])) {
        $id_us = addslashes($_GET['id_us']);
    } else {
        $id_us = 0;
    }
    if (!is_numeric($id_us)) {
        die("����� ������ ���!");
    }
    $id_us = intval($id_us);
    $query = "select * From `news` where `id_news` = '" . ($_GET['id_us']) . "'";
    $result = mysql_query($query) or die("Query failed : " . mysql_error());
    while ($link = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $id_us = "$link[id_news]";
        $autor = "$link[autor_news]";
    }
    if ($autor == $id_us_r or $tip_us_r == '2') {
        if (isset($_GET['id_us'])) {
            $id_us = addslashes($_GET['id_us']);
        } else {
            $id_us = 0;
        }        {
            $us_id = ($_GET['id_us']);
            mysql_query("DELETE FROM news WHERE   id_news = '$us_id'");
            mysql_query("DELETE FROM comment WHERE   id_page = '$us_id'");
        }
        echo "<b>������ ���� �������</b><p>";
        b();
    } else {
        echo "� ��� ��� ����� ���� �������";
    }
}
function ed()
{
    //
    function ed_news_form()
    {
        global $id_us_r, $tip_us_r;
        if (isset($_GET['n'])) {
            $n = addslashes($_GET['n']);
        } else {
            $n = 0;
        }
        if (!is_numeric($n)) {
            die("����� ������ ���!");
        }
        $n = intval($n);
        $query = "select autor_news From `news` where `id_news` = '" . ($_GET['n']) .
            "'";
        $result = mysql_query($query) or die("Query failed : " . mysql_error());
        while ($link = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $autor = $link['autor_news'];
        }
        if ($autor == $id_us_r or $tip_us_r == '2' or $tip_us_r == "1") {
            if (isset($_GET['n'])) {
                $n = addslashes($_GET['n']);
            } else {
                $n = 0;
            }
            if (!is_numeric($n)) {
                die("����� ������ ���!");
            }
            $n = intval($n);
            $ok_news = mysql_query("select * from news where id_news = '" . $n . "' ");
            while ($t_news = mysql_fetch_array($ok_news)) {
                $id_news = $t_news['id_news'];
                $tip_news = $t_news['tip_news'];
                $autor = $t_news['autor_news'];
                $tags = $t_news['tags'];
                $small_news = $t_news['small_news'];
                $full_news = $t_news['full_news'];
                $date_news = $t_news['date_news'];
                $comment_on = $t_news['comment_on'];
                $mail_on = $t_news['mail_on'];
                $adm_on = $t_news['adm_on'];
            }
?>
<div class="block">
<span class="tleft"></span>
<span class="tright"></span>
<div class="blockcontent_text">
<form name="form1" method="post" action="">
    <p>����: <input type="text"  name="date_news" value="<? echo "$date_news"; ?>">
    <br><input type=checkbox name="comment_on" <? if ($comment_on == 1) {
                echo "checked";
            }
            ; ?>>����������� ��������
    <br><input type=checkbox name="mail_on" <? if ($mail_on == 1) {
                echo "checked";
            }
            ; ?>>�������� ��������� � �������������
    <br><input type=checkbox name="adm_on" <? if ($adm_on == 2) {
                echo "checked";
            }
            ; ?>>������ ��� ����
    <p>��������: <input type="text"  name='small_news' size="86" value= "<? echo
"$small_news"; ?>" rows="1" cols="87"></p>
    <p><textarea name='full_news' rows="28" cols="85" value= $full_news><? echo
"$full_news"; ?></textarea></p>
            <p>    <? echo "<input type= hidden name='id' value= $id_news>"; ?></p>
<p>����: (����������� �������) <? echo "<input type= text name='tags' value= $tags>"; ?></p>
    <p>                            <input type="submit" value="���������" name="submit"> </p>
</form><script type="text/javascript" src="fckeditor/fckeditor.js"></script>
    <script type="text/javascript" src="js/text.js"></script>
</div>
				<span class="bleft"></span>
<span class="bright"></span>
				</div><?
        } else {
            echo "<p align='center'><b>� ���� ��� ����???</b>";
        }
    }
    //
    function ed_news()
    {
        global $id_us_r, $tip_us_r;
        if (isset($_GET['n'])) {
            $n = addslashes($_GET['n']);
        } else {
            $n = 0;
        }
        $query = "select autor_news From `news` where `id_news` = '" . ($_GET['n']) .
            "'";
        $result = mysql_query($query) or die("Query failed : " . mysql_error());
        while ($link = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $autor = $link['autor_news'];
        }
        if ($autor == $id_us_r or $tip_us_r == '2' or $tip_us_r == "1") {
            $id_news = ($_POST['id']);
            $tip_news = ($_POST['tip_news']);
            $small_news = ($_POST['small_news']);
            $full_news = ($_POST['full_news']);
            $tags = ($_POST['tags']);
            
            $date_news = ($_POST['date_news']);
            $comment_on = htmlspecialchars($_POST['comment_on'], ENT_QUOTES);
            ;
            $mail_on = htmlspecialchars($_POST['mail_on'], ENT_QUOTES);
            ;
            $adm_on = htmlspecialchars($_POST['adm_on'], ENT_QUOTES);
            ;
            if ($comment_on == "on") {
                $comment_on = 1;
            } else {
                $comment_on = 0;
            }
            ;
            if ($mail_on == "on") {
                $mail_on = 1;
            } else {
                $mail_on = 0;
            }
            ;
            if ($adm_on == "on") {
                $adm_on = 2;
            } else {
                $adm_on = 0;
            }
            ;
            mysql_query(" UPDATE news SET adm_on='$adm_on',comment_on='$comment_on', mail_on='$mail_on', tip_news='$tip_news', small_news='$small_news', full_news='$full_news', date_news='$date_news', tags='$tags' where id_news = '$id_news'");
            mail_ed_news($id_us, $id_us_r, $tip);
          
		  
	mysql_query("DELETE FROM tags WHERE   id_zap = '$id_news'");	  
		  
		  
		  
		    $tags = ($_POST['tags']);
$tag =  preg_split('~\s*,\s*~', $tags);
for ($i=0; $i<count($tag); $i++) 

{$cur_tag = $tag[$i]; 
mysql_query("INSERT INTO `tags` (`tag` ,`id_zap` ,`mod`)VALUES ('$cur_tag', '$id_news', '1');");	}
        }
        echo "������ ���� ����������. <a href = mod.php?m=blogs>������� �� �����</a> ��� � <a href = mod.php?m=blogs&f=p&id=$id_news>������������ ������</a>?";
    }
    //
    if (!empty($_POST['submit']))
        ed_news();
    else
        ed_news_form();
}
//����� ��������������
// ���������� ���������
require ("$theme_patch/$theme.htm");
?>