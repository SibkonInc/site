<?php
/**
 * @author Yerick
 * @copyright 2009
 * @name YCMS 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
function glav()
{
    global $id_user;
    $adm = dostup_adm();
    $org = dostup_org();
    if ($adm == "1" or $org == "1") {
        echo "�� ���������� � ���������������� ���� �����. � ������ ���� ����� ������ �������������� �����, ������������ ������ �� ��������� ��������, ������������ �������� �������. 
        <p><i>����������. � ������, ��� ������� � ����� �������� ������ ������� <a href = \"about.php\">�����</a>.</i></p>
       	<ul>
		<li>���������� ���������. ������ - �������� ������� (����, �������, �����������, � �.�, ����� - ������ ������), ������������ � ���� ��� ���������. ������� ������ � ������, ���������� �������� ����, ���, ��������, �������������  - �� ������� ��������� ���� ������ �������. ������  - ������ ��������������� �����, � ����� ����� ���������� ��������. �������������� ��������� ������ � �������, �� ������� ������� �������� (���������) � �������� ����.</li>
<li> ���������� �����������. ��������� � �������� - �������� ��������, ������� ��������� � ����������� �������. ��� ����� ���� ������� ����������, ����� �������, ����� ����������, �����  ������ ����������. ������  - ������ ��������������� � ����� ����������� �������.</li>
<li>������ - ������������ �������. ��� ���� ���������� � ������ ������� �����������, ���� ������ �������, ������ ���� ��� ������� �������. ��������������� ��������� ������ ��� ������ ������������, �� ������������� ������ �����������. � ������� �������� ������������ �������������� ����������, ������� �������. ���������\���������\ ������ �� ������������ ����������� �������������, ��������\�������� ������ � ���������� � �����������. � ������ ����������� �������, ���������� �� ������ ������� �����������, ���� ������. ������  - ������ � ��������������� � ����� ����������� �������.</li>
<li>���������� ������. ���� ����� � �� �������.  ������ ����������� �� ����, �������� ����� ������������ � ���� �� ����� ������ �������. ������ ����� ����� �������, ������������ �� ��� ����� ���������. ������� - �������������� ������� � �� ����������� ����� �����, ������ ������ ��� ���������. ������  - ������ � ��������������� � ����� ��� ����������� �� �������. </li>
<li>���������� ���������. ������� - ����� ���������� ����������. ���������������, ��� � ������ ������� ����������� �������, ���������� �� ���� ������� � ������� ���� ���������� ��� ���������.  ������  - ������ � ��������������� � ����� ����������� �������.</li>
<li>���� �������� - ������ ����� ��������. ������ � ������ ��������������� � ����� �������� �������. </li>
<li>���������� ������ - ����������� �������� ���������� (��������, ������, ��� ��������� �������, ���� ����������, ��������� ����������� �� ������� � �.�). ������ - ������ ��������������� �����</li>
<li>���������� ���������� � �������������� ���������� �������, �� ������� ��������� � ���������� ��������, ������������� �� ������������ � ����. �������� ��������� ����������, ���� ����������, �� ����������� � �������� �������. ������  - ������ ��������������� ����� � ����� �������� �������.</li>
<li>���������� ���������. ������  - ������ ��������������� � ������������� �������� �������.</li>
<li>���������� ��������. ����� ������������ ��������� ������, �� �������� � ����� ����, �� ��������� � ���.</li>
<li>���������� � �������� �������. ���������������, ��� ������ ������, ��� ����������� ������ ��� ���� ���������� � ������ � ����������, ���� ��� ������������ ������ �����������, ����� ������������ ������ ����������, ����������� ��� ������ ������. ������ ����� ���� ��� ������������ �������, ����������� �� �������� ���������� ������������ ��������, ���� ����������� ����� ������������� ��� ��������� ������.</li>
<li>���������� ����������. ���������������, ��� ������ �������� ����� ���������� � ������������ �������, ���� �� ������ ��� �������. ����� ������� ����� ����� ����� ����������������� ���� ��� ����� ���������.</li>
<li>���� - �������� �������� ������������ �� �����, ��������� � ���������� ������ ����������� �����. �� ����������� ������ � �����������. ������  - ������ � ��������������� � ����� �������� �������</li>
</ul>
";
    }
}
//���������� ������
function site()
{
    global $id_user;
    $adm = dostup_adm();
    if ($adm == 1) {
        if (isset($_GET['ok'])) {
            $ok = addslashes($_GET['ok']);
        }
        $ok = intval($ok);
        echo "<div align=\"center\"><h3>���������� ������</h3></div>";
        if ($ok == "1") {
            echo "<div align=\"center\"><font color = red><h4>������ ���� ��������</h4></div>";
        }
        $site_info = mysql_query("select * from setting_site");
        if (!mysql_num_rows($site_info))
            die("������ � ����� �� ��������.");
        else {
            while ($site_i = mysql_fetch_array($site_info)) {
                $id_site = $site_i['id'];
                $name_site = $site_i['name_site'];
                $status_site = $site_i['status_site'];
                $god = $site_i['god'];
                $status_text = $site_i['status_text'];
                $theme = $site_i['theme'];
                $reg = $site_i['reg'];
                $reg_text = $site_i['reg_text'];
                $st_glav = $site_i['st_glav'];
                $menu = $site_i['menu'];
                $arhiv = $site_i['arhiv'];
                $forum = $site_i['forum'];
                $module = $site_i['module'];
                $name_group = $site_i['name_group'];
                $pp = $site_i['pp'];
                $mail_adm = $site_i['mail_adm'];
                $oth_on = $site_i['oth_on'];
                $oth_ob = $site_i['oth_ob'];
                $god_on = $site_i['god_on'];
                $god_ob = $site_i['god_ob'];
                $pass_on = $site_i['pass_on'];
                $pass_ob = $site_i['pass_ob'];
                $telefon_on = $site_i['telefon_on'];
                $telefon_ob = $site_i['telefon_ob'];
                $osebe_on = $site_i['osebe_on'];
                $osebe_ob = $site_i['osebe_ob'];
                $contact_on = $site_i['contact_on'];
                $contact_ob = $site_i['contact_ob'];
                $interest_on = $site_i['interest_on'];
                $interest_ob = $site_i['interest_ob'];
                $otv_pos = $site_i['otv_pos'];
                $shema = $site_i['shema'];
            }
        }
        echo "
<form name=\"form\" method=\"post\" action=\"/admin/edit_site.php?id=$id_site\">
<table>
<tr><td><LABEL for=\"name\">�������� �����:</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=name_site&amp;width=375\" class=\"jTip\" id=\"one\" name=\"�������� �����\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"����������\"></a></span></td><td><input type=\"text\"  name='name_site' id = \"name\" size=\"60\" value= \"$name_site\" ></td></tr>
<tr><td><LABEL for=\"name\">�������� �����:</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=name_group&amp;width=375\" class=\"jTip\" id=\"onegr\" name=\"�������� �����\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"����������\"></a></span></td><td><input type=\"text\"  name='name_group' id = \"name_group\" size=\"60\" value= \"$name_group\" ></td></tr>
<tr><td><LABEL for=\"status_site\">������ �����:</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=status&amp;width=375\" class=\"jTip\" id=\"two\" name=\"������ �����\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"����������\"></a></span></td><td>
	<SELECT NAME=\"status_site\" SIZE=\"1\" id = \"status_site\">
	<OPTION VALUE=\"0\"";
        if ($status_site == "0")
            echo "SELECTED";
        echo ">���� ������</OPTION>
	<OPTION VALUE=\"1\"";
        if ($status_site == "1")
            echo "SELECTED";
        echo ">����� ���������</OPTION>
        	<OPTION VALUE=\"2\"";
        if ($status_site == "2")
            echo "SELECTED";
        echo ">������ �������</OPTION>
	</select></td></tr>
<tr><td><LABEL for=\"reg\">������� ��������</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=st&amp;width=375\" class=\"jTip\" id=\"s\" name=\"������� ��������\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"����������\"></a></span></td><td>
	<SELECT NAME=\"st_glav\" SIZE=\"1\" id = \"menu\">";
        $ok_page = mysql_query("select * from page ");        {
            while ($t_page = mysql_fetch_array($ok_page)) {
                $page = $t_page['id_page'];
                $text = $t_page['text'];
                $nazvanie = $t_page['nazvanie'];
                echo "
	<OPTION VALUE=\"$page\"";
                if ($st_glav == "$page")
                    echo "SELECTED";
                echo ">$nazvanie</OPTION>";
            }
            echo "
	<OPTION VALUE=\"news\"";
            if ($st_glav == "news")
                echo "SELECTED";
            echo ">��������� �����</OPTION>";
            echo "
	<OPTION VALUE=\"anons\"";
            if ($st_glav == "anons")
                echo "SELECTED";
            echo ">����� �������</OPTION>";
        }
        echo "
	</select></td></tr>
<tr><td><LABEL for=\"god\">��� ����������</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=god&amp;width=375\" class=\"jTip\" id=\"tri\" name=\"��� ����������\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"����������\"></a></span></td><td>

<SELECT NAME=\"god\" SIZE=\"1\" id = \"menu\">";
        $ok_page = mysql_query("select * from sibkon order by god desc");        {
            while ($t_page = mysql_fetch_array($ok_page)) {
                $god_p = $t_page['god'];
                $name_p = $t_page['tema'];
                echo "
	<OPTION VALUE=\"$god_p\"";
                if ($god == "$god_p")
                    echo "SELECTED";
                echo ">$god_p: $name_p</OPTION>";
            }
        }
        echo "
	</select></td></tr>
<tr><td><LABEL for=\"status_text\">���������</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=status_text&amp;width=375\" class=\"jTip\" id=\"ch\" name=\"��������� ��� �������� �����.\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"����������\"></a></span></td><td><input type=\"text\"  name='status_text' id = \"status_text\"  size=\"60\" value= \"$status_text\"></td></tr>
<tr><td><LABEL for=\"theme\">����������� ����</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=theme&amp;width=375\" class=\"jTip\" id=\"p\" name=\"����������� ���� �����\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"����������\"></a></span></td><td><input type=\"text\"  name='theme' id = \"theme\"  size=\"86\" value= \"$theme\"></td></tr>
<tr><td><LABEL for=\"reg\">�����������</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=reg&amp;width=375\" class=\"jTip\" id=\"q\" name=\"����������� ������������� �� �����\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"����������\"></a></span></td><td>
	<SELECT NAME=\"reg\" SIZE=\"1\" id = \"reg\">
	<OPTION VALUE=\"1\"";
        if ($reg == "1")
            echo "SELECTED";
        echo ">��</OPTION>
	<OPTION VALUE=\"0\"";
        if ($reg == "0")
            echo "SELECTED";
        echo ">���</OPTION>
	</select></td></tr>
	
<tr><td><LABEL for=\"reg\">������� ������������� �� �����</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=pp&amp;width=375\" class=\"jTip\" id=\"pr\" name=\"������� �������������\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"����������\"></a></span></td><td>
	<SELECT NAME=\"pp\" SIZE=\"1\" id = \"menu\">";
        $ok_page = mysql_query("select * from page ");        {
            while ($t_page = mysql_fetch_array($ok_page)) {
                $page = $t_page['id_page'];
                $text = $t_page['text'];
                $nazvanie = $t_page['nazvanie'];
                echo "
	<OPTION VALUE=\"$page\"";
                if ($pp == "$page")
                    echo "SELECTED";
                echo ">$nazvanie</OPTION>";
            }
        }
        echo "
	</select></td></tr>	
	
<tr><td><LABEL for=\"reg_text\">�����</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=reg_text&amp;width=375\" class=\"jTip\" id=\"w\" name=\"����� �����������\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"����������\"></a></span></td><td><input type=\"text\"  name='reg_text' id = \"reg_text\"  size=\"86\" value= \"$reg_text\"></td></tr>
<tr><td><LABEL for=\"reg\">���� �� �����</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=menu&amp;width=375\" class=\"jTip\" id=\"me\" name=\"����\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"����������\"></a></span></td><td>
	<SELECT NAME=\"menu\" SIZE=\"1\" id = \"men\">
	<OPTION VALUE=\"0\"";
        if ($menu == "0")
            echo "SELECTED";
        echo ">������������</OPTION>
	<OPTION VALUE=\"1\"";
        if ($menu == "1")
            echo "SELECTED";
        echo ">����������</OPTION>
	</select></td></tr>
	<tr><td><LABEL for=\"reg\">�����</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=arh&amp;width=375\" class=\"jTip\" id=\"ar\" name=\"��������� ������\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"����������\"></a></span></td><td>
	<SELECT NAME=\"arhiv\" SIZE=\"1\" id = \"arhi\">
	<OPTION VALUE=\"1\"";
        if ($arhiv == "1")
            echo "SELECTED";
        echo ">��</OPTION>
	<OPTION VALUE=\"0\"";
        if ($arhiv == "0")
            echo "SELECTED";
        echo ">���</OPTION>
	</select></td></tr>
	<tr><td><LABEL for=\"reg\">�����</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=forum&amp;width=375\" class=\"jTip\" id=\"fo\" name=\"��������� ������\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"����������\"></a></span></td><td>
	<SELECT NAME=\"forum\" SIZE=\"1\" id = \"foru\">
	<OPTION VALUE=\"1\"";
        if ($forum == "1")
            echo "SELECTED";
        echo ">��</OPTION>
	<OPTION VALUE=\"0\"";
        if ($forum == "0")
            echo "SELECTED";
        echo ">���</OPTION>
	</select></td></tr>
    <tr><td><LABEL for=\"reg\">������</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=module&amp;width=375\" class=\"jTip\" id=\"fo\" name=\"��������� �������\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"����������\"></a></span></td><td>
	<SELECT NAME=\"module\" SIZE=\"1\" id = \"modu\">
	<OPTION VALUE=\"1\"";
        if ($module == "1")
            echo "SELECTED";
        echo ">��</OPTION>
	<OPTION VALUE=\"0\"";
        if ($module == "0")
            echo "SELECTED";
        echo ">���</OPTION>
	</select></td></tr>
<tr><td><LABEL for=\"reg_text\">E mail ��������������</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=mailadm&amp;width=375\" class=\"jTip\" id=\"ea\" name=\"E mail ��������������\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"����������\"></a></span></td><td><input type=\"text\"  name='mail_adm' id = \"mail_adm\"  size=\"86\" value= \"$mail_adm\"></td></tr>
<tr><td><LABEL for=\"reg_text\">������������� �� ��������</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=otv_pos&amp;width=375\" class=\"jTip\" id=\"op\" name=\"����������� �� ��������\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"����������\"></a></span></td><td><input type=\"text\"  name='otv_pos' id = \"ot_po\"  size=\"86\" value= \"$otv_pos\"></td></tr>
<tr><td><LABEL for=\"reg\">����� ������������</LABEL></td><td><span class=\"formInfo\"><a href=\"help.php?id=sh&amp;width=375\" class=\"jTip\" id=\"pr\" name=\"����� �����������\"><img src=\"$site/img/ico/info.png\" border=\"0\" alt=\"����������\"></a></span></td><td>
	<SELECT NAME=\"shema\" SIZE=\"1\" id = \"shem\">";
        
		
	 $ok_page_s = mysql_query("select * from sibkon where god = $god");
          while ($t_page_s = mysql_fetch_array($ok_page_s))
          {
            $id_s = $t_page_s['id'];
          }	
		
		$ok_page_s = mysql_query("select * from page_sibkon where id_con = $id_s and id_id = 0 order by name");
            {
              while ($t_page_s = mysql_fetch_array($ok_page_s))
              {
                $pages = $t_page_s['id'];
                $nazvanies = $t_page_s['name'];
                echo "
	<OPTION VALUE=\"$pages\"";
                if ($shema == "$pages")
                    echo "SELECTED";
                echo ">$nazvanies</OPTION>";
            }
        }
        echo "
	</select></td></tr>	
</table>
<h4>���� ��� ����������� �������������. ���� ���� �� �������, �� � �������� ��� ������������ ���� �� �����.</h4>
������������ ���� - ���, �����, ������, ���, �������, ����� ��������� ������������� � ����� ��� ������ ������.
<table>
<thead>
<tr><th><b>����</b></th><th><b>����������</b></th><th><b>������������</b></th><th></th></tr>
</thead>
<tbody>
<tr><td>��������</td><td><input type=\"checkbox\" name = \"oth_on\"";
        if ($oth_on == "1") {
            echo "checked=\"checked\"";
        }
        echo "></td><td><input type=\"checkbox\" name = \"oth_ob\" ";
        if ($oth_ob == "1") {
            echo "checked=\"checked\"";
        }
        echo " ></td></tr>
<tr><td>��� ��������</td><td><input type=\"checkbox\" name = \"god_on\" ";
        if ($god_on == "1") {
            echo "checked=\"checked\"";
        }
        echo "></td><td><input type=\"checkbox\" name = \"god_ob\" ";
        if ($god_ob == "1") {
            echo "checked=\"checked\"";
        }
        echo "></td></tr>
<tr><td>������ ��������</td><td><input type=\"checkbox\" name = \"pass_on\" ";
        if ($pass_on == "1") {
            echo "checked=\"checked\"";
        }
        echo "></td><td><input type=\"checkbox\" name = \"pass_ob\" ";
        if ($pass_ob == "1") {
            echo "checked=\"checked\"";
        }
        echo "></td></tr>
<tr><td>�������</td><td><input type=\"checkbox\" name = \"telefon_on\" ";
        if ($telefon_on == "1") {
            echo "checked=\"checked\"";
        }
        echo "></td><td><input type=\"checkbox\" name = \"telefon_ob\" ";
        if ($telefon_ob == "1") {
            echo "checked=\"checked\"";
        }
        echo "></td></tr>
<tr><td>� ����</td><td><input type=\"checkbox\" name = \"osebe_on\" ";
        if ($osebe_on == "1") {
            echo "checked=\"checked\"";
        }
        echo "></td><td><input type=\"checkbox\" name = \"osebe_ob\" ";
        if ($osebe_ob == "1") {
            echo "checked=\"checked\"";
        }
        echo "></td></tr>
<tr><td>��������� ����������</td><td><input type=\"checkbox\" name = \"contact_on\" ";
        if ($contact_on == "1") {
            echo "checked=\"checked\"";
        }
        echo "></td><td><input type=\"checkbox\" name = \"contact_ob\" ";
        if ($contact_ob == "1") {
            echo "checked=\"checked\"";
        }
        echo "></td></tr>
<tr><td>��������</td><td><input type=\"checkbox\" name = \"interest_on\" ";
        if ($interest_on == "1") {
            echo "checked=\"checked\"";
        }
        echo "></td><td><input type=\"checkbox\" name = \"interest_ob\" ";
        if ($interest_ob == "1") {
            echo "checked=\"checked\"";
        }
        echo "></td></tr>
</tbody>        
</table>
	<div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"javascript:document.form.submit()\">�������� ������</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div>
<p> <input name = \"kno\" type=\"submit\" value='.' style=\"color:#fff;border:0;padding:0;margin:0;background:#fff;height:6px;width:6px\">                           
</form>

";
    } else {
        error(7);
    }
}
//���������� ����������
function pages()
{
    global $id_user, $god_site;
    $adm = dostup_adm();
    $god_org = dostup_org_god($god_site);
    if ($adm == 1 or $god_org == 1) {
        echo "<div align=\"center\"><h3>���������� ����������</h3></div>
		<a href = \"$site/page/ad.php\">�������� ��������</a>
		<table>";
        $ok_page = mysql_query("select * from page ");        {
            while ($t_page = mysql_fetch_array($ok_page)) {
                $page = $t_page['id_page'];
                $text = $t_page['text'];
                $nazvanie = $t_page['nazvanie'];
                echo "<tr><td><a href = \"$site/?id=$page\">$nazvanie</a></td><td><a href = \"$site/page/edit.php?id=$page\"><img src=\"$site/img/ico/file_edit.png\" border=\"0\" alt=\"�������������\"></a></td><td> <a href=\"$site/page/del.php?id=$page\" rel=\"facebox\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"�������\"></a></td></tr>";
            }
        }
        echo "</table>";
    } else {
        error(7);
    }
}
//���������� ���������
function news()
{
    global $id_user, $god_site;
    $adm = dostup_adm();
    $god_org = dostup_org_god($god_site);
    if ($adm == 1 or $god_org == 1) {
        echo "<div align=\"center\"><h3>���������� ���������</h3></div><a href = \"$site/news/ad.php\">�������� �������</a><table>";
        $ok_page = mysql_query("select * from news order by id_news desc");        {
            while ($t_page = mysql_fetch_array($ok_page)) {
                $id_news = $t_page['id_news'];
                $name_news = $t_page['small_news'];
                $date_news = $t_page['date_news'];
                $date_news = date("d.m.y", strtotime($date_news));
                echo "<tr><td>$date_news</td><td><a href = \"$site/news.php?id=$id_news\">$name_news</a></td><td><a href = \"$site/news/edit.php?id=$id_news\"><img src=\"$site/img/ico/file_edit.png\" border=\"0\" alt=\"�������������\"></a></td><td> <a href=\"$site/news/del.php?id=$id_news\" rel=\"facebox\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"�������\"></a></td></tr>";
            }
        }
        echo "</table>";
    } else {
        error(7);
    }
}
//���������� ������
function logi()
{
    global $id_user, $god_site;
    $adm = dostup_adm();
    $god_org = dostup_org_god($god_site);
    if ($adm == 1 or $god_org == 1) {
        if (isset($_GET['us'])) {
            $us = addslashes($_GET['us']);
        } else {
            $us = 0;
        }
        if (!is_numeric($us)) {
            die("����� ������ ���!");
        }
        $us = intval($us);
        if (isset($_GET['str'])) {
            $str = ($_GET['str']);
        } else {
            $str = "0";
        }
        $str = intval($str);
        if ($us == "0") {
            $q = "SELECT count(*) FROM `log`";
            $ok_page = mysql_query("select * from log order by data desc LIMIT $start,$per_page");
            echo "<div align=\"center\"><h3>�������� ����� ������������</h3></div>";
        } else {
            $q = "SELECT count(*) FROM `log` where name = $us";
            $ok_page = mysql_query("select * from log where name = $us order by data desc LIMIT $start,$per_page");
            echo "<div align=\"center\"><h3>�������� ����� ������������ ";
            user_information($us);
            echo "</h3></div>";
        }
        echo "<div class = \"str\">";
        $res = mysql_query($q);
        $row = mysql_fetch_row($res);
        $total_rows = $row[0];
        $per_page = 40;
        $num_pages = ceil($total_rows / $per_page);
        for ($i = 1; $i <= $num_pages; $i++) {
            if ($str == $i) {
                echo "<b>$i</b>";
            } else {
                if ($us == "0") {
                    echo "<a href=\"$site/admin.php?id=5&str=$i\">$i</a>";
                } else {
                    echo "<a href=\"$site/admin.php?id=5&us=$us&str=$i\">$i</a>";
                }
            }
        }
        echo "</div>";
        if (isset($_GET['st'])) {
            $st = addslashes($_GET['st']);
        } else {
            $st = "";
        }
        if (isset($_GET['str']))
            $str = ($_GET['str'] - 1);
        else
            $str = 0;
        $str = intval($str);
        $start = abs($str * $per_page);
        if ($us == "0") {
            $ok_page = mysql_query("select * from log order by data desc LIMIT $start,$per_page");
        } else {
            $ok_page = mysql_query("select * from log where name = $us order by data desc LIMIT $start,$per_page");
        }
        echo "<table>";        {
            while ($t_page = mysql_fetch_array($ok_page)) {
                $id = $t_page['id'];
                $name = $t_page['name'];
                $date_news = $t_page['data'];
                $date_com = date("d.m.y", strtotime($date_news));
                $time_com = time_zone($date_news);
                $date_com = date("Y-m-d", strtotime($date_news));
                $date_com = format_date_html($date_com);
                $whot = $t_page['whot'];
                echo "<tr><td>$date_com $time_com</td><td>";
                user_information($name);
                echo "</td><td>$whot</td></tr>";
            }
        }
        echo "</table>";
    } else {
        error(7);
    }
}
function tender_mer()
{
    global $id_user, $god_site;
    $adm = dostup_adm();
    $god_org = dostup_org_god($god_site);
    if ($adm == 1 or $god_org == 1) {
        echo "<div align=\"center\"><h3>����������.</h3></div>";
        $ok_page = mysql_query("select * from sibkon where god = $god_site");
        while ($t_page = mysql_fetch_array($ok_page)) {
            $id_con = $t_page['id'];
        }
        $ok_page_m = mysql_query("select * from meropriatia where id_con = $id_con");
        while ($t_page_m = mysql_fetch_array($ok_page_m)) {
            $id_m = $t_page_m['id'];
            $id_con_m = $t_page_m['id_con'];
            $tip_con_m = $t_page_m['tip'];
            $name_mer = name_mer($id_m);
            $tender = nl2br($t_page_m['tender']);
            echo "$name_mer<p>$tender</p>";
        }
    } else {
        error(7);
    }
}
//���������� ���������
function konvent()
{
    echo "<div align=\"center\"><h3>���������� ���������</h3></div><table>";
    global $id_user, $god_site;
    $adm = dostup_adm();
    $org = dostup_org();
    if ($adm == 1) {
        echo "<a href = \"$site/sibkon/ad.php\">�������� ������</a>";
    }
    if ($adm == "1" or $org == "1") {
        $ok_page = mysql_query("select * from sibkon order by god desc");        {
            while ($t_page = mysql_fetch_array($ok_page)) {
                $id_con = $t_page['id'];
                $god = $t_page['god'];
                $tema = $t_page['tema'];
                echo "<tr><td>$god</td><td><a href = \"$site/sibkon.php?id=$god\">$tema</a></td>";
                $ok_tip = mysql_query("SELECT * FROM org where id_org = $id_user and god = $god");
                while ($t_tip = mysql_fetch_array($ok_tip)) {
                    $id_o = $t_tip['id'];
                    $id_org = $t_tip['id_org'];
                    $god = $t_tip['god'];
                }
                if ($id_org == $id_user or $adm == 1) {
                    echo "<td><a href = \"$site/sibkon/edit.php?id=$id_con\"><img src=\"$site/img/ico/file_edit.png\" border=\"0\" alt=\"�������������\"></a></td><td> <a href=\"$site/sibkon/del.php?id=$id_con\" rel=\"facebox\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"�������\"></a></td>";
                } else {
                    echo "<td></td><td></td>";
                }
                echo "</tr>";
                $id_org = "0";
            }
        }
        echo "</table><p>";
    } else {
        error(7);
    }
}
//���������� �����������
function mat()
{
    if (isset($_GET['god'])) {
        $g = addslashes($_GET['god']);
    } else {
        $g = 0;
    }
    if (!is_numeric($g)) {
        die("����� ������ ���!");
    }
    $g = intval($g);
    echo "<div align=\"center\"><h3>���������� �����������</h3></div>";
	echo "<div align=\"center\"><h4>��������� ���������</h4></div>";
    global $id_user, $god_site;
    $adm = dostup_adm();
    $org = dostup_org();
    if ($adm == 1 or $org == 1) {
        echo "<div align=\"center\">";
		
		// ������ ��������� ����������
		echo "<table>";
                $ok_page = mysql_query("select * from page_sibkon where allyears = '1'");
                while ($t_page = mysql_fetch_array($ok_page)) {
                    $name = $t_page['name'];
                    $id_post = $t_page['id'];
                    echo "<tr><td align=left><a href = \"$site/page_sibkon.php?id=$id_post\">$name</a></td>";
                    $ok_tip = mysql_query("SELECT * FROM org where id_org = $id_user and god = $god");
                    while ($t_tip = mysql_fetch_array($ok_tip)) {
                        $id_o = $t_tip['id'];
                        $id_org = $t_tip['id_org'];
                        $god = $t_tip['god'];
                    }
                    if ($id_org == $id_user or $adm == 1) {
                        echo "<td><a href = \"$site/page_sibkon/edit.php?id=$id_post\"><img src=\"$site/img/ico/file_edit.png\" border=\"0\" alt=\"�������������\"></a></td><td> <a href=\"$site/page_sibkon/del.php?id=$id_post\" rel=\"facebox\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"�������\"></a></td></tr>";
                    } else {
                    }
                    $id_org = "0";
                }
		echo "</table><br>";            
        echo "<div align=\"center\"><h4>��������� ���������</h4></div>";
		// ����� ������ ��������� ����������
        $ok_god = mysql_query("select * from sibkon order by god desc");
        while ($t_god = mysql_fetch_array($ok_god)) {
            $god = $t_god['god'];
            echo "<a href=\"$site/admin.php?id=7&amp;god=$god\">$god</a> | ";
        }
        if ($g == "") {
            $ok_page1 = mysql_query("select * from sibkon order by god desc");
        } else {
            $ok_page1 = mysql_query("select * from sibkon where god = $g");
        }
        echo "</div>";
        echo "<table>";
        while ($t_page1 = mysql_fetch_array($ok_page1)) {
            $god = $t_page1['god'];
            $id1 = $t_page1['id'];            {
                $ok_page = mysql_query("select * from page_sibkon where id_con = $id1 and allyears = 0");
                while ($t_page = mysql_fetch_array($ok_page)) {
                    $name = $t_page['name'];
                    $id_post = $t_page['id'];
                    echo "<tr><td>$god</td><td><a href = \"$site/page_sibkon.php?id=$id_post\">$name</a></td>";
                    $ok_tip = mysql_query("SELECT * FROM org where id_org = $id_user and god = $god");
                    while ($t_tip = mysql_fetch_array($ok_tip)) {
                        $id_o = $t_tip['id'];
                        $id_org = $t_tip['id_org'];
                        $god = $t_tip['god'];
                    }
                    if ($id_org == $id_user or $adm == 1) {
                        echo "<td><a href = \"$site/page_sibkon/edit.php?id=$id_post\"><img src=\"$site/img/ico/file_edit.png\" border=\"0\" alt=\"�������������\"></a></td><td> <a href=\"$site/page_sibkon/del.php?id=$id_post\" rel=\"facebox\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"�������\"></a></td></tr>";
                    } else {
                        echo "<td></td><td></td>";
                    }
                    echo "</tr>";
                    $id_org = "0";
                }
            }
        }
        if ($g == "") {
            echo "</table><p>�������� ����������� ������ �� �������� ������������� �������. �������� ������ �� ������ ������ ��������.";
        } else {
            echo "</table>";
            $ok_tip = mysql_query("SELECT * FROM org where id_org = $id_user and god = $god");
            while ($t_tip = mysql_fetch_array($ok_tip)) {
                $id_o = $t_tip['id'];
                $ras = $t_tip['id_org'];
                $god = $t_tip['god'];
            }
            if ($ras == $id_user or $adm == 1) {
                echo "<p><a href = \"$site/page_sibkon/ad.php?id=$id1\">�������� ��������</a>";
            }
        }
    } else {
        error(7);
    }
}
//���������� ��������
function mer()
{
    global $name_group;
    if (isset($_GET['god'])) {
        $g = addslashes($_GET['god']);
    } else {
        $g = 0;
    }
    if (!is_numeric($g)) {
        die("����� ������ ���!");
    }
    $g = intval($g);
    echo "<div align=\"center\"><h3>���������� �������� ($name_group)</h3></div>������ - ������������ �������. ��� ���� ���������� � ������ ������� �����������, ���� ������ �������, ������ ���� ��� ������� �������. ";
    global $id_user, $god_site;
    $adm = dostup_adm();
    $org = dostup_org();
    if ($adm == 1 or $org == 1) {
        echo "<div align=\"center\">";
        $ok_god = mysql_query("select * from sibkon order by god desc");
        while ($t_god = mysql_fetch_array($ok_god)) {
            $god = $t_god['god'];
            echo "<a href=\"$site/admin.php?id=8&amp;god=$god\">$god</a> | ";
        }
        if ($g == "") {
            $ok_page1 = mysql_query("select * from sibkon order by god desc");
        } else {
            $ok_page1 = mysql_query("select * from sibkon where god = $g");
        }
        echo "</div><table>";
        while ($t_page1 = mysql_fetch_array($ok_page1)) {
            $god = $t_page1['god'];
            $id1 = $t_page1['id'];            {
                $ok_page = mysql_query("select * from meropriatia where id_con = $id1 order by tip desc");
                while ($t_page = mysql_fetch_array($ok_page)) {
                    $name = $t_page['name'];
                    $id_post = $t_page['id'];
                    $tip = $t_page['tip'];
                    $query = "select * From `tip_mer` where `id` = $tip";
                    $result = mysql_query($query);
                    while ($link = mysql_fetch_array($result, MYSQL_ASSOC)) {
                        $id_tip = "$link[id]";
                        $name_tip = "$link[name]";
                    }
                    echo "<tr><td><a href = \"$site/admin.php?id=9&amp;tip=$id_tip\">$name_tip</a></td><td><a href = \"$site/mer.php?id=$id_post\">$name</a></td>";
                    $ok_tip = mysql_query("SELECT * FROM org where id_org = $id_user and god = $god");
                    while ($t_tip = mysql_fetch_array($ok_tip)) {
                        $id_o = $t_tip['id'];
                        $id_org = $t_tip['id_org'];
                        $god = $t_tip['god'];
                    }
                    if ($id_org == $id_user or $adm == 1) {
                        echo "<td><a href = \"$site/mer/edit.php?id=$id_post\"><img src=\"$site/img/ico/file_edit.png\" border=\"0\" alt=\"�������������\"></a></td><td> <a href=\"$site/mer/del.php?id=$id_post\" rel=\"facebox\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"�������\"></a></td></tr>";
                    } else {
                        echo "<td></td><td></td>";
                    }
                    echo "</tr>";
                    $id_org = "0";
                }
            }
        }
        if ($g == "") {
            echo "</table><p>������ ����������� ������ �� �������� ������������� �������. �������� ����������� ������ ������ ��������.";
        } else {
            echo "</table>";
            $ok_tip = mysql_query("SELECT * FROM org where id_org = $id_user and god = $god");
            while ($t_tip = mysql_fetch_array($ok_tip)) {
                $id_o = $t_tip['id'];
                $ras = $t_tip['id_org'];
                $god = $t_tip['god'];
            }
            if ($ras == $id_user or $adm == 1) {
                echo "<p><a href = \"$site/mer/ad.php?id=$id1\">�������� ������</a>";
            }
        }
    } else {
        error(7);
    }
}
//���������� ������ �������������
function tipmer()
{
    $adm = dostup_adm();
    $org = dostup_org();
    if ($adm == 1 or $org == 1) {
        if (isset($_GET['god'])) {
            $g = addslashes($_GET['god']);
        } else {
            $g = 0;
        }
        if (!is_numeric($g)) {
            die("����� ������ ���!");
        }
        $g = intval($g);
        echo "<div align=\"center\"><h3>���������� ������</h3></div>";
        echo "<table>";
        $ok_tip = mysql_query("SELECT * FROM tip_mer");
        while ($t_tip = mysql_fetch_array($ok_tip)) {
            $id_tip = $t_tip['id'];
            $name_tip = $t_tip['name'];
            echo "<tr><td align = center><b >$name_tip</b></td><td><a href = \"$site/tip/tip_edit.php?id=$id_tip\" ><img src=\"$site/img/ico/file_edit.png\" border=\"0\" alt=\"�������������\"></a></td><td> <a href=\"$site/tip/tip_del.php?id=$id_tip\" rel=\"facebox\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"�������\"></a></td></tr>";
            $ok_pod = mysql_query("SELECT * FROM podtip_mer where id_tip = $id_tip order by name");
            while ($t_pod = mysql_fetch_array($ok_pod)) {
                $id_pod = $t_pod['id'];
                $pod_tip = $t_pod['id_tip'];
                $name_pod_tip = $t_pod['name'];
                echo "<tr><td>$name_pod_tip</td><td><a href = \"$site/tip/podtip_edit.php?id=$id_pod\" ><img src=\"$site/img/ico/file_edit.png\" border=\"0\" alt=\"�������������\"></a></td><td> <a href=\"$site/tip/podtip_del.php?id=$id_pod\" rel=\"facebox\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"�������\"></a></td></tr>";
            }
        }
        echo "<tr><td><a href = \"$site/tip/ad.php?id=1\">�������� ����� ���</a></td><td></td><td></td></tr>";
        echo "<tr><td><a href = \"$site/tip/ad.php?id=2\">�������� ����� ������</a></td><td></td><td></td></tr>";
        echo "</table>";
    } else {
        error(7);
    }
}
//���������� ������
function org()
{
    global $id_user, $god_site;
    $adm = dostup_adm();
    $org = dostup_org_god($god_site);
    if ($adm == 1 or $org == "1") {
        if (isset($_GET['god'])) {
            $g = addslashes($_GET['god']);
        } else {
            $g = 0;
        }
        if (!is_numeric($g)) {
            die("����� ������ ���!");
        }
        $g = intval($g);
        echo "<div align=\"center\"><h3>���������� ��������������</h3></div>";
        echo "<table>";
        if ($g == 0) {
            $ok_page = mysql_query("select * from sibkon order by god desc");
        } else {
            $ok_page = mysql_query("select * from sibkon where god = $g");
        }
        while ($t_page = mysql_fetch_array($ok_page)) {
            $id_con = $t_page['id'];
            $god = $t_page['god'];
            $tema = $t_page['tema'];
            echo "<tr><td><b>$god</b></td><td><a href = \"$site/sibkon.php?id=$god\"><b>$tema</b></a></td><td><a href = \"$site/sibkon/edit.php?id=$id_con\"><img src=\"$site/img/ico/file_edit.png\" border=\"0\" alt=\"�������������\"></a></td><td> <a href=\"$site/sibkon/del.php?id=$id_con\" rel=\"facebox\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"�������\"></a></td></tr>";
            $ok_tip = mysql_query("SELECT * FROM org where god = $god");
            while ($t_tip = mysql_fetch_array($ok_tip)) {
                $id_o = $t_tip['id'];
                $id_org = $t_tip['id_org'];
                $user = user_info($id_org);
                echo "<tr><td></td><td>$user</td><td></td><td> <a href=\"$site/org/del.php?id=$id_o\" rel=\"facebox\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"�������\"></a></td></tr>";
            }
        }
        echo "</table>";
        echo "<p><a href = \"$site/org/ad.php\">�������� ������ ����.</a>";
    } else {
        error(7);
    }
}
//���������� ��������������
function module_site()
{
    global $id_user;
    $adm = dostup_adm();
    if ($adm == 1) {
        if (isset($_GET['ok'])) {
            $ok = addslashes($_GET['ok']);
        }
        $ok = intval($ok);
        echo "<div align=\"center\"><h3>���������� ��������</h3></div>";
        echo "<table><thead><th>��� ������</th><th>����</th><th>�������</th><th></th><th></th></thead>";
        $ok_page = mysql_query("select * from module");
        while ($t_page = mysql_fetch_array($ok_page)) {
            $id_modul = $t_page['id'];
            $name_modul = $t_page['name'];
            $on_modul = $t_page['on'];
            if ($on_modul == "0") {
                $on_modul = "���";
            } else {
                $on_modul = "��";
            }
            $file_modul = $t_page['file'];
            echo "<tr><td>$name_modul</td><td>$file_modul</td><td>$on_modul</td><td><a href = \"$site/module/edit.php?id=$id_modul\"><img src=\"$site/img/ico/file_edit.png\" border=\"0\" alt=\"�������������\"></a></td><td><a href=\"$site/module/del.php?id=$id_modul\" rel=\"facebox\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"�������\"></a></td></tr>";
        }
        echo "</table>";
        echo "<h5>�������� ����� ������.</h5>";
        echo "<form name=\"form1\" method=\"post\" action=\"/module/ad.php\">
        <table>
<tr><td>��������:</td><td><input type=\"text\"  name='name' size=\"86\"></td></tr>
<tr><td>����:</td><td><input type=\"text\"  name='file' size=\"86\"></td></tr>        
<tr><td>�������:</td><td><select name=\"on\" size=\"1\"><option value=\"0\">���</option><option value=\"1\">��</option></select><tr>
       </table>
<div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"javascript:document.form1.submit()\">��������</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div>
<p> <input name = \"kno\" type=\"submit\" value='.' style=\"color:#fff;border:0;padding:0;margin:0;background:#fff;height:6px;width:6px\"/>                           
</form>
       ";
    } else {
        error(7);
    }
}

function ban()
{
global $id_user, $god_site, $name_site, $site;
    $adm = dostup_adm();
    $god_org = dostup_org_god($god_site);
    if ($adm == 1 or $god_org == 1) {
	 echo "<div align=\"center\"><h3>���������� ������ �������</h3></div>";
        echo "";
		echo "
 <table id=\"example\" class=\"display\">
<thead>
<tr><th>���</th><th>���</th><th>�������</th><th>�����</th><th></th></tr>
</thead>
<tbody>
";
		if (isset($_GET['g']))
		{
			$g = addslashes($_GET['g']);
		}
		else
		{
			$g = "";
		}
		if (!($g == ""))
		{
			$query = "select * From `us` where ban = '1' and gorod_us = '$g'";
		}
		else
		{
			$query = "select * From `us` where ban = '1'";
		}
		$result = mysql_query($query) or die("Query failed : " . mysql_error());
		while ($link = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$id_us = "$link[id_us]";
			$name_us = "$link[name_us]";
			$fam_us = "$link[fam_us]";
			$nick_us = "$link[nick_us]";
			$gorod_us = "$link[gorod_us]";
			echo "
<tr><td><a title = \"$nick_us\" href = \"$site/profile.php?id=$id_us\">$nick_us</a></td><td>$name_us</td><td>$fam_us</td><td>$gorod_us</td><td>";
if ($id_user=="1854" or $id_user=="539") {
 echo"
<a href=\"profile/unban.php?id=$id_us\"  onclick=\"return confirm('��������������? �����?')\">��������������</a>";
}
echo"
</td></tr>";
		}
		echo "
</tbody>
<tfoot>
<tr><th>���</th><th>���</th><th>�������</th><th>�����</th><th></th></tr>

</tfoot>
</table>";
}
}
function room()
{
    global $id_user, $god_site, $name_site, $site;
    $adm = dostup_adm();
    $god_org = dostup_org_god($god_site);
    if ($adm == 1 or $god_org == 1) {
        echo "<div align=\"center\"><h3>���������� ���������� �� $name_site $god_site</h3></div>";
        echo "";
        echo "<table><tr><th>��������</th><th>���</th><th>���-��</th><th>������������</th></tr>";
        $ok_page = mysql_query("select * from room where id_con = $god_site");
        while ($t_page = mysql_fetch_array($ok_page)) {
            $id_room = $t_page['id'];
            $name_room = $t_page['name'];
            $glav = $t_page['glav'];
            $tip = $t_page['tip'];
            $kolvo = $t_page['kolvo'];
            $glav = user_info($glav);
            if ($tip == 0) {
                $tip = "�� ����������";
            } else
                if ($tip == 1) {
                    $tip = "�������";
                    $color = "#AAD4FF";
                } else
                    if ($tip == 2) {
                        $tip = "���������";
                         $color = "#7FFF7F";
                    } else
                        if ($tip == 3) {
                            $tip = "����";
                             $color = "#FFAAFF";
                        } else
							if ($tip == 4) {
								$tip = "�������";
								 $color = "#FFAAAA";
							} else
							if ($tip == 5) {
								$tip = "����������� ���������";
								 $color = "#FFAAAA";
							}
 
            
            
            
            echo "<tr bgcolor=\"$color\" ><td><a href = \"$site/room/edit.php?id=$id_room\">$name_room</a></td><td>$tip</td><td>$kolvo</td><td>$glav</td></tr>
			";
        }
        echo "</table>";

        $ok_news1 = mysql_query("select sum(kolvo) from room where id_con=$god_site");
        while ($t_news1 = mysql_fetch_array($ok_news1)) {
            $count1 = $t_news1['sum(kolvo)'];
            echo "����� ����: $count1";
        }
        echo "<br>�� ���:<br>";
        $name = ($_GET['name']);
        $tip = ($_GET['tip']);
        $kolvo = ($_GET['kolvo']);
        $otv = ($_GET['otv']);

        if ($otv == "") {

            $site_info = mysql_query("select * from setting_site");
            if (!mysql_num_rows($site_info))
                die("������ � ����� �� ��������.");
            else {
                while ($site_i = mysql_fetch_array($site_info)) {

                    $otv = $site_i['otv_pos'];
                }

            }
        }


        $ok_news1 = mysql_query("select tip,sum(kolvo) from room  where id_con=$god_site group by tip");
        while ($t_news1 = mysql_fetch_array($ok_news1)) {
            $count1 = $t_news1['sum(kolvo)'];
            $count1tip = $t_news1['tip'];

            if ($count1tip == 0) {
                $count1tip_print = "�� ����������";
            } else
                if ($count1tip == 1) {
                    $count1tip_print = "�������";
                } else
                    if ($count1tip == 2) {
                        $count1tip_print = "���������";
                    } else
                        if ($count1tip == 3) {
                            $count1tip_print = "����";
                        } else
							if ($count1tip == 4) {
                            $count1tip_print = "�������";
							} else
							if ($count1tip == 5) {
                            $count1tip_print = "����������� ���������";
							}
            echo "$count1tip_print: $count1<br>";
        }
        echo "
			<form method=\"post\" action=\"$site/room/adroom.php\">
			<table>
			<tr><td>�������� ������� (�����)</td><td><input type=\"text\" name = \"name\" value = \"$name\"></td></tr>
<tr><td>��� �������</td><td><SELECT NAME=\"tip\" SIZE=\"1\">
	        <OPTION VALUE=\"0\" ";
        if ($tip == 0) {
            echo "selected";
        }
        echo " >�� ����������</OPTION>
	       <OPTION VALUE=\"1\" ";
        if ($tip == 1) {
            echo "selected";
        }
        echo " >�������</OPTION>
	       <OPTION VALUE=\"2\" ";
        if ($tip == 2) {
            echo "selected";
        }
        echo " >���������</OPTION>
	       <OPTION VALUE=\"3\" ";
        if ($tip == 3) {
            echo "selected";
        }
        echo " >����</OPTION>
		<OPTION VALUE=\"4\" ";
        if ($tip == 4) {
            echo "selected";
        }
        echo " >�������</OPTION>
		<OPTION VALUE=\"5\" ";
        if ($tip == 5) {
            echo "selected";
        }
        echo " >����������� ���������</OPTION>
		
       </SELECT></td></tr>
       <tr><td>���-�� ����</td><td><input type=\"text\" name = \"kolvo\"  value = $kolvo></td></tr>
           <tr><td>������������� (�� ������������)</td><td><input type=\"text\" name = \"otv\"  value = $otv></td></tr>
</table><input type=\"submit\" value=\"��������\" name=\"submit\">
</form>
	";


    } else {
        error(7);
    }
}


function action()
{
    $adm = dostup_adm();
    $org = dostup_org();
    if ($adm == "1" or $org == "1") {
        if (isset($_GET['id'])) {
            $id = addslashes($_GET['id']);
        } else {
            $id = 1;
        }
        if (!is_numeric($id)) {
            die("����� ������ ���!");
        }
        $id = intval($id);
        //1 - ������� ��������
        if ($id == "1") {
            glav();
        }
        //2 - ���������� ������
        else
            if ($id == "2") {
                site();
            }
        //3 - ���������� ����������
            else
                if ($id == "3") {
                    pages();
                }
        //4 - ���������� ���������
                else
                    if ($id == "4") {
                        news();
                    }
        //5 - ���� �������������
                    else
                        if ($id == "5") {
                            logi();
                        }
        //6 - ���������� ����������
                        else
                            if ($id == "6") {
                                konvent();
                            }
        //7 - ����������� �����������
                            else
                                if ($id == "7") {
                                    mat();
                                }
        //8 - ���������� �������������
                                else
                                    if ($id == "8") {
                                        mer();
                                    }
        //9 - ���������� ������ � ���������
                                    else
                                        if ($id == "9") {
                                            tipmer();
                                        }
        //10 - ���������� ������ ���������
                                        else
                                            if ($id == "10") {
                                                org();
                                            } else //11 - ���������� ��������

                                                if ($id == "11") {
                                                    module_site();
                                                } else //12 - ������ ����������

                                                    if ($id == "12") {
                                                        tender_mer();
                                                    } else //12 - ������ ����������

                                                        if ($id == "13") {
                                                            room();
                                                        } else //14 - ������ ������

                                                        if ($id == "14") {
                                                            ban();
                                                        }
    } else {
        error(7);
    }
}
function title()
{
    global $id_us, $name_site;
    if (isset($_GET['id'])) {
        $id = addslashes($_GET['id']);
    } else {
        $id = 1;
    }
    if (!is_numeric($id)) {
        die("����� ������ ���!");
    }
    $id = intval($id);
    //1 - ������� ��������
    if ($id == "1") {
        $name_title = "�����������������";
    }
    //2 - ���������� ������
    else
        if ($id == "2") {
            $name_title = "���������� ������";
        }
    //3 - ���������� ����������
        else
            if ($id == "3") {
                $name_title = "���������� ����������";
            }
    //4 - ���������� ���������
            else
                if ($id == "4") {
                    $name_title = "���������� ���������";
                }
    //5 - ���� �������������
                else
                    if ($id == "5") {
                        $name_title = "���� �������������";
                    }
    //6 - ���������� ����������
                    else
                        if ($id == "6") {
                            $name_title = "���������� ���������";
                        }
    //7 - ����������� �����������
                        else
                            if ($id == "7") {
                                $name_title = "����������� �����������";
                            }
    //8 - ���������� �������������
                            else
                                if ($id == "8") {
                                    $name_title = "���������� �������������";
                                }
    //9 - ���������� ������ � ���������
                                else
                                    if ($id == "9") {
                                        $name_title = "���������� ������ � ���������";
                                    }
    //10 - ���������� ������ ���������
                                    else
                                        if ($id == "10") {
                                            $name_title = "���������� ������";
                                        } else
                                            if ($id == "12") {
                                                $name_title = "����������";
                                            } else
                                                if ($id == "13") {
                                                    $name_title = "���������� ����������";
                                                } else
                                                if ($id == "14") {
                                                    $name_title = "������ ������";
                                                }
    echo "
<link type=\"text/css\" rel=\"stylesheet\" href=\"$site/js/jtip.css\" media=\"all\">
<script src=\"$site/js/jtip.js\" type=\"text/javascript\"></script>
";
    echo "
<title>$name_title | $name_site</title>";
}
function right()
{
    global $name_group;
    $adm = dostup_adm();
    $org = dostup_org();
    if ($adm == "1" or $org == "1") {
        global $site;
        echo "<ul>";
        echo "<li><a href = \"$site/admin.php?id=6\">���������� ���������</a></li>";
        echo "<li><a href = \"$site/admin.php?id=7\">���������� �����������</a></li>";
       // echo "<li><a href = \"$site/admin.php?id=8\">���������� ($name_group)</a></li>";
        echo "<li><a href = \"$site/admin.php?id=9\">���������� ������</a></li>";
        echo "<li><a href = \"$site/admin.php?id=10\">���� ��������</a></li>";
        echo "<li><a href = \"$site/admin.php?id=2\">���������� ������</a></li>";
        echo "<li><a href = \"$site/admin.php?id=3\">���������� ����������</a></li>";
        echo "<li><a href = \"$site/admin.php?id=4\">���������� ���������</a></li>";
        echo "<li><a href = \"$site/admin.php?id=11\">�������� ��������</a></li>";
        echo "<li><a href = \"$site/admin.php?id=12\">���������� � �������� �������</a></li>";
        echo "<li><a href = \"$site/admin.php?id=13\">���������� ����������</a></li>";
        echo "<li><a href = \"$site/admin.php?id=5\">�������� �����</a></li>";
	    echo "<li><a href = \"$site/admin.php?id=14\">������ ������</a></li>";
        echo "</ul>";
    }
}
require ("theme/$theme/$theme.htm");
?>